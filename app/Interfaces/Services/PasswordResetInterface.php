<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface PasswordResetInterface extends BaseInterface
{
    public function updatePassword(User $user, string $password, string $remeberToken);
}
