<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;

class Contacts extends Model
{
    public $id, $gis, $phone, $email, $vk, $whatsup, $telegram;

    public function __construct()
    {
        $table = 'contacts';
        parent::__construct($table);
    }

    public function validator()
    {
        $requiredFields = [
            'gis' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Email',
            'vk' => 'VK',
            'whatsup' => 'WhatsApp'
        ];
        foreach ($requiredFields as $key => $val) {
            $this->runValidation(new RequiredValidator($this, ['field' => $key, 'msg' => 'Необходимо заполнить пункт ' . "<$val>"]));
        }
    }
}
