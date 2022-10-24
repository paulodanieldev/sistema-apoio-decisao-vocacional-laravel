<?php

namespace App\Services;

use App\Interfaces\Repositories\SchoolReportsGradesInterface as SchoolReportsGradesRepositoryInterface;
use App\Interfaces\Services\SchoolReportsGradesInterface;
use App\Services\BaseService;

class SchoolReportsGradesService extends BaseService implements SchoolReportsGradesInterface
{
    protected $repository;

    public function __construct(SchoolReportsGradesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
