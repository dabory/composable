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
                            data-clicked="StorageForm.fetch_storage">
                        <i class="icon-folder-open"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary storage-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formA['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formA['SelectButtonOptions'],
                            'eventClassName' => 'storage-act',
                        ])
                    </div>
                </div>
                <div class="card" id="storage-form">
                    <div class="card-body mt-2" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['StorageCode'] }}>
                            <label>{{ $formA['FormVars']['Title']['StorageCode'] }}</label>
                            <br>
                            <input type="text" id="storage-code-txt" data-copy="true"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['StorageCode'] }}"
                                {{ $formA['FormVars']['Required']['StorageCode'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['StorageName'] }}>
                            <label>{{ $formA['FormVars']['Title']['StorageName'] }}</label>
                            <br>
                            <input type="text" id="storage-name-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['StorageName'] }}"
                                {{ $formA['FormVars']['Required']['StorageName'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['Location'] }}>
                            <label>{{ $formA['FormVars']['Title']['Location'] }}</label>
                            <br>
                            <input type="text" id="location-txt"
                                   maxlength="{{ $formA['FormVars']['MaxLength']['Location'] }}"
                                {{ $formA['FormVars']['Required']['Location'] }}>
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsMainStorage'] }}>
                            <label>{{ $formA['FormVars']['Title']['IsMainStorage'] }}</label>
                            <br>
                            <input type="checkbox" value="1" id="is-main-storage-check">
                        </div>
                        <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['IsBadStorage'] }}>
                            <label>{{ $formA['FormVars']['Title']['IsBadStorage'] }}</label>
                            <br>
                            <input type="checkbox" value="1" id="is-bad-storage-check">
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
        $('.storage-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#storage-form #frm', undefined, 'StorageForm'); break;
                case 'new': Atype.btn_act_new('#storage-form #frm'); break;
                case 'copy': Atype.btn_act_copy('#storage-form #frm', undefined, 'StorageForm'); break;
                case 'del': Atype.btn_act_del('#storage-form #frm', undefined, 'StorageForm'); break;
            }
        });
        Atype.set_parameter_callback(StorageForm.parameter);
    });

    (function( StorageForm, $, undefined ) {
        StorageForm.formA = {!! json_encode($formA) !!};

        StorageForm.parameter = function () {
            let id = Number( $('#storage-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                StorageCode: $('#storage-form').find('#storage-code-txt').val(),
                StorageName: $('#storage-form').find('#storage-name-txt').val(),
                Location: $('#storage-form').find('#location-txt').val(),
                IsMainStorage: $('#storage-form').find('#is-main-storage-check:checked').val() ?? '0',
                IsBadStorage: $('#storage-form').find('#is-bad-storage-check:checked').val() ?? '0',
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

        StorageForm.fetch_storage = async function (id) {
            let response = await get_api_data(StorageForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })

            StorageForm.set_storage_ui(response)
        }

        StorageForm.set_storage_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting').modal('hide');
                return;
            }

            let storage = response.data.Page[0];

            $('#storage-form').find('#Id').val(storage.Id)
            $('#storage-form').find('#storage-code-txt').val(storage.StorageCode)
            $('#storage-form').find('#storage-name-txt').val(storage.StorageName)
            $('#storage-form').find('#location-txt').val(storage.Location)
            $('#storage-form').find('#is-main-storage-check').prop('checked', storage.IsMainStorage == '1')
            $('#storage-form').find('#is-bad-storage-check').prop('checked', storage.IsBadStorage == '1')

            $('#modal-setting').modal('hide');
        }

    }( window.StorageForm = window.StorageForm || {}, jQuery ));

    const moealSetFile = {!! json_encode($moealSetFile) !!};
</script>
@endsection
