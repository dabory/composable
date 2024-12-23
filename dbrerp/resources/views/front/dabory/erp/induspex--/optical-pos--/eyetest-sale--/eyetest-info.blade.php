<div class="card_inner" id="lens-frm">
    <!-- 첫번째 테이블 시작 -->
    <div class="tb_warp" style="max-width: 1250px">
        <div class="tb_before">
            <strong>4</strong>
        </div>

        @include('front.dabory.erp.induspex.optical-pos.eyetest-sale.partial.eye-lens-table', [
            'eyeLens' => $formB['EyeTestVars']['Title']['EyeLens'],
            'rightTitle' => 'R',
            'leftTitle' => 'L',
            'fixedTabindex' => 0,
            'className' => 'eye-lens-table'
        ])
    </div>
    <!--// 첫번째 테이블 끝 -->

    <!-- 두번째 테이블 시작 -->
    <div class="tb_warp mt-1" style="max-width: 1250px">
        <div class="tb_before">
            <div class="btn-group" style="width: 90px;">
                <button type="button" tabindex="-1" class="btn btn-sm btn-primary eyetest-act copy-button" data-value="copy">
                    {{ $formB['EyeTestVars']['Title']['Copy'] }}
                </button>
            </div>
        </div>

        <div class="table-responsive cont-lens-table">
            <table>
                <tr>
                    <th></th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Sph'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Cyl'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Axis'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Add'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Bc'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Dia'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Kerato'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Prescript'] }}</th>
                    <th>{{ $formB['EyeTestVars']['Title']['ContLens']['Adjust'] }}</th>
                    <th></th>
                </tr>
                <tr class="r-cont-lens">
                    <td>R</td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 sph-txt" type="text" tabindex="25">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text" tabindex="26">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 axis-txt" type="text" tabindex="27">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 add-txt" type="text" tabindex="31"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 bc-txt" type="text" tabindex="33"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 dia-txt" type="text" tabindex="35">&nbsp;mm</div>
                    </td>
                    <td class="kerato">
                        <div class="d-flex"><input class="rounded w-100 kerato-txt" type="text" tabindex="37"></div>
                    </td>
                    <td class="correct">
                        <div class="d-flex"><input class="rounded w-100 prescript-txt" type="text" tabindex="39"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text" tabindex="41"></div>
                    </td>
                    <td rowspan="2">
                        <div class="d-flex">
                            <button type="button" tabindex="-1" colspan="2" class="btn btn-primary w-100 text-nowrap overflow-hidden" id="eyetest-more-btn"
                            onclick="eyetest_more_show()">
                                {{ $formB['EyeTestVars']['Title']['More'] }}
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="l-cont-lens">
                    <td>L</td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 sph-txt" type="text" tabindex="28">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text" tabindex="29">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 axis-txt" type="text" tabindex="30">&nbsp;D</div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 add-txt" type="text" tabindex="32"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 bc-txt" type="text" tabindex="34"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 dia-txt" type="text" tabindex="36">&nbsp;mm</div>
                    </td>
                    <td class="kerato">
                        <div class="d-flex"><input class="rounded w-100 kerato-txt" type="text" tabindex="38"></div>
                    </td>
                    <td class="correct">
                        <div class="d-flex"><input class="rounded w-100 prescript-txt" type="text" tabindex="40"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text" tabindex="42"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!--// 두번째 테이블 끝 -->
</div>

@push('js')
    <script>
        function eyetest_more_show() {
            $('#modal-eyetest-more').trigger('show.prescript-detail');
        }

        $(document).ready(async function() {
            $(document).on('change', '.eye-lens-table input, .eye-lens-table select', function (e) {
                const pre_class_name = '.' + $(e.target).attr('class').split(' ').join('.')
                const tr_class_name = '.' + $(e.target).closest('tr').attr('class')

                $('.px-eye-lens-table').find(`${tr_class_name} ${pre_class_name}`).val($(e.target).val())
            });

            $(document).on('keypress', '.cont-lens-table input, .cont-lens-table select', function (e) {
                if (e.keyCode === 13) {
                    const tab = Number($(this).attr('tabindex')) + 1
                    $("[tabindex=" + tab + "]").focus();
                }
            });

            $(document).on('keydown','.cont-lens-table .sph-txt, .cont-lens-table .cyl-txt, .cont-lens-table .add-txt', function (e) {
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

            $(document).on('keydown','.cont-lens-table .base-o-txt, .cont-lens-table .base-d-txt, .cont-lens-table .bc-txt', function (e) {
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
