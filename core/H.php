<?php

namespace Core;

use App\Models\Users;

class H
{

  public static function dnd($data) // Используется для отладки и вывода информации о переменной.
  {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
  }

  public static function currentPage() // Возвращает URL текущей страницы.
  {
    $currentPage = $_SERVER['REQUEST_URI'];
    if ($currentPage == PROOT || $currentPage == PROOT . 'home/index') {
      $currentPage = PROOT . 'home';
    }
    return $currentPage;
  }

  public static function getObjectProperties($obj){
    return get_object_vars($obj);
  }

  public static function buildMenuListItems($menu,$dropdownClass=""){
    ob_start();
    $currentPage = self::currentPage();
    foreach($menu as $key => $val):
      $active = '';
      if($key == '%USERNAME%'){
        $key = (Users::currentUser())? Users::currentUser()->username : $key;
      }
      if(is_array($val)): ?>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle user__toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$key?></a>
          <div class="dropdown-menu <?=$dropdownClass?>">
            <?php foreach($val as $k => $v):
              $active = ($v == $currentPage)? 'active':''; ?>
                <a class="dropdown-item user__logout <?=$active?>" href="<?=$v?>"><?=$k?></a>
            <?php endforeach; ?>
          </div>
        </li>
      <?php else:
        $active = ($val == $currentPage)? 'active':''; ?>
        <li class="nav-item"><a class="nav-link <?=$active?>" href="<?=$val?>"><?=$key?></a></li>
      <?php endif; ?>
    <?php endforeach;
    return ob_get_clean();
  }
}
