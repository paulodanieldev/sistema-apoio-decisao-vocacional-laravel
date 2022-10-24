<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SchoolReportsGradesInterface;
use App\Models\SchoolReportsGrades;
use App\Repositories\BaseRepository;

class SchoolReportsGradesRepository extends BaseRepository implements SchoolReportsGradesInterface
{
    protected $model;

    public function __construct(SchoolReportsGrades $model)
    {
        $this->model = $model;
    }
}
