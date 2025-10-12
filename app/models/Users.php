<?php

namespace App\Models;

use Core\Model;
use App\Models\UserSessions;
use Core\Cookie;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;

class Users extends Model
{
  private $_isLoggedIn, $_sessionName, $_cookieName, $_confirm;
  public static $currentLoggedInUser = null;
  public $id, $username, $email, $created_at, $updated_at, $password, $acl, $deleted = 0;

  public function __construct($user = '') // Устанавливает имя таблицы, настройки для сессий и куков, включает мягкое удаление и может инициализировать пользователя по ID или имени.
  {
    $table = 'users';
    parent::__construct($table);
    $this->_sessionName = CURRENT_USER_SESSION_NAME;
    $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
    $this->_softDelete = true;
    if ($user != '') {
      if (is_int($user)) {
        $u = $this->_db->findFirst('users', ['conditions' => 'id = ?', 'bind' => [$user]], 'App\Models\Users');
      } else {
        $u = $this->_db->findFirst('users', ['conditions' => 'username = ?', 'bind' => [$user]], 'App\Models\Users');
      }
      if ($u) {
        foreach ($u as $key => $val) {
          $this->$key = $val;
        }
      }
    }
  }

  public function validator() // Определяет правила валидации для различных полей модели.
  {
    $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'Email не может быть пустым']));
    $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'Email имеет некорректный формат']));
    $this->runValidation(new MinValidator($this, ['field' => 'username', 'rule' => 4, 'msg' => 'Минимальная длина логина - 4 знака']));
    $this->runValidation(new MaxValidator($this, ['field' => 'username', 'rule' => 10, 'msg' => 'Максимальная длина логина - 10 знаков']));
    $this->runValidation(new UniqueValidator($this, ['field' => 'username', 'msg' => 'Логин уже занят']));
    $this->runValidation(new UniqueValidator($this, ['field' => 'email', 'msg' => 'Email уже занят']));
    $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => 'Пароль не может быть пустым']));
    $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 4, 'msg' => 'Минимальная длина пароля - 4 знака']));
    $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'msg' => 'Пароли не совпадают']));
  }

  public function beforeSave() // Хэширует пароль перед сохранением нового пользователя.
  {
    $this->timeStamps();
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
  }

  public function findByUsername($username) // Находим пользователя по имени
  {
    return $this->findFirst(['conditions' => "username = ?", 'bind' => [$username]]);
  }

  public static function currentUser() // Находим текущего пользователя
  {
    if (!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
      $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
      self::$currentLoggedInUser = $u;
    }
    return self::$currentLoggedInUser;
  }

  public function login($rememberMe = false)
  {
    Session::set($this->_sessionName, $this->id);
    if ($rememberMe) {
      // Если поставили галочку - создаем хэш и сохраняем куки в таблицу user_sessions
      $randomNumber = rand(0, 1000);
      $hash = md5(uniqid() . $randomNumber);
      $user_agent = Session::uagent_no_version();
      Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRE);
      $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
      $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
      $this->_db->insert('user_sessions', $fields);
    }
  }

  public static function loginUserFromCookie()
  {
    // Логинимся из кук, если возможно
    $userSession = UserSessions::getFromCookie();
    if ($userSession && $userSession->user_id != '') {
      $user = new self((int)$userSession->user_id);
      if ($user) {
        $user->login();
      }
      return $user;
    }
    return;
  }

  public function logout()
  {
    // Удаляем сессию пользователя и куки
    $userSession = UserSessions::getFromCookie();
    if ($userSession) $userSession->delete();
    Session::delete(CURRENT_USER_SESSION_NAME);
    if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
      Cookie::delete(REMEMBER_ME_COOKIE_NAME);
    }
    self::$currentLoggedInUser = null;
    return true;
  }

  public function acls()
  {
    // Возвращает Access Control List (ACL), если он есть.
    if (empty($this->acl)) return [];
    return json_decode($this->acl, true);
  }

  public function setConfirm($value)
  {
    // Сеттер
    $this->_confirm = $value;
  }

  public function getConfirm()
  {
    // Геттер
    return $this->_confirm;
  }

  // Методы для добавления и удаления Access Control List пользователя.

  public static function addAcl($user_id, $acl)
  {
    $user = self::findById($user_id);
    if (!$user) return false;
    $acls = $user->acls();
    if (!in_array($acl, $acls)) {
      $acls[] = $acl;
      $user->acl = json_encode($acls);
      $user->save();
    }
    return true;
  }

  public static function removeAcl($user_id, $acl)
  {
    $user = self::findById($user_id);
    if (!$user) return false;
    $acls = $user->acls();
    if (in_array($acl, $acls)) {
      $key = array_search($acl, $acls);
      unset($acls[$key]);
      $user->acl = json_encode($acls);
      $user->save();
    }
    return true;
  }
}
