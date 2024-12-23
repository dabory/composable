{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary sorder-situation-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'sorder-situation-act',
        ])
    </div>
</div>

<div class="card mb-2" id="sorder-situation-form">
    <div class="card-header" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="row">
            <div class="col-12 col-lg card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-header p-0 mb-2">
                    </div>
                    <div class="card-body">
                        @php
                            $situationList = collect($codeTitle['situation']['sorder'])->filter(function ($situation) {
                                return $situation['Code'] !== '' && $situation['Code'] !== 'ETC';
                            })->map(function ($situation) {
                                return array_merge($situation, ['Unique' => $situation['Code'][0]]);
                            })->groupBy('Unique')->toArray();
                        @endphp
                        @foreach ($situationList as $chunk)
                            <div class="d-flex align-items-center mb-2">
                            @forelse ($chunk as $key => $situation)
                                @if ($situation['Code'] !== '' && $situation['Code'] !== 'ETC')
                                    <div class="d-flex align-items-center mr-3">
                                        <input type="radio" name="sorder_situation" value="{{ $situation['Code'] }}" class="text-center mr-1" id="situation-radio-{{ $key }}">
                                        <label class="mb-0" for="situation-radio-{{ $key }}">
                                            {{ $situation['Title'] }}
                                        </label>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- @endsection --}}

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script>
            $(document).ready(async function() {
                $('.sorder-situation-act').on('click', function () {
                    // console.log($(this).data('value'))
                    switch( $(this).data('value') ) {
                        case 'save': PopupForm1FormAShopSorderSituationForm.btn_act_save(); break;
                        case 'del': PopupForm1FormAShopSorderSituationForm.btn_act_del(); break;
                    }
                });

                activate_button_group()
            });

            (function( PopupForm1FormAShopSorderSituationForm, $, undefined ) {
                PopupForm1FormAShopSorderSituationForm.formA = {!! json_encode($formA) !!};

                PopupForm1FormAShopSorderSituationForm.btn_act_new = function () {
                    $('#modal-select-popup.popup-form1-form-a-shop-sorder-situation-form .modal-dialog').css('maxWidth', '700px');

                    Atype.set_parameter_callback(PopupForm1FormAShopSorderSituationForm.parameter);
                    Atype.btn_act_new('#sorder-situation-form #frm');
                }

                PopupForm1FormAShopSorderSituationForm.btn_act_new_callback = function () {
                    PopupForm1FormAShopSorderSituationForm.btn_act_new()
                }

                PopupForm1FormAShopSorderSituationForm.parameter = function () {
                    const $sorder = $('#sorder-situation-form')
                    let id = Number($($sorder).find('#Id').val());
                    let parameter = {
                        Id: id,
                        Situation:  $(":input:radio[name=sorder_situation]:checked").val()
                    }
                    if (id < 0) {
                        parameter = { Id: id }
                    }

                    return parameter;
                }

                PopupForm1FormAShopSorderSituationForm.btn_act_save = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopSorderSituationForm.parameter);
                    Atype.btn_act_save('#sorder-situation-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopSorderSituationForm');
                }

                PopupForm1FormAShopSorderSituationForm.btn_act_del = function () {
                    Atype.set_parameter_callback(PopupForm1FormAShopSorderSituationForm.parameter);
                    Atype.btn_act_del('#sorder-situation-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PopupForm1FormAShopSorderSituationForm');
                }

                PopupForm1FormAShopSorderSituationForm.show_popup_callback = async function (id, c1) {
                    PopupForm1FormAShopSorderSituationForm.btn_act_new()
                    await PopupForm1FormAShopSorderSituationForm.fetch_sorder_situation(Number(id));
                }

                PopupForm1FormAShopSorderSituationForm.fetch_sorder_situation = async function (id) {
                    let response = await get_api_data(PopupForm1FormAShopSorderSituationForm.formA['General']['PickApi'], {
                        Page: [ { Id: id } ]
                    })

                    PopupForm1FormAShopSorderSituationForm.set_ui(response)
                }

                PopupForm1FormAShopSorderSituationForm.set_ui = function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let sorder = response.data.Page[0];

                    const $sorder = $('#sorder-situation-form')

                    $($sorder).find('#Id').val(sorder.Id)

                    $($sorder).find(`input:radio[name=sorder_situation]:input[value='${sorder['Situation']}']`).prop('checked', true)
                }

            }( window.PopupForm1FormAShopSorderSituationForm = window.PopupForm1FormAShopSorderSituationForm || {}, jQuery ));
        </script>
    @endpush
@endonce
