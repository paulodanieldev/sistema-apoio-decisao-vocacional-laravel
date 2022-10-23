<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolReportsGrades\DestroyRequest;
use App\Http\Requests\SchoolReportsGrades\IndexRequest;
use App\Http\Requests\SchoolReportsGrades\ShowRequest;
use App\Http\Requests\SchoolReportsGrades\StoreRequest;
use App\Http\Requests\SchoolReportsGrades\UpdateRequest;
use App\Http\Resources\DefaultResource;
use App\Interfaces\Services\SchoolReportsGradesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SchoolReportsGradesController extends Controller
{
    protected $service;

    public function __construct(SchoolReportsGradesInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Returns all items
     * @api {GET} /api/v1/school/reports/grades
     * @param IndexRequest $request
     * @return DefaultResource
     */
    public function index(IndexRequest $request): DefaultResource
    {
        $object = $this->service->all();

        return new DefaultResource($object);
    }

    /**
     * Returns a specific item
     * @api {GET} /api/v1/school/reports/grades/{grade}
     * @param ShowRequest $request
     * @return DefaultResource
     */
    public function show(ShowRequest $request): DefaultResource
    {
        $object = $request->grade;

        return new DefaultResource($object);
    }

    /**
     * Create a new item
     * @api {POST} /api/v1/school/reports/grades
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $object = $this->service->create($request->inputs);

        return (new DefaultResource($object))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update a specific item
     * @api {GET} /api/v1/school/reports/grades/{grade}
     * @param UpdateRequest $request
     * @return DefaultResource
     */
    public function update(UpdateRequest $request): DefaultResource
    {
        $object = $this->service->update($request->grade, $request->inputs);

        return new DefaultResource($object);
    }

    /**
     * Delete a specific item
     * @api {GET} /api/v1/school/reports/grades/{grade}
     * @param DestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request): JsonResponse
    {
        $this->service->delete($request->grade);

        return (new DefaultResource([]))
            ->response()
            ->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
