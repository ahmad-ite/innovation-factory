<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UrlHelper
{
    /**
     * return full url
     */
    public static function url($path)
    {
        switch (config('filesystems.default')) {
            case 's3':
                return config('global.media_url').$path;
                break;

            case 'public':
            case 'local':
                return Storage::url($path);
                break;
        }
    }
}