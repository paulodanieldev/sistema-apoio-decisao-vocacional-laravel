@if ($paginator->hasPages())
<div class="d-flex justify-content-between mt-2">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="page-item @if($paginator->onFirstPage()) disabled @endif">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item @if(!$paginator->hasMorePages()) disabled @endif">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" tabindex="-1">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            
        </ul>
    </nav>
    <span class="p-2">
        Exibindo 
        @if ($paginator->currentPage() == 1)
         1 a {{ $paginator->perPage() }}
        @else

         {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }} to {{ ($paginator->currentPage() - 1) * $paginator->perPage() + $paginator->count() }}
        @endif
         de {{$paginator->total()}} resultados
    </span>
</div>
@endif