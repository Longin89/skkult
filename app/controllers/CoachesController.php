<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Coaches;
use App\Models\Images;
use App\Lib\Utilities\Uploads;
use Core\Controller;
use Core\Router;
use Core\Session;

class CoachesController extends Controller
{
    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        parent::__construct($controller, $action);
        if (Users::$currentLoggedInUser && Users::$currentLoggedInUser->username == 'admin') {
            $this->view->setLayout('admin');
        }
    }

    public function addAction()
    {
        // Создаем тренера и его фото
        $coach = new Coaches();
        $image = new Images();
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            // Загружаем фото, проверяем на ошибки
            $file = $_FILES['images'];
            if (empty($file['tmp_name'])) {
                $coach->addErrorMessage('Images', 'Вы должны загрузить фото');
            } else {
                $uploads = new Uploads([
                    'name' => [$file['name']],
                    'type' => [$file['type']],
                    'tmp_name' => [$file['tmp_name']],
                    'error' => [$file['error']],
                    'size' => [$file['size']]
                ]);
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if (is_array($imagesErrors)) {
                    $msg = '';
                    foreach ($imagesErrors as $name => $message) {
                        $msg .= $message . '<br>';
                    }
                    $coach->addErrorMessage('images', $msg);
                }
            }
            // Сохраняем
            $coachData = $this->request->get();
            $coach->assign($coachData);
            $coach->save();
            if ($coach->validationPassed()) {
                $image = Images::uploadImages('coaches', $uploads, $coach->id, null, null, $coach->id);
                Session::addMsg('success', 'Тренер добавлен в базу');
                Router::redirect('coaches/list');
            }
        }
        // Передаем информацию в вид
        $this->view->image = $image;
        $this->view->coach = $coach;
        $this->view->formAction = PROOT . 'coaches/add';
        $this->view->displayErrors = $coach->getErrorMessages();
        $this->view->render('coaches/add');
    }

    public function editAction($id)
    {
        // Ищем тренера, если не находим - выводим ошибку
        $coach = Coaches::findById($id);
        if (!$coach) {
            Session::addMsg('danger', 'Тренер не найден');
            Router::redirect('coaches/list');
        }
        // Ищем фото тренера, если не находим - выводим ошибку
        $images = Images::find(['conditions' => 'coach_id = ?', 'bind' => [$coach->id], 'order' => 'sort']);
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $file = $_FILES['images'];
            $hasFile = !empty($file['tmp_name']);
            // Проверка: есть ли хотя бы одно изображение
            if (count($images) === 0 && !$hasFile) {
                $coach->addErrorMessage('images', 'У тренера должно быть фото');
            }
            if ($hasFile) {
                $uploads = new Uploads([
                    'name' => [$file['name']],
                    'type' => [$file['type']],
                    'tmp_name' => [$file['tmp_name']],
                    'error' => [$file['error']],
                    'size' => [$file['size']]
                ]);
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if (is_array($imagesErrors)) {
                    $msg = '';
                    foreach ($imagesErrors as $name => $message) {
                        $msg .= $message . '<br>';
                    }
                    $coach->addErrorMessage('images', $msg);
                }
            }
            // Сохраняем, если все хорошо
            $coach->assign($this->request->get());
            $coach->save();
            if ($coach->validationPassed()) {
                if ($hasFile) {
                    $images = Images::uploadImages('coaches', $uploads, $coach->id, null, null, $coach->id);
                }
                Session::addMsg('success', 'Тренер обновлён');
                Router::redirect('coaches/list');
            }
        }
        // Передаем информацию в вид
        $this->view->images = $images;
        $this->view->coach = $coach;
        $this->view->displayErrors = $coach->getErrorMessages();
        $this->view->formAction = PROOT . 'coaches/edit/' . $id;
        $this->view->render('coaches/edit');
    }

    public function listAction()
    {
        // Ищем всех тренеров и передаем их в вид
        $сoaches = Coaches::find();
        $this->view->coaches = $сoaches;
        $this->view->render('coaches/list');
    }

    public function deleteAction()
    {
        // Массив с дефолтным ответом
        $resp = ['success' => false, 'msg' => 'Ошибка удаления'];
        if ($this->request->isPost()) {
            // Получаем id из запроса и ищем тренера по нему
            $id = $this->request->get('id');
            $coach = Coaches::findById($id);
            if ($coach) {
                // Если тренер найден - удаляем картинку и запись в базе. Формируем ответ.
                Images::deleteImages($coach->id, null, $coach->id, null, 'coaches', true);
                $coach->delete();
                $resp = ['success' => true, 'msg' => 'Тренер удалён', 'model_id' => $id];
            }
        }
        $this->jsonResponse($resp);
    }

    public function deleteImageAction()
    {
        // Массив с дефолтным ответом
        $resp = ['success' => false, 'msg' => 'Ошибка удаления'];
        if ($this->request->isPost()) {
            // Получаем id изображения
            $imageId = $this->request->get('image_id');
            // Создаем экземпляр картинки
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
