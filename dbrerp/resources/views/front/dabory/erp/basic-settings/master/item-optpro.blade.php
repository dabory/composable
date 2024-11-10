@extends($masterName)
@section('title', $formB['General']['Title'])
@section('content')

    <div class="content stock" id="item-form">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-1 pt-2 text-right">
                    <button type="button"
                            class="btn btn-success btn-open-modal"
                            data-target="slip"
                            data-clicked="Btype.fetch_slip_form_book"
                            data-variable="itemOptproModal">
                        <i class="icon-folder-open"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
                        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="btn-group" hidden>
                        <button type="button" class="btn btn-sm btn-primary item-optpro-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
                        @include('front.dabory.erp.partial.select-btn-options', [
                            'selectBtns' => $formB['HeadSelectOptions'],
                            'eventClassName' => 'item-optpro-act',
                        ])
                    </div>
                </div>

                <div class="card" id="item-optpro-form">
                    <div class="card-header" id="frm">
                        <input type="hidden" id="Id" name="Id" value="0">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['ItemCode'] }}</label>
                                            <input type="text" id="item-code-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['ItemCode'] }}"
                                                {{ $formB['FormVars']['Required']['ItemCode'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 ">{{ $formB['FormVars']['Title']['ItemName'] }}</label>
                                            <input type="text" id="item-name-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['ItemName'] }}"
                                                {{ $formB['FormVars']['Required']['ItemName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 ">{{ $formB['FormVars']['Title']['SubName'] }}</label>
                                            <input type="text" id="sub-name-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['SubName'] }}"
                                                {{ $formB['FormVars']['Required']['SubName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['IsSelfOption'] }}</label>
                                            <input class="rounded" type="checkbox" id="is-self-option-check" value="1"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['IsSelfOption'] }}"
                                                {{ $formB['FormVars']['Required']['IsSelfOption'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0 ">{{ $formB['FormVars']['Title']['IgroupName'] }}</label>
                                            <input type="text" id="igroup-name-txt" class="rounded w-100" autocomplete="off"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['IgroupName'] }}"
                                                {{ $formB['FormVars']['Required']['IgroupName'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['PurchPrc'] }}</label>
                                            <input class="rounded w-100" id="purch-prc-txt" type="text"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['PurchPrc'] }}"
                                                {{ $formB['FormVars']['Required']['PurchPrc'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['SalesPrc'] }}</label>
                                            <input class="rounded w-100" id="sales-prc-txt" type="text"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['SalesPrc'] }}"
                                                {{ $formB['FormVars']['Required']['SalesPrc'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['IsStyle'] }}</label>
                                            <input class="rounded" type="checkbox" id="is-style-check" value="1"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['IsStyle'] }}"
                                                {{ $formB['FormVars']['Required']['IsStyle'] }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg card-header-item">
                                <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light"><!--260-->
                                    <div class="card-header p-0 mb-2">
                                        {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['MediaId'] }}</label>
                                            <input class="rounded w-100" id="media-id-txt" type="text"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['MediaId'] }}"
                                                {{ $formB['FormVars']['Required']['MediaId'] }}>
                                        </div>
                                        <div class="form-group d-flex flex-column mb-2">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['Remarks'] }}</label>
                                            <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                                            <div class="fr-view" id="remarks-preview" hidden></div>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label class="m-0">{{ $formB['FormVars']['Title']['IsntStkio'] }}</label>
                                            <input class="rounded" type="checkbox" id="isnt-stkio-check" value="1"
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['IsntStkio'] }}"
                                                {{ $formB['FormVars']['Required']['IsntStkio'] }}>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 mt-2 mx-2">
                        <!-- 탭시작 -->
                        <ul class="nav nav-tabs nav-tabs-solid rounded">
                            <li class="nav-item item-optpro-tab1"><a href="#item-optpro-tab1" class="nav-link rounded-left active" data-toggle="tab">{{ $formB['FormVars']['Title']['TAB1'] }}</a></li>
                            <li class="nav-item item-optpro-tab2"><a href="#item-optpro-tab2" class="nav-link" data-toggle="tab">{{ $formB['FormVars']['Title']['TAB2'] }}</a></li>
                        </ul>
                        <!--// 탭 끝 -->

                        <!-- 탭내용 시작 -->
                        <div class="tab-content">
                            @include('front.dabory.erp.basic-settings.master.item-optpro-tab1', [ 'ref' => 'itemOptproTab1'] )
                            @include('front.dabory.erp.basic-settings.master.item-optpro-tab2', [ 'formB' => $createdItemFormB ])
                        </div>
                        <!--// 탭 내용 끝 -->

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $itemOptproModal])
    @include('front.outline.static.memo')
@endsection

@section('js')
    <script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        window.onload = async function () {
            $('.item-optpro-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': btn_act_save(); break;
                    case 'new': btn_act_new(); break;
                }
            });

            $('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')

                $('#modal-memo').find('.fr-view').html($('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            activate_button_group()
        }

        function btn_act_save() {
            Btype.btn_act_save('#item-optpro-form #frm', function () {
                itemOptproTab1.updateBdUi(bd_page, $('#is-self-option-check:checked').val(), $('#is-option-price').val())
            })
        }

        function btn_act_new() {
            input_box_reset_for('#item-optpro-form #frm')

            // table body 초기화
            table_head_check_box_reset('.color-size-aassign-table')
            itemOptproTab1.actNew()
            itemOptproTab2.actNew()
        }

        function get_parameter() {
            let id = parseInt($('#frm').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                IsSelfOption: $('#is-self-option-check:checked').val() ?? '0',
                IsStyle: $('#is-style-check:checked').val() ?? '0',
                IsntStkio: $('#isnt-stkio-check:checked').val() ?? '0'
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

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }
            Btype.set_slip_no_btn_disabled()

            let hd_page = response.data.HdPage[0]
            bd_page = response.data.BdPage ?? []

            // console.log(hd_page)
            // console.log(bd_page[0])

            $('#Id').val(hd_page.Id)
            $('#item-code-txt').val(hd_page.ItemCode)
            $('#item-name-txt').val(hd_page.ItemName)
            $('#sub-name-txt').val(hd_page.SubName)

            $('#igroup-name-txt').val(hd_page.IgroupName)
            $('#purch-prc-txt').val(format_conver_for(hd_page.PurchPrc, formB.ListVars['Format'].PurchPrc))
            $('#sales-prc-txt').val(format_conver_for(hd_page.SalesPrc, formB.ListVars['Format'].SalesPrc))

            $('#sub-name-txt').val(hd_page.SubName)

            $('#remarks-txt-area').val(remove_tag(hd_page.ItemDesc))
            $('#remarks-preview').html(hd_page.ItemDesc)

            $('#is-self-option-check').prop('checked', hd_page.IsSelfOption == '1')
            $('#is-style-check').prop('checked', hd_page.IsStyle == '1')
            $('#isnt-stkio-check').prop('checked', hd_page.IsntStkio == '1')

            // table body에 데이터 추가
            // ColorSizeAassign.update_bd_ui(bd_page);
            itemOptproTab1.updateBdUi(bd_page, hd_page.IsSelfOption)
            itemOptproTab2.updateBdUi()

            $('#modal-slip').modal('hide');
        }

        const itemOptproModal = {!! json_encode($itemOptproModal) !!};
        var formB = {!! json_encode($formB) !!};
        var bd_page = [];
    </script>
@endsection
