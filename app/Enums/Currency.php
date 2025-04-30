<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum Currency: string
{
    use EnumHelper;

    case EUR = 'EUR';
    case USD = 'USD';
    case RON = 'RON';
}
