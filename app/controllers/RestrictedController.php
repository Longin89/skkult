<?php

namespace App\Controllers;

use Core\Controller;

class RestrictedController extends Controller
{
    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        parent::__construct($controller, $action);
    }

    public function indexAction() // Отвечает за отображение страницы ограниченного доступа.
    {
        $this->view->render('restricted/index');
    }

    public function badTokenAction() // Обрабатывает ситуацию, когда пользователь пытается использовать некорректный токен доступа, отображает специальную страницу.
    {
        $this->view->render('restricted/badToken');
    }
}
