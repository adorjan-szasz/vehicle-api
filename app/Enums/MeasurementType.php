<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum MeasurementType: string
{
    use EnumHelper;

    case LITER = 'LITER';
    case CUBIC_FEET = 'CUBIC_FEET';
}
