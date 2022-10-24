<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseInterface;
use App\Helpers\CacheHelper;
use App\Helpers\CollectionHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $limit = request()->limit;
        $cacheTag = CacheHelper::getDefaultCacheTag();
        $cacheKey = CacheHelper::getDefaultCacheKey();
        $cacheExpiration = CacheHelper::getDefaultCacheExpiration();

        return Cache::tags([$cacheTag])->remember($cacheKey, $cacheExpiration, function () use ($limit) {
            if ($limit)
                return $this->model->paginate($limit);
            else
                return $this->model->all();
        });
    }

    /**
     * @param array $relationships
     * @return Builder
     */
    public function getWith(array $relationships)
    {
        return $this->model->with($relationships);
    }

    /**
     * @param array $filters
     * @return Builder
     */
    public function search(array $filters)
    {
        return $this->model->where($filters);
    }

    /**
     * @param string $identifier
     * @return Builder
     */
    public function find(string $identifier)
    {
        return $this->model->find($identifier);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        CacheHelper::flushByTag();

        return $this->model->create($attributes);
    }

    /**
     * @param Model $object
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $object, array $attributes)
    {
        CacheHelper::flushByTag();

        $object->update($attributes);

        return $object ?: null;
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function delete(Model $object)
    {
        CacheHelper::flushByTag();

        return $object->delete();
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function restore(Model $object)
    {
        CacheHelper::flushByTag();

        $object->restore();

        return $object ?: null;
    }

    /**
     * @param Model $object
     * @return mixed
     */
    public function forceDelete(Model $object)
    {
        CacheHelper::flushByTag();

        return $object->forceDelete();
    }

    /**
     * @param int $identifier
     * @return Model
     */
    public function findOrFail(int $identifier)
    {
        return $this->model->findOrFail($identifier);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $retriever, ?array $attributes = NULL)
    {
        CacheHelper::flushByTag();

        if ($attributes)
            return $this->model->firstOrCreate($retriever, $attributes);
        else
            return $this->model->firstOrCreate($retriever);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrNew(array $retriever, array $attributes)
    {
        return $this->model->firstOrNew($retriever, $attributes);
    }

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function updateOrCreate(array $retriever, array $attributes)
    {
        CacheHelper::flushByTag();

        return $this->model->updateOrCreate($retriever, $attributes);
    }

    /**
     * @return Model
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param object|array $object
     * @return mixed
     */
    public function getOrPaginate($object)
    {
        $limit = request()->limit;
        $page = request()->page;

        if (is_array($object)) {
            if ($limit)
                return (new CollectionHelper($object))->paginate($limit, $page);
            else
                return $object;
        } else {
            if ($limit)
                return $object->paginate($limit);
            else
                return $object->get();
        }
    }

    /**
     * @param object|array $object
     * @return mixed
     */
    public function paginate($object)
    {
        $limit = request()->limit ?? env('DEFAULT_PAGINATION_LIMIT', '10');
        $page = request()->page;

        if (is_array($object)) {
            if ($limit)
                return (new CollectionHelper($object))->paginate($limit, $page);
            else
                return $object;
        } else {
            if ($limit)
                return $object->paginate($limit);
            else
                return $object->get();
        }
    }
}
