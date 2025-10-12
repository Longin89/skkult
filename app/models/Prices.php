<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class Prices extends Model
{
    public $id, $title, $daypay, $monthly, $quarter, $halfyear, $yearly;

    public function __construct()
    {
        $table = 'prices';
        parent::__construct($table);
    }

    public function validator()
    {
        $requiredFields = [
            'title' => 'Название',
        ];
        foreach ($requiredFields as $key => $val) {
            $this->runValidation(new RequiredValidator($this, ['field' => $key, 'msg' => 'Необходимо заполнить пункт <' . $val . '>']));
        }
    }
} 