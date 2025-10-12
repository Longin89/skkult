<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Images;
use App\Models\Posts;
use Core\Router;
use Core\Session;
use App\Lib\Utilities\Uploads;
use App\Lib\Utilities\MemcachedService;
use App\Models\Users;

class PostsController extends Controller
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
        // Берем новости из Memcached, если нет - из базы
        $memcached = MemcachedService::getInstance();
        $allPosts = $memcached->getWithFallback(
            'posts',
            function () {
                return Posts::getCache();
            }
        );
        // Пагинация. Нарезаем массив из новостей на куски и отображаем по $count
        $totalPosts = count($allPosts);
        $count = 3;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $start = ($page - 1) * $count;
        $posts = array_slice($allPosts, $start, $count);

        // Передаем информацию в вид
        $this->view->posts = $posts;
        $this->view->pagecount = ceil($totalPosts / $count);
        $this->view->page = $page;
        $this->view->render('posts/index');
    }

    public function listAction()
    {
        // Пагинация. Нарезаем массив из новостей на куски и отображаем по $count
        $count = 5;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allPosts = Posts::find(['order' => 'updated_at DESC']);
        $totalPosts = count($allPosts);
        $start = ($page - 1) * $count;

        // Передаем информацию в вид
        $this->view->posts = array_slice($allPosts, $start, $count);
        $this->view->pagecount = ceil($totalPosts / $count);
        $this->view->page = $page;
        $this->view->render('posts/list');
    }

    public function addAction()
    {
        // Создаем экземпляры поста и его картинок.Если не загружаем картинку - получаем ошибку.
        $post = new Posts();
        $image = new Images();
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $files = $_FILES['images'];
            if ($files['tmp_name'][0] == '') {
                $post->addErrorMessage('Images', 'Вы должны загрузить изображение');
            } else {
                // Валидируем картинки
                $uploads = new Uploads($files);
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if (is_array($imagesErrors)) {
                    $msg = '';
                    foreach ($imagesErrors as $name => $message) {
                        $msg .= $message . '<br>';
                    }
                    $post->addErrorMessage('images', $msg);
                }
            }
            // Сохраняем
            $postData = $this->request->get();
            $post->assign($postData);
            $post->save();
            if ($post->validationPassed()) {
                // Если валидация успешна - загружаем картинки
                $image = Images::uploadImages('posts', $uploads, null, null, $post->id, $post->id);
                Session::addMsg('success', 'Новость добавлена в базу');
                Router::redirect('admindashboard');
            }
        }
        // Передаем информацию в вид
        $this->view->image = $image;
        $this->view->post = $post;
        $this->view->formAction = PROOT . 'posts/add';
        $this->view->displayErrors = $post->getErrorMessages();
        $this->view->render('posts/add');
    }

    public function deleteAction()
    {
        // Массив с дефолтным ответом
        $resp = ['success' => false, 'msg' => 'Something goes wrong'];
        if ($this->request->isPost()) {
            $id = $this->request->get('id');
            // Получаем id из запроса и ищем новость по нему
            $post = Posts::findById($id);
            if ($post) {
                // Если нашли - удаляем картинки, затем - запись из базы. Формируем ответ
                Images::deleteImages($post->id, $post->id, null, null, 'posts', true);
                $post->delete();
                $resp = ['success' => true, 'msg' => 'Новость удалена', 'model_id' => $id];
            }
        }
        $this->jsonResponse($resp);
    }

    public function editAction($id)
    {
        // Ищем новость по id, если нет - выводим ошибку
        $post = Posts::findById($id);
        if (!$post) {
            Session::addMsg('danger', 'Новость не существует');
            Router::redirect('posts/list');
        }
        // Ищем картинку по связанному с новостью id
        $images = Images::find(['conditions' => 'post_id = ?', 'bind' => [$post->id], 'order' => 'sort']);
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            // Если загружаем новую картинку - валидируем
            $files = $_FILES['images'];
            $isFiles = $files['tmp_name'][0] != '';
            if ($isFiles) {
                $uploads = new Uploads($files);
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if (is_array($imagesErrors)) {
                    $msg = '';
                    foreach ($imagesErrors as $name => $message) {
                        $msg .= $message . '<br>';
                    }
                    $post->addErrorMessage('images', trim($msg));
                }
            }
            $post->assign($this->request->get());
            $post->save();
            if ($post->validationPassed()) {
                if ($isFiles) {
                    // Если валидация прошла - загружаем картинки
                    $images = Images::uploadImages('posts', $uploads, null, null, $post->id, $post->id);
                }
                // Порядок сортировки в новости
                $sortOrder = [];
                if (isset($_POST['images_sorted']) && !empty($_POST['images_sorted'])) {
                    $sortOrder = json_decode($_POST['images_sorted'], true);
                }
                Images::updateSortImages($post->id, $sortOrder);
                Session::addMsg('success', 'Новость обновлена');
                Router::redirect('posts/list');
            }
        }
        // Передаем информацию в вид
        $this->view->images = $images;
        $this->view->post = $post;
        $this->view->displayErrors = $post->getErrorMessages();
        $this->view->formAction = PROOT . 'posts/edit/' . $id;
        $this->view->render('posts/edit');
    }

    public function deleteImageAction()
    {
        // Массив с дефолтным ответом
        $resp = ['success' => false, 'msg' => 'Ошибка удаления'];
        if ($this->request->isPost()) {
            // Получаем id изображения
            $imageId = $this->request->get('image_id');
            $image = Images::findById($imageId);
            if ($image) {
                // Если картинка найдена - получаем ее путь и удаляем ее на диске, затем - из базы. Формируем ответ.
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
