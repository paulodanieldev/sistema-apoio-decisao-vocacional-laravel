<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PasswordResetInterface;
use App\Models\PasswordReset;
use App\Repositories\BaseRepository;

class PasswordResetRepository extends BaseRepository implements PasswordResetInterface
{
    protected $model;

    public function __construct(PasswordReset $model)
    {
        $this->model = $model;
    }

    public function revokeTokens(string $email)
    {
        $this->model->where('email', $email)->delete();
    }
}
