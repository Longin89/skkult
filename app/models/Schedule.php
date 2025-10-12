<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class Schedule extends Model
{
    public $id, $day_id, $gym, $arm, $step, $group, $kids;

    public function __construct()
    {
        $table = 'schedule';
        parent::__construct($table);
    }

    public function validator()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'day_id', 'msg' => 'День недели обязателен']));
    }
} 