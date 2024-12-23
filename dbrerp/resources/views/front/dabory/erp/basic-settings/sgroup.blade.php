@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-1 pt-2 text-right">
                    <button type="button"
                            class="btn btn-success btn-open-modal"
                            data-target="setting"
                            data-clicked="SgroupForm.fetch_sgroup"
                            data-variable="SgroupForm.sgroupModal">
                        <i class="icon-folder-open"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary sgroup-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>{{ $formA['FormVars']['Title']['SaveButton'] }}</button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formA['SelectButtonOptions'],
                            'eventClassName' => 'sgroup-act',
                        ])
                    </div>
                </div>

                <div class="card" id="sgroup-form">
                    <div class="card-body mt-2" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group {{ $formA['FormVars']['Display']['BranchId'] }} flex-column mb-3">
                            <label class="m-0">{{ $formA['FormVars']['Title']['BranchId'] }}</label>
                            <div class="d-flex" style="width: 250px !important;">
                                <input type="text" id="branch-id-txt" data-id="0"
                                       class="radius-r0" autocomplete="off" disabled
                                       maxlength="{{ $formA['FormVars']['MaxLength']['BranchId'] }}"
                                    {{ $formA['FormVars']['Required']['BranchId'] }}>
                                <button type="button"
                                        class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 window company-modal-btn"
                                        data-target="setting"
                                        data-clicked="SgroupForm.fetch_branch"
                                        data-variable="SgroupForm.branchModal">
                                    <i class="icon-folder-open"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['SgroupCode'] }}>
                            <label>{{ $formA['FormVars']['Title']['SgroupCode'] }}</label>
                            <br>
                            <input type="text" id="sgroup-code-txt" data-copy="true"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SgroupCode'] }}"
                                {{ $formA['FormVars']['Required']['SgroupCode'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Sort'] }}>
                            <label>{{ $formA['FormVars']['Title']['Sort'] }}</label>
                            <br>
                            <select id="sort-select" style="width: 250px !important;"
                                    maxlength="{{ $formA['FormVars']['MaxLength']['Sort'] }}"
                                {{ $formA['FormVars']['Required']['Sort'] }}>
                                @foreach ($formA['SimpleSelectOptions'] as $key => $popupOption)
                                <option value="{{ $popupOption['Value'] }}">
                                    {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['SgroupName'] }}>
                            <label>{{ $formA['FormVars']['Title']['SgroupName'] }}</label>
                            <br>
                            <input type="text" id="sgroup-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SgroupName'] }}"
                                {{ $formA['FormVars']['Required']['SgroupName'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['SgroupManager'] }}>
                            <label>{{ $formA['FormVars']['Title']['SgroupManager'] }}</label>
                            <br>
                            <input type="text" id="sgroup-manager-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['SgroupManager'] }}"
                                {{ $formA['FormVars']['Required']['SgroupManager'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsUnused'] }}>
                            <label>{{ $formA['FormVars']['Title']['IsUnused'] }}</label>
                            <br>
                            <input type="checkbox" value="1" id="is-unused-check"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['IsUnused'] }}">
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
        SgroupForm.include_blades()

        $('.sgroup-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#sgroup-form #frm', undefined, 'SgroupForm'); break;
                case 'new':  SgroupForm.btn_act_new(); break;
                case 'copy': Atype.btn_act_copy('#sgroup-form #frm', undefined, 'SgroupForm'); break;
                case 'del': Atype.btn_act_del('#sgroup-form #frm', undefined, 'SgroupForm'); break;
            }
        });
        Atype.set_parameter_callback(SgroupForm.parameter);
    });

    (function( SgroupForm, $, undefined ) {
        SgroupForm.formA = {!! json_encode($formA) !!};
        SgroupForm.sgroupModal = {!! json_encode($moealSetFile) !!};
        SgroupForm.branchModal

        SgroupForm.btn_act_new = function () {
            $('#sgroup-form').find('#branch-id-txt').data('id', '')
            Atype.btn_act_new('#sgroup-form #frm');
        }

        SgroupForm.include_blades = async function() {
            const branch = await get_para_data('modal', '/search/setting-search/branch')
            SgroupForm.branchModal = branch['data']

            get_blades_html('front.outline.static.setting', SgroupForm.branchModal, function (html) {
                if ($('#element_in_which_to_insert').find('#modal-setting').length) return;
                // console.log(html)
                $('#element_in_which_to_insert').append(html);
            });
        }

        SgroupForm.parameter = function () {
            let id = Number( $('#sgroup-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                AgroupId: window.User['AgroupId'],
                BranchId: $('#sgroup-form').find('#branch-id-txt').data('id'),
                SgroupCode: $('#sgroup-form').find('#sgroup-code-txt').val(),
                SgroupName: $('#sgroup-form').find('#sgroup-name-txt').val(),
                Sort: $('#sgroup-form').find('#sort-select').val(),
                SgroupManager: $('#sgroup-form').find('#sgroup-manager-txt').val(),
                IsUnused: $('#sgroup-form').find('#is-unused-check:checked').val() ?? '0',
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

        SgroupForm.fetch_branch = async function (id) {
            let response = await get_api_data('branch-pick', {
                Page: [ { Id: id } ]
            })

            const branch = response.data.Page[0]
            $('#sgroup-form').find('#branch-id-txt').val(branch['BranchName'])
            $('#sgroup-form').find('#branch-id-txt').data('id', branch['Id'])

            $('#modal-setting').modal('hide');
        }

        SgroupForm.fetch_sgroup = async function (id) {
            let response = await get_api_data(SgroupForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            SgroupForm.set_sgroup_ui(response)
        }

        SgroupForm.set_sgroup_ui = async function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting').modal('hide');
                return;
            }

            let sgroup = response.data.Page[0];

            $('#sgroup-form').find('#Id').val(sgroup.Id)
            await SgroupForm.fetch_branch(sgroup.BranchId)
            $('#sgroup-form').find('#sgroup-code-txt').val(sgroup.SgroupCode)
            $('#sgroup-form').find('#sgroup-name-txt').val(sgroup.SgroupName)
            $('#sgroup-form').find('#sort-select').val(sgroup.Sort)
            $('#sgroup-form').find('#sgroup-manager-txt').val(sgroup.SgroupManager)
            $('#sgroup-form').find('#is-unused-check').prop('checked', sgroup.IsUnused == '1')

            $('#modal-setting').modal('hide');
        }

    }( window.SgroupForm = window.SgroupForm || {}, jQuery ));
</script>
@endsection
