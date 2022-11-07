<?php

namespace App\Entities;

class AuthTokenEntity
{
    public ?string $accessToken;
    public ?string $refreshToken;
    public ?string $tokenType;
    public ?string $expiresAt;

    public function __construct(
        ?string $accessToken,
        ?string $refreshToken,
        ?string $tokenType,
        ?string $expiresAt
    ) {
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
        ];
    }
}
