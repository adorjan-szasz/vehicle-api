<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum ConsumptionUnit: string
{
    use EnumHelper;

    case LITER = 'LITER';
    case GALLON = 'GALLON';
    case KWH = 'KWH';
}
