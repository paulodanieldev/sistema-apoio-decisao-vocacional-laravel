<?php

namespace App\Services;

use App\Entities\AuthEntity;
use App\Helpers\AuthHelper;
use App\Interfaces\Repositories\AuthInterface as AuthRepositoryInterface;
use App\Interfaces\Services\AuthInterface;
use App\Models\User;
use App\Services\BaseService;

class AuthService extends BaseService implements AuthInterface
{
    /**
     * @var AuthRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor method
     * @param AuthRepositoryInterface $repository
     */
    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a user token
     * @param User $user
     * @param bool|null $rememberMe
     * @param string|null $tokenExpiresAt
     * @return array
     */
    public function createToken(User $user, ?string $password, ?bool $rememberMe = false): AuthEntity
    {
        // Revoke other tokens
        $userTokens = $user->tokens;
        foreach ($userTokens as $token) $token->revoke();

        return AuthHelper::createToken($user, $password, $rememberMe);
    }

    /**
     * @return bool
     */
    public function revokeToken(?User $user): bool
    {
        return AuthHelper::revokeToken($user);
    }

    public function refreshToken(string $refreshToken)
    {
        return AuthHelper::refreshToken($refreshToken);
    }
}
