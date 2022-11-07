<?php

namespace App\Interfaces\Services;

use App\Entities\AuthEntity;
use App\Models\User;

interface AuthInterface extends BaseInterface
{
    /**
     * Create a user token
     * @param User $user
     * @param bool|null $rememberMe
     * @param string|null $tokenExpiresAt
     * @return array
     */
    public function createToken(User $user, ?string $password, ?bool $rememberMe = false): AuthEntity;

    /**
     * @return bool
     */
    public function revokeToken(?User $user): bool;

    public function refreshToken(string $refreshToken);
}
