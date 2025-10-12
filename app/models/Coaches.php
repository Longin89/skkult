<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class Coaches extends Model
{
    public $id, $name, $subdesc, $description;

    public function __construct()
    {
        $table = 'coaches';
        parent::__construct($table);
    }

    public function afterSave()
    {
        if (empty($this->id)) {
            $this->id = $this->_db->lastID();
        }
    }

    public static function getCache() {
            $coaches = Coaches::find();
            foreach ($coaches as $coach) {
                $images = Images::find(['conditions' => 'coach_id = ?', 'bind' => [$coach->id], 'order' => 'sort']);
                $coach->images = array_map(function ($image) {
                    return $image->url;
                }, $images);
                $coach->image = implode('', $coach->images);
            }
            $coachesArray = [];
            foreach ($coaches as $coach) {
                $coachesArray[] = [
                    'id' => $coach->id,
                    'name' => $coach->name,
                    'subdesc' => $coach->subdesc,
                    'description' => $coach->description,
                    'image' => $coach->image,
                ];
            }
            return $coachesArray;
        }

    public function validator()
    {
        $requiredFields = ['name' => 'Имя', 'description' => 'Описание'];
        foreach ($requiredFields as $key => $val) {
            $this->runValidation(new RequiredValidator($this, ['field' => $key, 'msg' => 'Необходимо заполнить пункт <' . $val . '>']));
        }
    }
}
