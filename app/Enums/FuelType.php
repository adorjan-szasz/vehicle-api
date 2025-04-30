<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum FuelType: string
{
    use EnumHelper;

    case Petrol = 'Petrol';
    case Diesel = 'Diesel';
    case Electric = 'Electric';
}
