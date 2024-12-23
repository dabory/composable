@foreach ($listVars['Title'] as $key => $title)
    @if ($title == '$Radio')
        <th class="p-0" {{ $listVars['Hidden'][$key] }} style="width:{{ $listVars['Size'][$key] }}%;">
        </th>
    @elseif ($title == '$Check')
        <th class="p-0" {{ $listVars['Hidden'][$key] }} style="width:{{ $listVars['Size'][$key] }}%;">
            <input type="checkbox" class="all-check" tabindex="-1" onclick="checkbox_all_checked(this, '{{ $checkboxName }}')">
        </th>
    @else
        <th class="text-center" {{ $listVars['Hidden'][$key] }}
            tabindex="0" rowspan="1" colspan="1"
            style="width:{{ $listVars['Size'][$key] }}%;">
            {{ $title }}
        </th>
    @endif
@endforeach
