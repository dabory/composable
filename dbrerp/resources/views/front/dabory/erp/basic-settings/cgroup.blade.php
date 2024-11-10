@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                {{-- act button include --}}
                <div class="mb-1 pt-2 text-right">
                    <button type="button"
                            class="btn btn-success btn-open-modal"
                            data-target="setting"
                            data-clicked="CgroupForm.fetch_cgroup">
                        <i class="icon-folder-open"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary cgroup-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>{{ $formA['FormVars']['Title']['SaveButton'] }}</button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formA['SelectButtonOptions'],
                            'eventClassName' => 'cgroup-act',
                        ])
                    </div>
                </div>
                <div class="card" id="cgroup-form">
                    <div class="card-body mt-2" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CgroupCode'] }}>
                            <label>{{ $formA['FormVars']['Title']['CgroupCode'] }}</label>
                            <br>
                            <input type="text" id="cgroup-code-txt" data-copy="true"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CgroupCode'] }}"
                                {{ $formA['FormVars']['Required']['CgroupCode'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CgroupName'] }}>
                            <label>{{ $formA['FormVars']['Title']['CgroupName'] }}</label>
                            <br>
                            <input type="text" id="cgroup-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CgroupName'] }}"
                                {{ $formA['FormVars']['Required']['CgroupName'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['CgroupManager'] }}>
                            <label>{{ $formA['FormVars']['Title']['CgroupManager'] }}</label>
                            <br>
                            <input type="text" id="cgroup-manager-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['CgroupManager'] }}"
                                {{ $formA['FormVars']['Required']['CgroupManager'] }}>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('front.outline.static.setting')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script>
    $(document).ready(async function() {
        $('.cgroup-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#cgroup-form #frm', undefined, 'CgroupForm'); break;
                case 'new': Atype.btn_act_new('#cgroup-form #frm'); break;
                case 'copy': Atype.btn_act_copy('#cgroup-form #frm', undefined, 'CgroupForm'); break;
                case 'del': Atype.btn_act_del('#cgroup-form #frm', undefined, 'CgroupForm'); break;
            }
        });
        Atype.set_parameter_callback(CgroupForm.parameter);
    });

    (function( CgroupForm, $, undefined ) {
        CgroupForm.formA = {!! json_encode($formA) !!};

        CgroupForm.parameter = function () {
            let id = Number( $('#cgroup-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                CgroupCode: $('#cgroup-form').find('#cgroup-code-txt').val(),
                CgroupName: $('#cgroup-form').find('#cgroup-name-txt').val(),
                CgroupManager: $('#cgroup-form').find('#cgroup-manager-txt').val(),
            }
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }
            // console.log(parameter)

            return parameter;
        }


        CgroupForm.fetch_cgroup = async function (id) {
            let response = await get_api_data(CgroupForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            CgroupForm.set_cgroup_ui(response)
        }

        CgroupForm.set_cgroup_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting').modal('hide');
                return;
            }

            let cgroup = response.data.Page[0];

            $('#cgroup-form').find('#Id').val(cgroup.Id)
            $('#cgroup-form').find('#cgroup-code-txt').val(cgroup.CgroupCode)
            $('#cgroup-form').find('#cgroup-name-txt').val(cgroup.CgroupName)
            $('#cgroup-form').find('#cgroup-manager-txt').val(cgroup.CgroupManager)

            $('#modal-setting').modal('hide');
        }

    }( window.CgroupForm = window.CgroupForm || {}, jQuery ));

    const moealSetFile = {!! json_encode($moealSetFile) !!};
</script>
@endsection
