<?php

namespace App\Controllers;

use App\Models\Gallery;
use App\Models\Images;
use App\Models\Users;
use App\Lib\Utilities\Uploads;
use Core\Controller;
use Core\Session;
use Core\Router;

class GalleryController extends Controller
{
    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        parent::__construct($controller, $action);
        if (Users::$currentLoggedInUser && Users::$currentLoggedInUser->username == 'admin') {
            $this->view->setLayout('admin');
        }
    }

    public function editAction($id = 4)
    {
        // Находим текущую галерею и ее изображения (пофиксить хардкод!)
        $gallery = Gallery::findById($id);
        $images = Images::find(['conditions' => 'gallery_id = ?', 'bind' => [$gallery->id], 'order' => 'sort']);
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $files = $_FILES['images'];
            // Проверяем, загружена ли картинка или есть ли она в массиве
            if ($files['tmp_name'][0] == '' && empty($images)) {
                $gallery->addErrorMessage('Images', 'Вы должны загрузить изображение');
            } else {
                $uploads = new Uploads($files);
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if (is_array($imagesErrors)) {
                    $msg = '';
                    foreach ($imagesErrors as $name => $message) {
                        $msg .= $message . '<br>';
                    }
                    $gallery->addErrorMessage('images', $msg);
                }
            }
            // Сортировка изображений
            if (isset($_POST['images_sorted'])) {
                $sortOrder = json_decode($_POST['images_sorted']);
                Images::updateSortImages(null, $sortOrder,  $gallery->id);
            }
            // Сохранение изображений
            $gallery->assign($this->request->get());
            $gallery->save();
            if ($gallery->validationPassed()) {
                if ($files['tmp_name'][0] != '') {
                    Images::uploadImages('gallery', $uploads, null, $gallery->id, null, $gallery->id);
                }
                Session::addMsg('success', 'Галерея сохранена');
                Router::redirect('admindashboard');
            }
        }
        // Передаем контакты в вид
        $this->view->gallery = $gallery;
        $this->view->images = $images;
        $this->view->formAction = PROOT . 'gallery/edit';
        $this->view->displayErrors = $gallery->getErrorMessages();
        $this->view->render('gallery/edit');
    }

    public function deleteImageAction()
    {
        // Массив с дефолтным ответом
        $resp = ['success' => false, 'msg' => 'Ошибка удаления'];
        if ($this->request->isPost()) {
            //Ищем изображение по id
            $imageId = $this->request->get('image_id');
            $image = Images::findById($imageId);
            // Если нашли изображение - удаляем с диска, затем из базы. Формируем ответ.
            if ($image) {
                $filePath = ROOT . DS . $image->url;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
                $resp = ['success' => true, 'msg' => 'Картинка удалена', 'image_id' => $imageId];
            }
        }
        $this->jsonResponse($resp);
    }
}
