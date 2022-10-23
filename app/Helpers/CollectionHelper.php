<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as BaseCollection;

class CollectionHelper extends BaseCollection
{
    /**
     * Transforma um array em collection para possível a paginação
     * @param int $perPage
     * @param int $total
     * @param int $page
     * @param string $pageName
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(?int $perPage = 20, ?int $page = null, ?int $total = null, ?string $pageName = 'page'): LengthAwarePaginator
    {
        $items = $this->forPage($page, $perPage)->values();
        $currentPage = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
        $total = $total ?: $this->count();

        $options = [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ];

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            $options
        );
    }
}
