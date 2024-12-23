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
                            data-clicked="BranchForm.fetch_branch">
                        <i class="icon-folder-open"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary branch-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formA['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formA['SelectButtonOptions'],
                            'eventClassName' => 'branch-act',
                        ])
                    </div>
                </div>
                <div class="card" id="branch-form">
                    <div class="card-body mt-2" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['BranchCode'] }}>
                            <label>{{ $formA['FormVars']['Title']['BranchCode'] }}</label>
                            <br>
                            <input type="text" id="branch-code-txt" data-copy="true"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['BranchCode'] }}"
                                {{ $formA['FormVars']['Required']['BranchCode'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['BranchName'] }}>
                            <label>{{ $formA['FormVars']['Title']['BranchName'] }}</label>
                            <br>
                            <input type="text" id="branch-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['BranchName'] }}"
                                {{ $formA['FormVars']['Required']['BranchName'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['BranchManager'] }}>
                            <label>{{ $formA['FormVars']['Title']['BranchManager'] }}</label>
                            <br>
                            <input type="text" id="branch-manager-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['BranchManager'] }}"
                                {{ $formA['FormVars']['Required']['BranchManager'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsUnused'] }}>
                            <label>{{ $formA['FormVars']['Title']['IsUnused'] }}</label>
                            <br>
                            <input type="checkbox" value="1" id="is-unused-check">
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
        $('.branch-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#branch-form #frm', undefined, 'BranchForm'); break;
                case 'new': Atype.btn_act_new('#branch-form #frm'); break;
                case 'copy': Atype.btn_act_copy('#branch-form #frm', undefined, 'BranchForm'); break;
                case 'del': Atype.btn_act_del('#branch-form #frm', undefined, 'BranchForm'); break;
            }
        });
        Atype.set_parameter_callback(BranchForm.parameter);
    });

    (function( BranchForm, $, undefined ) {
        BranchForm.formA = {!! json_encode($formA) !!};

        BranchForm.parameter = function () {
            let id = Number( $('#branch-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                BranchCode: $('#branch-form').find('#branch-code-txt').val(),
                BranchName: $('#branch-form').find('#branch-name-txt').val(),
                BranchManager: $('#branch-form').find('#branch-manager-txt').val(),
                IsUnused: $('#branch-form').find('#is-unused-check:checked').val() ?? '0',
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

        BranchForm.fetch_branch = async function (id) {
            let response = await get_api_data(BranchForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            BranchForm.set_branch_ui(response)
        }

        BranchForm.set_branch_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting').modal('hide');
                return;
            }

            let branch = response.data.Page[0];

            $('#branch-form').find('#Id').val(branch.Id)
            $('#branch-form').find('#branch-code-txt').val(branch.BranchCode)
            $('#branch-form').find('#branch-name-txt').val(branch.BranchName)
            $('#branch-form').find('#branch-manager-txt').val(branch.BranchManager)
            $('#branch-form').find('#is-unused-check').prop('checked', branch.IsUnused == '1')

            $('#modal-setting').modal('hide');
        }

    }( window.BranchForm = window.BranchForm || {}, jQuery ));
    const moealSetFile = {!! json_encode($moealSetFile) !!};
</script>
@endsection
