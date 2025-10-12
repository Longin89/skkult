<?php

namespace App\Controllers;

use App\Models\Prices;
use App\Models\Gallery;
use App\Models\Coaches;
use Core\Controller;
use App\Models\Users;
use App\Lib\Utilities\MemcachedService;
use App\Models\Contacts;

class HomeController extends Controller
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
        // Тренеров и галерею пишем из memcached, если они пустые - лезем в базу и наполняем
        $memcached = MemcachedService::getInstance();
        $coaches = $memcached->getWithFallback(
            'coaches',
            function () {
                return Coaches::getCache();
            }
        );
        $galleryImages = $memcached->getWithFallback(
            'gallery',
            function () {
                return Gallery::getCache();
            }
        );
        // Цены берем стандартно
        $prices = Prices::find();
        $contacts = Contacts::findFirst();
        $programs = array_column($prices, 'title');

        // Передаем собранную информацию в вид
        $this->view->galleryImages = $galleryImages;
        $this->view->programs = $programs;
        $this->view->coaches = $coaches;
        $this->view->contacts = $contacts;
        $this->view->render('home/index');
    }
}
