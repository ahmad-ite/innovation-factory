<?php

namespace App\Enums\User;

use App\Traits\EnumHelper;

enum UserTypeEnum: string
{
    use EnumHelper;

    case USER = 'user';

}
