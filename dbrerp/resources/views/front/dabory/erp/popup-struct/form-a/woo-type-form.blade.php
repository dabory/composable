{{-- @extends('layouts.master')
@section('content') --}}

<div id="popup-struct-form-a-woo-type-form">
    <div class="mb-1 pt-2 text-right btn-groups">
        <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                Loading...
        </button>
        <div class="btn-group" hidden>
            <button type="button" class="btn btn-sm btn-primary user-credit-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                {{ $formA['FormVars']['Title']['SaveButton'] }}
            </button>
        </div>
    </div>
    <div class="card mb-2" id="woo-type-form">
        <div class="card-header" id="frm">
            <div class="row">
                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                             <p class="card-title p-1 ml-2">Url</p>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="align-items-center mb-2">
                                <input type="checkbox" tabindex="-1" value="1" class="text-center mr-1" id="is-html-match-check"> <label class="mb-0" for="is-html-match-check">{{ $formA['FormVars']['Title']['IsHtmlMatch'] }}</label>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['HtmlMatchStr'] }}</label>
                                <input type="text" id="html-match-str-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PdpRegEx'] }}</label>
                                <input type="text" id="pdp-reg-ex-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['PlpRegEx'] }}</label>
                                <input type="text" id="plp-reg-ex-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                            <p class="card-title p-1 ml-2">Css-Card2(1)</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ItemName'] }}</label>
                                <input type="text" id="item-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Categories'] }}</label>
                                <input type="text" id="categorys-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Currency'] }}</label>
                                <input type="text" id="currency-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SalesPrice'] }}</label>
                                <input type="text" id="sales-price-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Images'] }}</label>
                                <input type="text" id="images-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ShortDesc'] }}</label>
                                <input type="text" id="short-desc-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['TextDesc'] }}</label>
                                <input type="text" id="text-desc-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Tags'] }}</label>
                                <input type="text" id="tags-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Emails'] }}</label>
                                <input type="text" id="e-mails-txt" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg card-header-item">
                    <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                            <p class="card-title p-1 ml-2">Css-Card2(2)</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Language'] }}</label>
                                <input type="text" id="language-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['BrandName'] }}</label>
                                <input type="text" id="brand-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Manufacturer'] }}</label>
                                <input type="text" id="manufacturer-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Sku'] }}</label>
                                <input type="text" id="sku-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Options'] }}</label>
                                <input type="text" id="options-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['UserCredit'] }}</label>
                                <input type="text" id="user-credit-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ModelNo'] }}</label>
                                <input type="text" id="model-no-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ModelName'] }}</label>
                                <input type="text" id="model-name-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            {{--                            <div class="d-flex flex-column mb-2">--}}
                            {{--                                <div class="d-flex align-items-center">--}}
                            {{--                                    <label class="m-0">{{ $formA['FormVars']['Title']['ItemCategory'] }}</label>--}}
                            {{--                                    <button class="ml-1 btn-danger" @click="addItemCategories"><i class="fas fa-plus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="d-flex align-items-center mb-1" v-for="(ItemCategory, index) in ItemCategories">--}}
                            {{--                                    <input type="text" id="item-category-txt" v-model="ItemCategories[index]"--}}
                            {{--                                           class="rounded w-100 mr-1" autocomplete="off">--}}
                            {{--                                    <button @click="removeItemCategories(index)"><i class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Origin'] }}</label>
                                <input type="text" id="origin-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['OriginDesc'] }}</label>
                                <input type="text" id="origin-desc-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MinimumQty'] }}</label>
                                <input type="text" id="minimum-qty-txt" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['DeliveryPrice'] }}</label>
                                <input type="text" id="delivery-price-txt" class="rounded w-100" autocomplete="off">
                            </div>

                            {{--                            <div class="d-flex flex-column mb-2">--}}
                            {{--                                <div class="d-flex align-items-center">--}}
                            {{--                                    <label class="m-0">{{ $formA['FormVars']['Title']['Options'] }}</label>--}}
                            {{--                                    <button class="ml-1 btn-danger" @click="addOptions"><i class="fas fa-plus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="d-flex align-items-center mb-1" v-for="(Option, index) in Options">--}}
                            {{--                                    <input type="text" id="options-txt" v-model="Options[index]"--}}
                            {{--                                           class="rounded w-100 mr-1" autocomplete="off">--}}
                            {{--                                    <button @click="removeOptions(index)"><i class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="d-flex flex-column mb-2">--}}
                            {{--                                <div class="d-flex align-items-center">--}}
                            {{--                                    <label class="m-0">{{ $formA['FormVars']['Title']['Images'] }}</label>--}}
                            {{--                                    <button class="ml-1 btn-danger" @click="addImages"><i class="fas fa-plus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="d-flex align-items-center mb-1" v-for="(Image, index) in Images">--}}
                            {{--                                    <input type="text" id="images-txt" v-model="Images[index]"--}}
                            {{--                                           class="rounded w-100 mr-1" autocomplete="off">--}}
                            {{--                                    <button @click="removeImages(index)"><i class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="d-flex flex-column mb-2">--}}
                            {{--                                <div class="d-flex align-items-center">--}}
                            {{--                                    <label class="m-0">{{ $formA['FormVars']['Title']['Suggest'] }}</label>--}}
                            {{--                                    <button class="ml-1 btn-danger" @click="addSuggest"><i class="fas fa-plus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="d-flex align-items-center mb-1" v-for="(Sug, index) in Suggest">--}}
                            {{--                                    <input type="text" id="suggest-txt" v-model="Suggest[index]"--}}
                            {{--                                           class="rounded w-100 mr-1" autocomplete="off">--}}
                            {{--                                    <button @click="removeSuggest(index)"><i class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="d-flex flex-column mb-2">--}}
                            {{--                                <div class="d-flex align-items-center">--}}
                            {{--                                    <label class="m-0">{{ $formA['FormVars']['Title']['Cats'] }}</label>--}}
                            {{--                                    <button class="ml-1 btn-danger" @click="addCats"><i class="fas fa-plus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="d-flex align-items-center mb-1" v-for="(cat, index) in Cats">--}}
                            {{--                                    <input type="text" id="cats-txt" v-model="Cats[index]"--}}
                            {{--                                           class="rounded w-100 mr-1" autocomplete="off">--}}
                            {{--                                    <button @click="removeCats(index)"><i class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
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
        const popupStructFormAWooTypeForm = new Vue({
            el: '#popup-struct-form-a-woo-type-form',

            data: function () {
                return {
                    ItemCategories: [],
                    Options: [],
                    Images: [],
                    Suggest: [],
                    Cats: [],
                }
            },

            computed: {
            },

            mounted () {
                console.log('asas')
            },

            methods: {
                addItemCategories: function () {
                    this.ItemCategories.push('')
                },
                removeItemCategories: function (index) {
                    this.ItemCategories.splice(index, 1)
                },

                addOptions: function () {
                    this.Options.push('')
                },
                removeOptions: function (index) {
                    this.Options.splice(index, 1)
                },

                addImages: function () {
                    this.Images.push('')
                },
                removeImages: function (index) {
                    this.Images.splice(index, 1)
                },

                addSuggest: function () {
                    this.Suggest.push('')
                },
                removeSuggest: function (index) {
                    this.Suggest.splice(index, 1)
                },

                addCats: function () {
                    this.Cats.push('')
                },
                removeCats: function (index) {
                    this.Cats.splice(index, 1)
                },
            }
        });

        $(document).ready(async function() {
            $('.user-credit-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupStructFormAWooTypeForm.btn_act_save(); break;
                }
            });

            activate_button_group()
        });

        (function( PopupStructFormAWooTypeForm, $, undefined ) {
            PopupStructFormAWooTypeForm.formA = {!! json_encode($formA) !!};

            PopupStructFormAWooTypeForm.btn_act_new_callback = function () {
                Atype.btn_act_new('#woo-type-form #frm');
            }

            PopupStructFormAWooTypeForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupStructFormAWooTypeForm.parameter);

                Atype.btn_act_save('#woo-type-form #frm', function () {
                    $('#modal-select-popup.show').trigger('list.requery')
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupStructFormAWooTypeForm');
            }

            PopupStructFormAWooTypeForm.request_data = function () {
                const woo_type_form = $('#woo-type-form')

                return {
                    Url: {
                        IsHtmlMatch: $(woo_type_form).find('#is-html-match-check').is(':checked'),
                        HtmlMatchStr: $(woo_type_form).find('#html-match-str-txt').val(),
                        PdpRegEx: $(woo_type_form).find('#pdp-reg-ex-txt').val(),
                        PlpRegEx: $(woo_type_form).find('#plp-reg-ex-txt').val(),
                    },
                    Css: {
                        ItemName: $(woo_type_form).find('#item-name-txt').val(),
                        Categories: $(woo_type_form).find('#categorys-txt').val(),
                        Currency: $(woo_type_form).find('#currency-txt').val(),
                        SalesPrice: $(woo_type_form).find('#sales-price-txt').val(),
                        Images: $(woo_type_form).find('#images-txt').val(),
                        ShortDesc: $(woo_type_form).find('#short-desc-txt').val(),
                        TextDesc: $(woo_type_form).find('#text-desc-txt').val(),
                        Tags: $(woo_type_form).find('#tags-txt').val(),
                        Emails: $(woo_type_form).find('#e-mails-txt').val(),

                        Language: $(woo_type_form).find('#language-txt').val(),
                        BrandName: $(woo_type_form).find('#brand-name-txt').val(),
                        Manufacturer: $(woo_type_form).find('#manufacturer-txt').val(),
                        Sku: $(woo_type_form).find('#sku-txt').val(),
                        Options: $(woo_type_form).find('#options-txt').val(),
                        UserCredit: $(woo_type_form).find('#user-credit-txt').val(),
                        ModelNo: $(woo_type_form).find('#model-no-txt').val(),
                        ModelName: $(woo_type_form).find('#model-name-txt').val(),
                        Origin: $(woo_type_form).find('#origin-txt').val(),
                        OriginDesc: $(woo_type_form).find('#origin-desc-txt').val(),
                        MinimumQty: $(woo_type_form).find('#minimum-qty-txt').val(),
                        DeliveryPrice: $(woo_type_form).find('#delivery-price-txt').val(),

                        // ItemCategory: popupStructFormAWooTypeForm.ItemCategories,
                        // Options: popupStructFormAWooTypeForm.Options,
                        // Images: popupStructFormAWooTypeForm.Images,
                        // Suggest: popupStructFormAWooTypeForm.Suggest,
                        // Cats: popupStructFormAWooTypeForm.Cats,
                    }
                }
            }

            PopupStructFormAWooTypeForm.parameter = function () {
                const woo_type_form = $('#woo-type-form')
                let setup = PopupStructFormAWooTypeForm.request_data()
                let id = Number($(woo_type_form).find('#Id').val());
                let parameter = {
                    Id: id,
                    StructJson: JSON.stringify(setup),
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

            PopupStructFormAWooTypeForm.show_popup_callback = async function (id, setup) {
                Atype.btn_act_new('#woo-type-form #frm');
                $('#woo-type-form').find('#Id').val(id)
                PopupStructFormAWooTypeForm.set_ui(setup)
            }

            PopupStructFormAWooTypeForm.set_ui = function (setup) {
                if (_.isEmpty(setup)) return;

                const woo_type_form = $('#woo-type-form')
                const woo_url = setup['Url']
                const woo_css = setup['Css']

                if (woo_url) {
                    $(woo_type_form).find('#is-html-match-check').prop('checked', woo_url['IsHtmlMatch'])
                    $(woo_type_form).find('#html-match-str-txt').val(woo_url['HtmlMatchStr'])
                    $(woo_type_form).find('#pdp-reg-ex-txt').val(woo_url['PdpRegEx'])
                    $(woo_type_form).find('#plp-reg-ex-txt').val(woo_url['PlpRegEx'])
                }

                if (woo_css) {
                    $(woo_type_form).find('#item-name-txt').val(woo_css['ItemName'])
                    $(woo_type_form).find('#categorys-txt').val(woo_css['Categories'])
                    $(woo_type_form).find('#currency-txt').val(woo_css['Currency'])
                    $(woo_type_form).find('#sales-price-txt').val(woo_css['SalesPrice'])
                    $(woo_type_form).find('#images-txt').val(woo_css['Images'])
                    $(woo_type_form).find('#short-desc-txt').val(woo_css['ShortDesc'])
                    $(woo_type_form).find('#text-desc-txt').val(woo_css['TextDesc'])
                    $(woo_type_form).find('#tags-txt').val(woo_css['Tags'])
                    $(woo_type_form).find('#e-mails-txt').val(woo_css['Emails'])

                    $(woo_type_form).find('#language-txt').val(woo_css['Language'])
                    $(woo_type_form).find('#brand-name-txt').val(woo_css['BrandName'])
                    $(woo_type_form).find('#manufacturer-txt').val(woo_css['Manufacturer'])
                    $(woo_type_form).find('#sku-txt').val(woo_css['Sku'])
                    $(woo_type_form).find('#options-txt').val(woo_css['Options'])
                    $(woo_type_form).find('#user-credit-txt').val(woo_css['UserCredit'])
                    $(woo_type_form).find('#model-no-txt').val(woo_css['ModelNo'])
                    $(woo_type_form).find('#model-name-txt').val(woo_css['ModelName'])
                    $(woo_type_form).find('#origin-txt').val(woo_css['Origin'])
                    $(woo_type_form).find('#origin-desc-txt').val(woo_css['OriginDesc'])
                    $(woo_type_form).find('#minimum-qty-txt').val(woo_css['MinimumQty'])
                    $(woo_type_form).find('#delivery-price-txt').val(woo_css['DeliveryPrice'])

                    // popupStructFormAWooTypeForm.ItemCategories = woo_css['ItemCategory']
                    // popupStructFormAWooTypeForm.Options = woo_css['Options']
                    // popupStructFormAWooTypeForm.Images = woo_css['Images']
                    // popupStructFormAWooTypeForm.Suggest = woo_css['Suggest']
                    // popupStructFormAWooTypeForm.Cats = woo_css['Cats']
                }
            }

        }( window.PopupStructFormAWooTypeForm = window.PopupStructFormAWooTypeForm || {}, jQuery ));
    </script>
@endonce
