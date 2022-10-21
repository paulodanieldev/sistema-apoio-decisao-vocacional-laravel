<?php

namespace App\Constants;

class AccountTypePrefixConstants
{

    const ADMIN = 1;
    const USER  = 2;

    /**
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::ADMIN => 'admin',
            self::USER  => 'user',
        ];
    }
}
