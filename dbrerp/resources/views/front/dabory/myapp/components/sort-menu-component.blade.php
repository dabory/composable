<div>
     @forelse($sortMenuPage as $sortMenu)
        <a class="dropdown-item" href="{{ route('myapp.change-sort-menu', $sortMenu['Id']) }}">
            <span class="icon" style="background-color: {{ '#' . $sortMenu['C3'] }}">
                <i class="{{ $sortMenu['C5'] }}"></i>
            </span>
            {{ DataConverter::format_func_sort_type('sort-type', $sortMenu['C2']) }}
        </a>
    @empty
    @endforelse
</div>
