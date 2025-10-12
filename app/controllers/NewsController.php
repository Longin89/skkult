<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\posts;
use Core\Controller;

class postsController extends Controller
{
    public function __construct($controller, $action) // Вызывает родительский конструктор, передавая ему текущий контроллер и действие.
    {
        parent::__construct($controller, $action);
        if (Users::$currentLoggedUser->username == 'admin' && $_SERVER['REQUEST_URI'] == "/posts/add") {
            $this->view->setLayout('admin');
        }
    }

    public function indexAction() // Отвечает за отображение домашней страницы приложения. Использует объект $this->view для рендеринга представления
    {
        $this->view->render('posts/index');
    }

    public function addAction() // Отвечает за отображение домашней страницы приложения. Использует объект $this->view для рендеринга представления
    {
        $post = New posts();
        $this->view->formAction = PROOT . 'posts/add';
        $this->view->displayErrors = [];
        $this->view->render('posts/add');
    }
}
