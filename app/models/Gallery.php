<?php

namespace App\Models;

use Core\Model;

class Gallery extends Model
{
    public $id, $alt_text;

    public function __construct()
    {

        $table = 'gallery';
        parent::__construct($table);
    }

    public static function getCache()
    {
        $galleryImages = Images::find(['conditions' => 'gallery_id = ?', 'bind' => [4], 'order' => 'sort']); // пофиксить номер галереи
        $galleryArray = [];
        foreach ($galleryImages as $image) {
            $galleryArray[] = [
                'url' => $image->url
            ];
        };
        return $galleryArray;
    }

    public function afterSave()
    {
        if (empty($this->id)) {
            $this->id = $this->_db->lastID();
        }
    }
}
