@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button"
                        class="btn btn-success btn-open-modal"
                        data-target="setting_igroup"
                        data-clicked="IgroupForm.fetch_igroup">
                    <i class="icon-folder-open"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary igroup-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>{{ $formA['FormVars']['Title']['SaveButton'] }}</button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formA['SelectButtonOptions'],
                        'eventClassName' => 'igroup-act',
                    ])
                </div>
            </div>
            <div class="card" id="igroup-form">
                <div class="card-body mt-2" id="frm">
                    <input type="hidden" id="Id" name="Id" value="0">
                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IgroupCode'] }}>
                        <label>{{ $formA['FormVars']['Title']['IgroupCode'] }}</label>
                        <br>
                        <input type="text" id="igroup-code-txt" data-copy="true"
                               maxlength="{{ $formA['FormVars']['MaxLength']['IgroupCode'] }}"
                            {{ $formA['FormVars']['Required']['IgroupCode'] }}>
                    </div>
                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IgroupName'] }}>
                        <label>{{ $formA['FormVars']['Title']['IgroupName'] }}</label>
                        <br>
                        <input type="text" id="igroup-name-txt"
                               maxlength="{{ $formA['FormVars']['MaxLength']['IgroupName'] }}"
                            {{ $formA['FormVars']['Required']['IgroupName'] }}>
                    </div>
                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IgroupSlug'] }}>
                        <label>{{ $formA['FormVars']['Title']['IgroupSlug'] }}</label>
                        <br>
                        <input type="text" id="igroup-slug-txt"
                               maxlength="{{ $formA['FormVars']['MaxLength']['IgroupSlug'] }}"
                            {{ $formA['FormVars']['Required']['IgroupSlug'] }}>
                    </div>
                    <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsEndLevel'] }}>
                        <label>{{ $formA['FormVars']['Title']['IsEndLevel'] }}</label>
                        <br>
                        <input name="is-end-level" type="radio" value="1" id="is-end-level-radio-1" checked><label for="is-end-level-radio-1">Y</label>
                        <input name="is-end-level" type="radio" value="0" id="is-end-level-radio-2"><label for="is-end-level-radio-2">N</label>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('front.outline.static.setting-igroup')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script>
    $(document).ready(async function() {
        $('.igroup-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#igroup-form #frm', undefined, 'IgroupForm'); break;
                case 'new': Atype.btn_act_new('#igroup-form #frm'); break;
                case 'copy': Atype.btn_act_copy('#igroup-form #frm', undefined, 'IgroupForm'); break;
                case 'del': Atype.btn_act_del('#igroup-form #frm', undefined, 'IgroupForm'); break;
            }
        });
        Atype.set_parameter_callback(IgroupForm.parameter);
    });

    (function( IgroupForm, $, undefined ) {
        IgroupForm.formA = {!! json_encode($formA) !!};

        IgroupForm.parameter = function () {
            let id = Number( $('#igroup-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                IgroupName: $('#igroup-form').find('#igroup-name-txt').val(),
                IgroupCode: $('#igroup-form').find('#igroup-code-txt').val(),
                IgroupSlug: $('#igroup-form').find('#igroup-slug-txt').val(),
                IsEndLevel: $('#igroup-form').find(":input:radio[name=is-end-level]:checked").val()
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

        IgroupForm.fetch_igroup = async function (id) {
            let response = await get_api_data(IgroupForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            IgroupForm.set_igroup_ui(response)
        }

        IgroupForm.set_igroup_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting_igroup').modal('hide');
                return;
            }

            let igroup = response.data.Page[0];

            $('#igroup-form').find('#Id').val(igroup.Id)
            $('#igroup-form').find('#igroup-name-txt').val(igroup.IgroupName)
            $('#igroup-form').find('#igroup-code-txt').val(igroup.IgroupCode)
            $('#igroup-form').find('#igroup-slug-txt').val(igroup.IgroupSlug)
            $(`input:radio[name=is-end-level]:input[value=${igroup.IsEndLevel}]`).prop('checked', true);

            $('#modal-setting_igroup').modal('hide');
        }

    }( window.IgroupForm = window.IgroupForm || {}, jQuery ));

    const moealSetFile = {!! json_encode($moealSetFile) !!};
</script>
@endsection
