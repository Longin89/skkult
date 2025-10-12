<?php
namespace App\Models;
use Core\Model;

class posts extends Model {
    public $id, $title, $content, $image_id, $created_at, $updated_at, $deleted = 0;

        public function __construct()
    {
        $table = 'posts';
        parent::__construct($table);
    }
}
?>