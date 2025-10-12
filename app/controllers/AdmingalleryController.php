<?php
namespace App\Controllers;

use Core\Controller;

class AdmingalleryController extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('admin');
    }

    public function indexAction() {
        $this->view->render('admingallery/index');
    }
}
?>