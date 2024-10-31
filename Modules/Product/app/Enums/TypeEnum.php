<?php

namespace Modules\Product\Enums;

enum TypeEnum :int
{
    case INPUT=1;
    case CHECKBOX=2;
    case SELECT=3;
    case RADIO=4;
}
