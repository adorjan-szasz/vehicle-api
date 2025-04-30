<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum VehicleType: string
{
    use EnumHelper;

    case CAR = 'CAR';
    case MOTORCYCLE = 'MOTORCYCLE';
    case TRUCK = 'TRUCK';
}
