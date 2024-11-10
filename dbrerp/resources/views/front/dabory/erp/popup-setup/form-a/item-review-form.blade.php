{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-setup-form-a-item-review-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary item-review-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
            @isset($formA['SelectButtonOptions'])
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'item-review-act',
                ])
            @endisset
        </div>
    </div>
    <div class="card mb-2" id="item-review-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="align-items-center mb-2 {{ $formA['FormVars']['Display']['OkItemReview'] }}">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="ok-item-review-check"> <label class="mb-0" for="ok-item-review-check">{{ $formA['FormVars']['Title']['OkItemReview'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PossibleIntervalDays'] }}</label>
                                <input type="text" id="possible-interval-days-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TextRewardPoint'] }}</label>
                                <input type="text" id="text-reward-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ImageRewardPoint'] }}</label>
                                <input type="text" id="image-reward-point-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Notice'] }}</label>
                                <textarea id="notice-textarea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- @endsection --}}

@once
    <script>
        $(document).ready(async function() {
            $('.item-review-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupSetupFormAItemReviewForm.btn_act_save(); break;
                }
            });

            // $(document).on('hide.bs.modal','.popup-setup-form-a-item-review-form.show', function () {
            //     const editor = $('#item-review-form').find('#froala-editor')[0]['data-froala.editor']
            //
            //     if (editor.codeView.isActive()) {
            //         editor.codeView.toggle()
            //     }
            // });

            activate_button_group()
        });

        (function( PopupSetupFormAItemReviewForm, $, undefined ) {
            PopupSetupFormAItemReviewForm.formA = {!! json_encode($formA) !!};

            PopupSetupFormAItemReviewForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#item-review-form #frm');
            }

            PopupSetupFormAItemReviewForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupSetupFormAItemReviewForm.parameter);

                Atype.btn_act_save('#item-review-form #frm', function () {

                    $('#modal-select-popup.show').trigger('list.requery')
                }, 'PopupSetupFormAItemReviewForm');
            }

            PopupSetupFormAItemReviewForm.setup_json_data = function () {
                const item_review_form = $('#item-review-form')

                return {
                    OkItemReview: $(item_review_form).find('#ok-item-review-check').is(':checked'),
                    PossibleIntervalDays: Number($(item_review_form).find('#possible-interval-days-txt').val()),
                    TextRewardPoint: Number($(item_review_form).find('#text-reward-point-txt').val()),
                    ImageRewardPoint: Number($(item_review_form).find('#image-reward-point-txt').val()),
                    Notice: $(item_review_form).find('#notice-textarea').val(),
                }
            }

            PopupSetupFormAItemReviewForm.parameter = function () {
                let id = Number($('#item-review-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    CreatedOn: get_now_time_stamp(),
                    UpdatedOn: get_now_time_stamp(),
                    SetupJson: JSON.stringify(PopupSetupFormAItemReviewForm.setup_json_data()),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                return parameter;
            }

            PopupSetupFormAItemReviewForm.btn_act_new = function () {
                $('#modal-select-popup.popup-setup-form-a-item-review-form .modal-dialog').css('maxWidth', '600px');

                Atype.btn_act_new('#item-review-form #frm');
            }

            PopupSetupFormAItemReviewForm.show_popup_callback = function (id, setup) {
                PopupSetupFormAItemReviewForm.btn_act_new()

                $('#item-review-form').find('#Id').val(id)

                PopupSetupFormAItemReviewForm.set_item_review_ui(setup)
            }

            PopupSetupFormAItemReviewForm.set_item_review_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const item_review_form = $('#item-review-form')

                $(item_review_form).find('#ok-item-review-check').prop('checked', setup['OkItemReview'])
                $(item_review_form).find('#possible-interval-days-txt').val(setup['PossibleIntervalDays'])
                $(item_review_form).find('#text-reward-point-txt').val(setup['TextRewardPoint'])
                $(item_review_form).find('#image-reward-point-txt').val(setup['ImageRewardPoint'])
                $(item_review_form).find('#notice-textarea').val(setup['Notice'])
            }

        }( window.PopupSetupFormAItemReviewForm = window.PopupSetupFormAItemReviewForm || {}, jQuery ));
    </script>
@endonce
