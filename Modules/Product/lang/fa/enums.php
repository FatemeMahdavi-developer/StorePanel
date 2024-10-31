<?php

use Modules\Product\Enums\TypeEnum;

return [
    TypeEnum::class =>[
        TypeEnum::INPUT->name => 'متن تک خطی',
        TypeEnum::CHECKBOX->name => 'چند انتخابی',
        TypeEnum::SELECT->name => 'تک انتخابی(سلکت)',
        TypeEnum::RADIO->name => 'تک انتخابی(ردیو باتن)',
    ]
];
