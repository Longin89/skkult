<?php

namespace App\Controllers;

use App\Models\About;
use App\Models\Users;
use Core\Controller;
use Core\Router;
use Core\Session;

class AboutController extends Controller
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
        // Находим инфу о клубе и передаем ее в вид
        $about = About::findById(1);
        $this->view->about = $about;
        $this->view->render('about/index');
    }

    public function editAction()
    {
        // Находим инфу о клубе, меняем и сохраняем, смотрим
        $about = About::findById(1);
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $about->assign($this->request->get());
            $about->save();
            if ($about->validationPassed()) {
                Session::addMsg('success', 'Информация обновлена');
                Router::redirect('about/index');
            }
        }
        // Передаем информацию в вид
        $this->view->about = $about;
        $this->view->displayErrors = $about->getErrorMessages();
        $this->view->formAction = PROOT . 'about/edit';
        $this->view->render('about/edit');
    }
}
