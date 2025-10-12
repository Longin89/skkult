<?php

namespace App\Models;

use Core\Model;

class Images extends Model
{
  public $id, $coach_id, $gallery_id, $url, $post_id, $sort, $deleted = 0;

  public function __construct()
  {
    $table = 'images';
    $this->_softDelete = false;
    parent::__construct($table);
  }

  public function afterSave()
  {
    if (empty($this->id)) {
      $this->id = $this->_db->lastID();
    }
  }

  public static function uploadImages($section, $uploads, $coach_id = null, $gallery_id = null, $post_id = null, $item_id = null)
  {
    // Создаем путь для загрузки изображений
    $path = 'uploads' . DS . 'images' . DS . $section . DS . $item_id . DS;
    // Обрабатываем каждый загруженный файл
    foreach ($uploads->getFiles() as $file) {
      // Разделяем имя файла на части
      $parts = explode('.', $file['name']);
      // Получаем расширение файла
      $ext = end($parts);
      // Генерируем уникальное имя файла
      $hash = sha1(time() . $section . $file['tmp_name']);
      $uploadName = $hash . '.' . $ext;
      // Создаем новый объект изображения
      $image = new self();
      // Устанавливаем путь к изображению
      $image->url = $path . $uploadName;
      // Устанавливаем id тренера, если есть
      $image->coach_id = $coach_id;
      // Устанавливаем id галереи, если есть
      $image->gallery_id = $gallery_id;
      // Устанавливаем id поста, если есть
      $image->post_id = $post_id;
      // Сохраняем изображение в базу
      if ($image->save()) {
        // Загружаем изображение на сервер
        $uploads->upload($path, $uploadName, $file['tmp_name']);
      }
    }
    return $image;
  }

  public static function deleteImages($id, $post_id = null, $coach_id = null, $gallery_id = null, $section, $unlink = false)
  {
    $images = new Images;
    $conditions = [];
    $bind = [];
    // Устанавливаем условие для поиска изображений по id поста, если есть
    if ($post_id !== null) {
      $conditions[] = "post_id = ?";
      $bind[] = $post_id;
    }
    // Устанавливаем условие для поиска изображений по id тренера, если есть
    if ($coach_id !== null) {
      $conditions[] = "coach_id = ?";
      $bind[] = $coach_id;
    }
    // Устанавливаем условие для поиска изображений по id галереи, если есть
    if ($gallery_id !== null) {
      $conditions[] = "gallery_id = ?";
      $bind[] = $gallery_id;
    }
    // Ищем картинки по установленным условиям
    $images = $images->find([
      'conditions' => $conditions,
      'bind' => $bind
    ]);
    // Удаляем картинки
    foreach ($images as $image) {
      $image->delete();
    }
    if ($unlink) {
      // Удаляем директорию с изображениями если $unlink = true
      $dirname = ROOT . DS . 'uploads' . DS . 'images' . DS . $section . DS . $id;
      array_map('unlink', glob("$dirname/*.*"));
      rmdir($dirname);
    }
  }

  public static function updateSortImages($post_id = null, $sortOrder = [], $gallery_id = null)
  {
    // Проверяем, является ли $sortOrder массивом
    if (!is_array($sortOrder)) return;
    // Преобразуем массив в массив idшек
    $ids = array_map(function ($val) {
      return str_replace('image_', '', $val);
    }, $sortOrder);
    foreach ($ids as $sort => $id) {
      // Ищем картинку по id
      $image = (new self())->findById($id);
      if ($image) {
        // Устанавливаем сортировку для картинок
        $image->sort = $sort;
        // Сохраняем картинки в базу
        $image->save();
      }
    }
  }
}
