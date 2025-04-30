<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum MotorcycleStyle: string
{
    use EnumHelper;

    case CRUISER = 'Cruiser';
    case SPORT = 'Sport';
    case TOURING = 'Touring';
    case ADVENTURE = 'Adventure';
    case MOPED = 'Moped';
    case CAFE_RACER = 'Cafe_Racer';
    case BOBBER = 'Bobber';
}
