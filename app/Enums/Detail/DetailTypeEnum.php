<?php

namespace App\Enums\Detail;

use App\Traits\EnumHelper;

enum DetailTypeEnum: string
{
    use EnumHelper;

    case DETAIL = 'detail';
    case BIO = 'bio';
}
