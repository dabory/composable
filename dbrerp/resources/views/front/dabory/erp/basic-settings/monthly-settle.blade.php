@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card" id="monthly-settle-form">
                    <div class="card-body mt-2" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="bal_buyer" class="text-center mr-1" id="is-bal-buyer-check" checked>
                            <label class="mb-0" for="is-bal-buyer-check">{{ $formA['FormVars']['Title']['IsBalBuyer'] }}</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="bal_supplier" class="text-center mr-1" id="is-bal-supplier-check" checked>
                            <label class="mb-0" for="is-bal-supplier-check">{{ $formA['FormVars']['Title']['IsBalSupplier'] }}</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="bal_item" class="text-center mr-1" id="is-bal-item-check" checked>
                            <label class="mb-0" for="is-bal-item-check">{{ $formA['FormVars']['Title']['IsBalItem'] }}</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="bal_reward" class="text-center mr-1" id="is-bal-reward-check" checked>
                            <label class="mb-0" for="is-bal-reward-check">{{ $formA['FormVars']['Title']['IsBalReward'] }}</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" value="bal_credit" class="text-center mr-1" id="is-bal-credit-check" checked>
                            <label class="mb-0"
                            for="is-bal-credit-check">{{ $formA['FormVars']['Title']['IsBalCredit'] }}</label>
                        </div>

                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['YyyyMm'] }}>
                            <label class="m-0">{{ $formA['FormVars']['Title']['YyyyMm'] }}</label>
                            <br>
                            <input type="text" class="rounded w-sm-auto" id="yyyy-txt" data-copy="true"
                                maxlength="{{ $formA['FormVars']['MaxLength']['YyyyMm'] }}"
                                {{ $formA['FormVars']['Required']['YyyyMm'] }}>&nbsp;&nbsp;년&nbsp;&nbsp;
                            @php $todayMonth = date('n');@endphp
                            <select id = "mm-select" class="rounded">
                                @foreach($monthArr as $index => $month)
                                    <option value="{{ $index + 1 }}" @if($todayMonth == $index + 1) selected @endif>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary monthly-settle"
                                    data-value="re_calculation"
                                    {{ $formA['FormVars']['Hidden']['ReCalulationButton'] }}>
                                    {{ $formA['FormVars']['Title']['ReCalulationButton'] }}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script>
    $(document).ready(async function() {
        $('.monthly-settle').on('click', function () {
            switch( $(this).data('value') ) {
                case 're_calculation': MonthlySettleForm.btn_re_cal('#monthly-settle-form #frm', undefined, 'MonthlySettleForm'); break;
            }
        });

    });

    (function( MonthlySettleForm, $, undefined ) {
        MonthlySettleForm.formA = {!! json_encode($formA) !!};

        MonthlySettleForm.parameter = function () {
            let id = Number($('#monthly-settle-form').find('#Id').val());
            const yyyy = $('#monthly-settle-form').find('#yyyy-txt').val();
            const mm = $('#monthly-settle-form').find('#mm-select').val();
            const parameters = [];

            $('#monthly-settle-form').find('input[type="checkbox"]:checked').each(function() {
                parameters.push({
                    TableName: $(this).val(),
                    BalYyyyMm: yyyy+mm
                });
            });

            // console.log(parameters);
            return parameters;
        }

        MonthlySettleForm.fetch_monthly_settle = async function (id) {
            let response = await get_api_data(MonthlySettleForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            MonthlySettleForm.set_monthly_settle_ui(response)
        }

        MonthlySettleForm.set_monthly_settle_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting_monthly_settle').modal('hide');
                return;
            }

            let monthly_settle = response.data.Page[0];

            $('#monthly-settle-form').find('#Id').val(monthly_settle.Id)
            $('#monthly-settle-form').find('#monthly_settle-name-txt').val(monthly_settle.IgroupName)
            $('#monthly-settle-form').find('#monthly_settle-code-txt').val(monthly_settle.IgroupCode)
            $('#monthly-settle-form').find('#monthly_settle-slug-txt').val(monthly_settle.IgroupSlug)

            $('#modal-setting_monthly_settle').modal('hide');
        }

        MonthlySettleForm.change_tbl_name = async function (tbl_name) {
            let check_name;
            switch(tbl_name){
                case "bal_buyer":
                    check_name = "{{ $formA['FormVars']['Title']['IsBalBuyer'] }}"
                    break;
                case "bal_supplier":
                    check_name = "{{ $formA['FormVars']['Title']['IsBalSupplier'] }}"
                    break;
                case "bal_item":
                    check_name = "{{ $formA['FormVars']['Title']['IsBalItem'] }}"
                    break;
                case "bal_reward":
                    check_name = "{{ $formA['FormVars']['Title']['IsBalReward'] }}"
                    break;
                case "bal_credit":
                    check_name = "{{ $formA['FormVars']['Title']['IsBalCredit'] }}"
                    break;
            }
            return check_name;
        }

        MonthlySettleForm.check_input = async function (parameters) {
            if ($('#yyyy-txt').val() == '') {
                return iziToast.error({ title: 'Error', message: '정산년도를 입력해주세요. ex)2024' });
            }
            if(parameters.length == 0){
                return iziToast.error({ title: 'Error', message: '체크박스를 1개이상 체크해주세요.' });
            }
        }

        MonthlySettleForm.btn_re_cal = async function () {
            const parameters = MonthlySettleForm.parameter();
            MonthlySettleForm.check_input(parameters);

            for (const parameter of parameters) {
                const response = await get_api_data('monthly-settle', parameter);
                // const table_name = parameter['TableName'];
                const table_name = await MonthlySettleForm.change_tbl_name(parameter['TableName']);
                console.log('table_name : ', table_name);
                if (response && response.data.apiStatus) {
                    const status = response.data.apiStatus;
                    const message = response.data.body;
                    console.log(response);
                    return iziToast.error({ title: 'Error', message: `${table_name} : ${status}, ${message}` });
                }

                iziToast.success({ title: 'Success', message: `${table_name} 완료` });
                // console.log(response);
            }
        };

    }( window.MonthlySettleForm = window.MonthlySettleForm || {}, jQuery ));

</script>
@endsection
