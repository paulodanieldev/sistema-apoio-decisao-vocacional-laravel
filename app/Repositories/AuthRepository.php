<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AuthInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository implements AuthInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
