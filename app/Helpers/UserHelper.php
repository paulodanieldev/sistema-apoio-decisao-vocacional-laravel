<?php

namespace App\Helpers;

use App\Constants\AccountTypePrefixConstants;
use App\Models\User;

class UserHelper
{
    /**
     * Generate refer coupon
     * @param User $user
     * @return mixed
     */
    public static function getUserAccountType(User $user): string
    {
        $accountType = $user->account_type;
        if ($accountType == AccountTypePrefixConstants::USER) {
            return 'user';
        } elseif ($accountType == AccountTypePrefixConstants::ADMIN) {
            return 'admin';
        } else {
            return 'user';
        }
    }
}