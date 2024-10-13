<?php

namespace Modules\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SubidInCatid implements ValidationRule
{
    function __construct(public ?int $id) {
        $this->id = $id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value==$this->id){
            $fail("یک :attribute نمی تواند زیردسته بندی خودش باشد");
        }
    }
}
