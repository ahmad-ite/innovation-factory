<?php

namespace App\Enums\User;

use App\Traits\EnumHelper;

enum UserPrefixnameEnum: string
{
    use EnumHelper;

    case MR = 'Mr';
    case MRS = 'Mrs';
    case MS = 'Ms';
}
