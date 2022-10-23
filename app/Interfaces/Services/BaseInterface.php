<?php

namespace App\Interfaces\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $relationships
     * @return Builder
     */
    public function getWith(array $relationships);

    /**
     * @param array $filters
     * @return Builder
     */
    public function search(array $filters);

    /**
     * @param string $identifier
     * @return Model
     */
    public function find(string $identifier);

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes);

    /**
     * @param Model $object
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $object, array $attributes);

    /**
     * @param Model $object
     * @return mixed
     */
    public function delete(Model $object);

    /**
     * @param Model $object
     * @return mixed
     */
    public function restore(Model $object);

    /**
     * @param Model $object
     * @return mixed
     */
    public function forceDelete(Model $object);

    /**
     * @param int $identifier
     * @return Model
     */
    public function findOrFail(int $identifier);

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $retriever, ?array $attributes = NULL);

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function firstOrNew(array $retriever, array $attributes);

    /**
     * @param array $retriever
     * @param array $attributes
     * @return Model
     */
    public function updateOrCreate(array $retriever, array $attributes);

    /**
     * @return Model
     */
    public function first();

    /**
     * @param object|array $object
     * @return mixed
     */
    public function getOrPaginate($object);

    /**
     * @param object|array $object
     * @return mixed
     */
    public function paginate($object);
}
