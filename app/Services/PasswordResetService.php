<?php

namespace App\Services;

use App\Interfaces\Repositories\PasswordResetInterface as PasswordResetRepositoryInterface;
use App\Interfaces\Services\PasswordResetInterface;
use App\Models\User;
use App\Services\BaseService;

class PasswordResetService extends BaseService implements PasswordResetInterface
{
    protected $repository;

    public function __construct(PasswordResetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function updatePassword(User $user, string $password, string $remeberToken)
    {
        $inputs = ['password' => $password];

        $user->forceFill($inputs)->setRememberToken($remeberToken);
        $user->save();

        $this->repository->revokeTokens($user->email);
    }
}
