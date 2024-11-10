<button type="button" class="btn btn-sm dropdown-toggle dropdown-icon {{ $color ?? 'btn-primary ' }}" data-toggle="dropdown" aria-expanded="false">
    <span class="sr-only" style="padding-left: 10px;">Toggle Dropdown</span>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        @foreach ($selectBtns as $key => $btn)
            <li class="dropdown-item {{ $eventClassName }}" data-parameter="{{ $btn['ParameterName'] ?? '' }}" data-value="{{ $btn['Value'] }}"
            data-index="{{ $key }}" data-component="{{ $btn['Component'] ?? '' }}">
                {{ $btn['Caption'] }}
            </li>
            <li class="dropdown-divider"></li>
        @endforeach
    </ul>
</button>
