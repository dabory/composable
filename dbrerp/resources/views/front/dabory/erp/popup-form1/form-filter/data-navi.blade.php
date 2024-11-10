<div class="d-flex flex-column">
    <div>
        <button class="btn-light btn-light-100 mr-1 px-1 py-0 rounded text-grey btn-xxs line-height-1" id="{{ $navieName }}-prev-btn"
                onclick="PopupForm1FormFilterDataNavi.calc_date_rang('.{{ $navieName }}-div', $('input:radio[name={{ $navieName }}]:checked').val(), -1)" style="height:14px;">
            <i class="fas fa-angle-left"></i>
        </button>
        <button class="btn-light btn-light-100 rounded text-grey btn-xxs line-height-2" id="{{ $navieName }}-btn"
                onclick="PopupForm1FormFilterDataNavi.first_date_rang('.{{ $navieName }}-div', false, true)">
            일자방향(오늘)
        </button>
        <button class="btn-light btn-light-100 ml-1 px-1  py-0 rounded text-grey btn-xxs line-height-1" id="{{ $navieName }}-next-btn"
                onclick="PopupForm1FormFilterDataNavi.calc_date_rang('.{{ $navieName }}-div', $('input:radio[name={{ $navieName }}]:checked').val(), 1)" style="height:14px;">
            <i class="fas fa-angle-right"></i>
        </button>
    </div>
    <div class="d-flex align-items-center justify-content-around {{ $navieName }}-div" style="height: 28px;">
        @foreach ([
            [ 'Value' => 'day', 'Caption' => '일' ],
            [ 'Value' => 'week', 'Caption' => '주' ],
            [ 'Value' => 'month', 'Caption' => '월' ],
            [ 'Value' => 'quarterly', 'Caption' => '분기' ],
            [ 'Value' => 'semiannual', 'Caption' => '반기' ],
            [ 'Value' => 'year', 'Caption' => '년' ],
            [ 'Value' => 'all', 'Caption' => '전체' ],
        ] ?? [] as $key => $option)
            @empty($option['Caption'])
            @else
                <div class="d-flex align-items-center">
                    <input autocomplete="off" name="{{ $navieName }}" type="radio"
                           value="{{ $option['Value'] }}" id="{{ $navieName . '-' . ($key+1) }}">
                    <label for="{{ $navieName . '-' . ($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                    </label>
                </div>
            @endempty
        @endforeach
    </div>

    <div class="d-flex flex-column">
        <label class="m-0">날짜</label>
        <div class="d-flex">
            <input class="rounded overflow-hidden w-100 text-nowrap" onchange="change_type1_start_date(this)"
                   id="{{ $navieName }}-start-date" type="date" value="1990-01-01">
            <button class="btn disabled p-1 text-center">~</button>
            <input class="rounded overflow-hidden w-100 text-nowrap" id="{{ $navieName }}-end-date" type="date" value="3000-12-31">
        </div>
    </div>
</div>

@once
    @push('js')
        <script>
            $(document).ready(function() {
                PopupForm1FormFilterDataNavi.first_date_rang('.' + PopupForm1FormFilterDataNavi.navieName + '-div')
                $(`input:radio[name=${PopupForm1FormFilterDataNavi.navieName}]`).on('click', function (event, requery = true) {
                    PopupForm1FormFilterDataNavi.calc_date_rang('.' + PopupForm1FormFilterDataNavi.navieName + '-div', $(this).val(), 0, false, requery)
                });
            });

            (function( PopupForm1FormFilterDataNavi, $, undefined ) {
                PopupForm1FormFilterDataNavi.navieName = '{{ $navieName }}';

                PopupForm1FormFilterDataNavi.calc_date_rang = function (div_dom, date_val, mode, first = false, requery = true) {
                    if (mode === 0) {
                        if (! first) {
                            $(div_dom).data('current_date', $('#' + PopupForm1FormFilterDataNavi.navieName + '-start-date').val())
                        }
                    }

                    let firDay, lasDay, currDay;
                    [firDay, lasDay, currDay] = date_range_vending_machine(date_val, $(div_dom).data('current_date'), mode);

                    $('#' + PopupForm1FormFilterDataNavi.navieName + '-start-date').val(date_to_sting(firDay))
                    $('#' + PopupForm1FormFilterDataNavi.navieName + '-end-date').val(date_to_sting(lasDay))
                    $(div_dom).data('current_date', date_to_sting(currDay))
                }

                PopupForm1FormFilterDataNavi.first_date_rang = function (div_dom, first_date_search = true, requery = false) {
                    let date_input = $(div_dom).find('div').find('input:checked')
                    $(div_dom).data('current_date', moment(new Date()).format('YYYY-MM-DD'))

                    if (first_date_search) {
                        date_input = $(div_dom).find('div').last().find('input')
                        date_input.prop('checked', true)
                    }

                    PopupForm1FormFilterDataNavi.calc_date_rang(div_dom, date_input.val(), 0, true, requery)
                }
            }( window.PopupForm1FormFilterDataNavi = window.PopupForm1FormFilterDataNavi || {}, jQuery ));
        </script>
    @endpush
@endonce
