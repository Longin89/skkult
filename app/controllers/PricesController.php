<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Prices;
use Core\Controller;
use Core\Session;
use Core\Router;

class PricesController extends Controller
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
        // Передаем информацию в вид
        $allPrices = Prices::find();
        $this->view->prices = $allPrices;
        $this->view->render('prices/index');
    }

    public function listAction()
    {
        // Передаем информацию в вид
        $prices = Prices::find();
        $this->view->prices = $prices;
        $this->view->render('prices/list');
    }

    public function editAction($id)
    {
        // Находим услугу, если ее нет - выводим ошибку
        $price = Prices::findById($id);
        if (!$price) {
            Session::addMsg('danger', 'Тариф не найден');
            Router::redirect('prices/list');
        } else if ($this->request->isPost()) {
            // Отправляем и сохраняем, если все хорошо
            $this->request->csrfCheck();
            $price->assign($this->request->get());
            $price->save();
            if ($price->validationPassed()) {
                Session::addMsg('success', 'Тариф обновлён');
                Router::redirect('prices/list');
            }
        }
        // Передаем информацию в вид
        $this->view->price = $price;
        $this->view->formAction = PROOT . 'prices/edit/' . $id;
        $this->view->displayErrors = $price->getErrorMessages();
        $this->view->render('prices/edit');
    }
}
