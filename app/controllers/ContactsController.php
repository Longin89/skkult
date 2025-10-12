<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Contacts;
use Core\Controller;
use Core\Router;
use Core\Session;

class ContactsController extends Controller
{
    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        parent::__construct($controller, $action);
        if (Users::$currentLoggedInUser && Users::$currentLoggedInUser->username == 'admin') {
            $this->view->setLayout('admin');
        }
    }

    public function indexAction()
    {
        // Получаем все контакты и передаем их в вид
        $contacts = Contacts::findFirst();
        $this->view->contacts = $contacts;
        $this->view->render('contacts/index');
    }

    public function editAction()
    {
        // Получаем контакты, сохраняем контакты
        $contacts = Contacts::findFirst();
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $contacts->assign($this->request->get());
            $contacts->save();
            if ($contacts->validationPassed()) {
                Session::addMsg('success', 'Контакты обновлены');
                Router::redirect('contacts/index');
            }
        }
        // Передаем контакты в вид
        $this->view->contacts = $contacts;
        $this->view->displayErrors = $contacts->getErrorMessages();
        $this->view->formAction = PROOT . 'contacts/edit';
        $this->view->render('contacts/edit');
    }
}
