<?php

use Modules\Product\Enums\TypeEnum;

return [
    TypeEnum::class =>[
        TypeEnum::INPUT->name=> 'متن تک خطی',
        TypeEnum::TEXTAREA->name=>'متن چند خطی',
        TypeEnum::CHECKBOX->name => 'چند انتخابی',
        TypeEnum::SELECT->name => 'تک انتخابی(سلکت)',
    ]
];
