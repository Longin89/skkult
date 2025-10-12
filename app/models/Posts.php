<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class Posts extends Model
{
    public $id, $title, $content, $created_at, $updated_at, $deleted = 0;

    public function __construct()
    {
        $table = 'posts';
        $this->_softDelete = false;
        parent::__construct($table);
    }

    public function beforeSave()
    {
        $this->timeStamps();
    }

    public function afterSave()
    {
        if (empty($this->id)) {
            $this->id = $this->_db->lastID();
        }
    }

    public function validator()
    {
        $requiredFields = ['title' => 'Заголовок', 'content' => 'Содержание'];
        foreach ($requiredFields as $key => $val) {
            $this->runValidation(new RequiredValidator($this, ['field' => $key, 'msg' => 'Необходимо заполнить пункт ' . "<$val>"]));
        }
    }

    public static function pageCount($items, $perPage)
    {
        // Возвращаем количество страниц для пагинации
        return (int)ceil(count($items) / $perPage);
    }

    public static function getCache()
    {
        $posts = Posts::find(['order' => 'updated_at DESC']);
        foreach ($posts as $post) {
            $images = Images::find(['conditions' => 'post_id = ?', 'bind' => [$post->id], 'order' => 'sort']);
            $post->images = array_map(function ($image) {
                return $image->url;
            }, $images);
            $post->image = implode('', $post->images);
        }
        $postsArray = [];
        foreach ($posts as $post) {
            $postsArray[] = [
                'id' => $post->id,
                'title' => $post->title,
                'images' => $post->images,
                'content' => $post->content,
                'updated_at' => $post->updated_at
            ];
        }
        return $postsArray;
    }
}
