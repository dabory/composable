@if ($paginator->hasPages())
    @php
        $totalPage = $paginator->lastPage();
        $pageGroup = ceil($paginator->currentPage() / 5);
        $last = $pageGroup * 5;
        $first = $last - 4;
        $last = ($overFlow = $last > $totalPage) ? $totalPage : $last;

    @endphp
{{--    {{ dd( $first) }}--}}
{{--    dd( $totalPage);--}}
{{--    {{ dd(($pageGroup - 1) * 5) }}--}}
{{--    {{ dd($paginator->currentPage()) }}--}}
{{--        {{ dd((($pageGroup + 1) * 5) - 4) }}--}}

    <ul class="custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->currentPage() <= 5)
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.first')">&laquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(($pageGroup - 1) * 5) }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @for ($page = $first; $page <= $last; $page++)
            @if ($page >= 1 && $page <= $paginator->lastPage())
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endif
        @endfor

{{--            {{ dd(ceil($totalPage / $paginator->perPage()) * $paginator->perPage() - $paginator->currentPage() >= 5) }}--}}
        {{-- Next Page Link --}}
        @if (! $overFlow && ! ($first + 5 > $totalPage))
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url( $first + 5 ) }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last" aria-label="@lang('pagination.last')">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>

@endif
