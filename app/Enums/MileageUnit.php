<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum MileageUnit: string
{
    use EnumHelper;

    case KM = 'KM';
    case MILE = 'MILE';
}
