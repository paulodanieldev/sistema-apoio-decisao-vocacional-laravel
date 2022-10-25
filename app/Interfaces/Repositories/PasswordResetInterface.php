<?php

namespace App\Interfaces\Repositories;

interface PasswordResetInterface extends BaseInterface
{
    public function revokeTokens(string $email);
}
