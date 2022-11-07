<?php

namespace App\Entities;

use App\Models\User;

class AuthEntity
{
    public User $user;
    public string $accessToken;
    public string $refreshToken;
    public string $tokenType;
    public string $expiresAt;

    public function __construct(
        User $user,
        string $accessToken,
        string $refreshToken,
        string $tokenType,
        string $expiresAt
    ) {
        $this->user = $user;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->tokenType = $tokenType;
        $this->expiresAt = $expiresAt;
    }

    public function toArray(): array
    {
        return [
            'access_token'  => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'token_type'    => $this->tokenType,
            'expires_in'    => $this->expiresAt,
            'user'          => $this->user
        ];
    }
}
