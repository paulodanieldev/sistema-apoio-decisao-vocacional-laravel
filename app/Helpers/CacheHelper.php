<?php

namespace App\Helpers;

use App\Constants\CacheConstants;
use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    public static function getDefaultCacheExpiration(): int
    {
        return CacheConstants::DEFAULT_CACHE_EXPIRATION;
    }

    public static function getDefaultCacheTag(?string $tag = NULL): string
    {
        $tag = $tag ?: auth()->user()->id ?? request()->ip();

        return "{$tag}_";
    }

    public static function getDefaultCacheKey(): string
    {
        $defaultKey = self::getDefaultCacheTag();
        $requestUri = request()->getRequestUri();

        return "{$defaultKey}{$requestUri}_";
    }

    public static function flushByTag(?string $tag = NULL): void
    {
        $tag = $tag ?: self::getDefaultCacheTag();

        Cache::tags([$tag])->flush();
    }
}
