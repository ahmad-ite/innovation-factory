<?php

namespace App\Enums\Detail;

use App\Enums\User\UserPrefixnameEnum;
use App\Models\User;
use App\Traits\EnumHelper;

enum DetailKeysEnum: string
{
    use EnumHelper;

    case FULL_NAME = 'Full name';
    case MIDDLE_INITIAL = 'Middle Initial';
    case AVATAR = 'Avatar';
    case GENDER = 'Gender';

    public static function getKeysValues(User $user): array
    {
        return [
            self::FULL_NAME->value => $user->fullname,
            self::MIDDLE_INITIAL->value => $user->middleinitial,
            self::AVATAR->value => $user->avatar,
            self::GENDER->value => $user->prefixname == UserPrefixnameEnum::MR->value ? 'Mail' : 'Femail',
        ];
    }
}
