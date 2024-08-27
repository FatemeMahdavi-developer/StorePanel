<?php

namespace App\trait\admin;
use Morilog\Jalali\Jalalian;

trait date_convert
{
    public function date_convert($column='created_at',){
        return Jalalian::forge($this->$column)->format('h:i Y/m/d');
    }
}
