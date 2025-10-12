<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class About extends Model
{
    public $id, $title, $content;

    public function __construct()
    {
        $table = 'about';
        parent::__construct($table);
    }

    public function validator()
    {
        $requiredFields = ['title' => 'Заголовок', 'content' => 'Содержание'];
        foreach ($requiredFields as $key => $val) {
            $this->runValidation(new RequiredValidator($this, ['field' => $key, 'msg' => 'Необходимо заполнить пункт ' . "<$val>"]));
        }
    }
}
