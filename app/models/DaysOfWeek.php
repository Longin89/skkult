<?php

namespace App\Models;

use Core\Model;

class DaysOfWeek extends Model
{
    public $id, $name;

    public function __construct()
    {
        $table = 'days_of_week';
        parent::__construct($table);
    }
} 