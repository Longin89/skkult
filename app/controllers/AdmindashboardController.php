<?php

namespace App\Controllers;

use Core\Controller;

class AdmindashboardController extends Controller
{

    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        // Пока не решили,что здесь будет. Скорее всего - справочная информация о посещении итд.
        parent::__construct($controller, $action);
        $this->view->setLayout('admin');
    }

    public function indexAction()
    {
        $this->view->render('admindashboard/index');
    }
}
