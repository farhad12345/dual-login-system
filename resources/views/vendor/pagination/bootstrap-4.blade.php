<style>
    .table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    font-size: 14px;
    color: #333;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.table th {
    background-color: #007BFF;
    color: white;
}

.table tbody tr:nth-child(even) {
    background-color: #F2F2F2;
}

.table tbody tr:hover {
    background-color: #E9F7FF;
}

.pagination {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}

.pagination .page-item.active .page-link {
    background-color: #007BFF;
    border-color: #007BFF;
    color: white;
}

.pagination .page-link {
    color: #007BFF;
    padding: 8px 12px;
    margin: 0 4px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.pagination .page-link:hover {
    background-color: #E9F7FF;
    color: #0056b3;
}

</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
