<?php

namespace Modules\Base\Traits;

use Morilog\Jalali\Jalalian;

trait DateConvert
{
    public function dateConvert($column='created_at'){
        return Jalalian::forge($this->$column)->format("H:i Y/m/d");
    }
}
