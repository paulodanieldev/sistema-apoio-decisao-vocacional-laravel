<?php

namespace App\Services;

use App\Interfaces\Services\BaseInterface;
use App\Interfaces\Repositories\BaseInterface as BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements BaseInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * @param array $relationships
     * @return Builder
     */
    public function getWith(array $relationships)
    {
        return $this->repository->getWith($relationships);
    }

    /**
     * @param array $filters
     * @return Builder
     */
    public function search(array $filters)
    {
        return $this->repository->search($filters);
    }

    /**
     * @param string $identifier
     * @return Builder
     */
    public function find(string $identifier)
    {
        return $this->repository->find($identifier);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * @param Model $object
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $object, array $attributes)
    {
        return $this->repository->update($object, $attributes);
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function delete(Model $object)
    {
        return $this->repository->delete($object);
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function restore(Model $object)
    {
        return $this->repository->restore($object);
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function forceDelete(Model $object)
    {
        return $this->repository->forceDelete($object);
    }

    /**
     * @param int $identifier
     * @return Model
     */
    public function findOrFail(int $identifier)
    {
        return $this->repository->findOrFail($identifier);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $retriever, ?array $attributes = NULL)
    {
        return $this->repository->firstOrCreate($retriever, $attributes);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrNew(array $retriever, array $attributes)
    {
        return $this->repository->firstOrNew($retriever, $attributes);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function updateOrCreate(array $retriever, array $attributes)
    {
        return $this->repository->updateOrCreate($retriever, $attributes);
    }

    /**
     * @return Model
     */
    public function first()
    {
        return $this->repository->first();
    }

    /**
     * @param object|array $object
     * @return mixed
     */
    public function getOrPaginate($object)
    {
        return $this->repository->getOrPaginate($object);
    }

    /**
     * @param object|array $object
     * @return mixed
     */
    public function paginate($object)
    {
        return $this->repository->paginate($object);
    }
}
