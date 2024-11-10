<div class="table-responsive {{ $className }}">
    <table>
        <tr>
            <th></th>
            <th>{{ $eyeLens['Sph'] }}</th>
            <th>{{ $eyeLens['Cyl'] }}</th>
            <th>{{ $eyeLens['Axis'] }}</th>
            <th>{{ $eyeLens['LongPd'] }}</th>
            <th>{{ $eyeLens['Add'] }}</th>
            <th>{{ $eyeLens['ShortPd'] }}</th>
            <th>{{ $eyeLens['BaseIo'] }}</th>
            <th>{{ $eyeLens['BaseUd'] }}</th>
            <th>{{ $eyeLens['BareEye'] }}</th>
            <th>{{ $eyeLens['Adjust'] }}</th>
        </tr>
        <tr class="r-eye-lens">
            <td>{{ $rightTitle }}</td>
            <td>
                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text" tabindex="{{ 1 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text" tabindex="{{ 2 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text" tabindex="{{ 3 + $fixedTabindex }}">&nbsp;º&nbsp;</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 long-pd-txt" required type="text" tabindex="{{ 7 + $fixedTabindex }}">&nbsp;mm</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 add-txt" type="text" tabindex="{{ 9 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text" tabindex="{{ 11 + $fixedTabindex }}">&nbsp;mm</div>
            </td>
            <td class="base">
                <div class="d-flex">
                    <select class="rounded w-100 base-i-txt" tabindex="{{ 13 + $fixedTabindex }}">
                        <option value=""></option>
                        <option value="B.I">B.I</option>
                        <option value="B.O">B.O</option>
                    </select>
                    <input class="rounded w-100 base-o-txt" type="text" tabindex="{{ 14 + $fixedTabindex }}">&nbsp;△
                </div>
                {{--                        <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text">&nbsp;△</div>--}}
            </td>
            <td class="base">
                <div class="d-flex">
                    <select class="rounded w-100 base-u-txt" tabindex="{{ 15 + $fixedTabindex }}">
                        <option value=""></option>
                        <option value="B.U">B.U</option>
                        <option value="B.D">B.D</option>
                    </select>
                    <input class="rounded w-100 base-d-txt" type="text" tabindex="{{ 16 + $fixedTabindex }}">&nbsp;△
                </div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text" tabindex="{{ 21 + $fixedTabindex }}"></div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text" tabindex="{{ 23 + $fixedTabindex }}"></div>
            </td>
        </tr>
        <tr class="l-eye-lens">
            <td>{{ $leftTitle }}</td>
            <td>
                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text" tabindex="{{ 4 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text" tabindex="{{ 5 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text" tabindex="{{ 6 + $fixedTabindex }}">&nbsp;º&nbsp;</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 long-pd-txt" required type="text" tabindex="{{ 8 + $fixedTabindex }}">&nbsp;mm</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 add-txt" type="text" tabindex="{{ 10 + $fixedTabindex }}">&nbsp;D</div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text" tabindex="{{ 12 + $fixedTabindex }}">&nbsp;mm</div>
            </td>
            <td class="base">
                <div class="d-flex">
                    <select class="rounded w-100 base-i-txt" tabindex="{{ 17 + $fixedTabindex }}">
                        <option value=""></option>
                        <option value="B.I">B.I</option>
                        <option value="B.O">B.O</option>
                    </select>
                    <input class="rounded w-100 base-o-txt" type="text" tabindex="{{ 18 + $fixedTabindex }}">&nbsp;△
                </div>
            </td>
            <td class="base">
                <div class="d-flex">
                    <select class="rounded w-100 base-u-txt" tabindex="{{ 19 + $fixedTabindex }}">
                        <option value=""></option>
                        <option value="B.U">B.U</option>
                        <option value="B.D">B.D</option>
                    </select>
                    <input class="rounded w-100 base-d-txt" type="text" tabindex="{{ 20 + $fixedTabindex }}">&nbsp;△
                </div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text" tabindex="{{ 22 + $fixedTabindex }}"></div>
            </td>
            <td>
                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text" tabindex="{{ 24 + $fixedTabindex }}"></div>
            </td>
        </tr>
    </table>
</div>

@push('js')
    <script>
        $(document).ready(async function() {
            const className = '.' + {!! json_encode($className) !!};

            $(document).on('keypress', `${className} input, ${className} select`, function (e) {
                if (e.keyCode === 13) {
                    const tab = Number($(this).attr('tabindex')) + 1
                    $("[tabindex=" + tab + "]").focus();
                }
            });

            $(document).on('keydown', `${className} .sph-txt, ${className} .cyl-txt, ${className} .add-txt`, function (e) {
                // 엔터 or 탭키
                if (e.keyCode === 13 || e.keyCode === 9) {
                    let sign
                    const $this = $(e.target)
                    const val = $this.val()

                    if (isEmpty(val)) { return; }

                    if (val % 25 === 0) {
                        if ($this.hasClass('add-txt')) { sign = '+' }
                        else { sign = isNaN(val[0]) ? '+' : '-' }
                        $this.val(sign + format_decimal(val / 100, 2))

                        // e.target.blur();
                    } else {
                        iziToast.warning({ title: 'Warning', message: '0.25 단위로만 표기 가능' });
                        return false;
                    }
                }
            });

            $(document).on('keydown', `${className} .base-o-txt, ${className} .base-d-txt, ${className} .bc-txt`, function (e) {
                // 엔터 or 탭키
                if (e.keyCode === 13 || e.keyCode === 9) {
                    let sign
                    const $this = $(e.target)
                    const val = $this.val()

                    if (isEmpty(val)) { return; }

                    if (val % 5 === 0) {
                        $this.val(format_decimal(val / 100, 2))
                        // e.target.blur();
                    } else {
                        iziToast.warning({ title: 'Warning', message: '0.05 단위로만 표기 가능' });
                        return false;
                    }
                }
            });
        });
    </script>
@endpush
