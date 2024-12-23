<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" id="item-modal-btn"
            class="btn btn-success btn-open-modal"
            data-target="item"
            data-class="basic"
            data-clicked="PopupForm1FormAItemForm.fetch_item"
            data-variable="PopupForm1FormAItemForm.itemModal">
        <i class="icon-folder-open"></i>
    </button>
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="item-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" id="item-btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary item-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'item-act',
        ])
    </div>
</div>

<div class="card p-2" id="item-form">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <ul class="nav nav-tabs nav-tabs-solid rounded justify-content-between my-2">
        <li class="nav-item {{ $formA['FormVars']['Display']['TabA'] }}"><a href="#basic" id="basic-tab" class="nav-link active" data-toggle="tab">{{ $formA['FormVars']['Title']['TabA'] }}</a></li>
        <li class="nav-item d-flex"><a href="#optpro" class="nav-link" data-toggle="tab">옵션</a></li>
        <li class="nav-item d-flex"><a href="#thm-media" class="nav-link" data-toggle="tab">추가 이미지</a></li>
        <li class="nav-item d-flex"><a href="#prod-addon-ipn" class="nav-link" data-toggle="tab">제공 정보</a></li>
        <li class="nav-item {{ $formA['FormVars']['Display']['TabB'] }}"><a href="#badge" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['TabB'] }}</a></li>
        <li class="nav-item {{ $formA['FormVars']['Display']['TabC'] }}"><a href="#related" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['TabC'] }}</a></li>
        <li class="nav-item {{ $formA['FormVars']['Display']['TabD'] }}"><a href="#revindex" class="nav-link" data-toggle="tab">{{ $formA['FormVars']['Title']['TabD'] }}</a></li>
		<li class="nav-item d-flex"><a href="#delivery" class="nav-link" data-toggle="tab">배송</a></li>
		<li class="nav-item d-flex"><a href="#erp" class="nav-link" data-toggle="tab">ERP</a></li>
    </ul>

    <div class="tab-content" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div class="tab-pane fade show active" id="basic">
            <div class="card-header">
            <div class="row">
                <div class="col-12 card-header-item
                @if($formA['FormVars']['Hidden']['OfferCredit'] !== 'hidden') col-md-6  @endif">
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-2">
                        </div>
                        <div class="card-body">
                            <div class="form-group {{ $formA['FormVars']['Display']['MainSupplier'] }} flex-column mb-3">
                                <label class="m-0" {{ $formA['FormVars']['Required']['MainSupplier'] }}>
                                    {{ $formA['FormVars']['Title']['MainSupplier'] }}
                                </label>
                                <div class="d-flex">
                                    <input type="text" id="supplier-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off"
                                           onkeydown="company_model_show_cell_enter_key(event, 'BB', 'PopupForm1FormAItemForm')"
                                           maxlength="{{ $formA['FormVars']['MaxLength']['MainSupplier'] }}"
                                        {{ $formA['FormVars']['Required']['MainSupplier'] }}>
                                    <button type="button" {{ $formA['FormVars']['Required']['MainSupplier'] === 'hidden' ? 'hidden' : '' }}
                                            class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 PopupForm1FormAItemForm company-modal-btn"
                                            data-target="company"
                                            data-clicked="PopupForm1FormAItemForm.get_override_supplier_id"
                                            data-variable="PopupForm1FormAItemForm.companyModal">
                                        <i class="icon-folder-open"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['Brand'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Brand'] }}</label>
                                <div class="d-flex">
                                    <input type="text" id="brand-name-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" disabled
                                           maxlength="{{ $formA['FormVars']['MaxLength']['Brand'] }}"
                                        {{ $formA['FormVars']['Required']['Brand'] }}>
                                    <button type="button"
                                            class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 PopupForm1FormAItemForm etc-brand-modal-btn"
                                            data-target="setting"
                                            data-filter="code"
                                            data-class="etc-brand"
                                            data-clicked="PopupForm1FormAItemForm.get_ete_brand_id"
                                            data-variable="PopupForm1FormAItemForm.etcBrandModal">
                                        <i class="icon-folder-open"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="form-group {{ $formA['FormVars']['Display']['IgroupId'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['IgroupId'] }}</label>
                                <div class="d-flex">
                                    <input type="text" id="igroup-id-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" disabled
                                           maxlength="{{ $formA['FormVars']['MaxLength']['IgroupId'] }}"
                                        {{ $formA['FormVars']['Required']['IgroupId'] }}>
                                    <button type="button"
                                            class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3 PopupForm1FormAItemForm igroup-modal-btn"
                                            data-target="setting_igroup"
                                            data-clicked="PopupForm1FormAItemForm.get_igroup_id"
                                            data-class="igroup"
                                            data-variable="PopupForm1FormAItemForm.igroupModal">
                                        <i class="icon-folder-open"></i>
                                    </button>
                                </div>
    {{--                            <select class="rounded w-100" id="igroup-id-select"--}}
    {{--                                    maxlength="{{ $formA['FormVars']['MaxLength']['IgroupId'] }}"--}}
    {{--                                {{ $formA['FormVars']['Required']['IgroupId'] }}>--}}
    {{--                            </select>--}}
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['ItemCode'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ItemCode'] }}</label>
                                <input type="text" id="item-code-txt" data-copy="true" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['ItemCode'] }}"
                                    {{ $formA['FormVars']['Required']['ItemCode'] }}>
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['ItemName'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ItemName'] }}</label>
                                <input type="text" id="item-name-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['ItemName'] }}"
                                    {{ $formA['FormVars']['Required']['ItemName'] }}>
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['SubName'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SubName'] }}</label>
                                <input type="text" id="sub-name-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['SubName'] }}"
                                    {{ $formA['FormVars']['Required']['SubName'] }}>
                            </div>

                            <div class="form-group {{ $formA['FormVars']['Display']['Quantity'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['Quantity'] }}</label>
                                <input type="text" id="quantity-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['Quantity'] }}"
                                    {{ $formA['FormVars']['Required']['Quantity'] }}>
                            </div>

                            <div class="form-group {{ $formA['FormVars']['Display']['CountUnit'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['CountUnit'] }}</label>
                                <input type="text" id="count-unit-txt" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['CountUnit'] }}"
                                    {{ $formA['FormVars']['Required']['CountUnit'] }}>
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['ItemSlug'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ItemSlug'] }}</label>
                                <input type="text" id="item-slug-txt" data-copy="true" class="rounded w-100" autocomplete="off"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['ItemSlug'] }}"
                                    {{ $formA['FormVars']['Required']['ItemSlug'] }}>
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['IsntPro'] }} align-items-center mb-3">
                                <input class="rounded" type="checkbox" id="isnt-pro-check" value="1">
								<label class="m-0">{{ $formA['FormVars']['Title']['IsntPro'] }}</label>
                            </div>

                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">검색 태그로</label>
                                <input type="text" id="tags-txt" data-copy="true" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">Model No(SKU)</label>
                                <input type="text" id="model-no-txt" data-copy="true" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">원산지</label>
                                <input type="text" id="origin-txt" data-copy="true" class="rounded w-100" autocomplete="off">
                            </div>
                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">제조사</label>
                                <input type="text" id="maker-txt" data-copy="true" class="rounded w-100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 card-header-item" {{ $formA['FormVars']['Hidden']['OfferCredit'] }}>
                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                        <div class="card-header p-0 mb-3">
                        </div>
                        <div class="card-body">
                        <div class="form-group d-flex flex-column mb-3">
                            <label class="m-0">상품상태</label>
                            <div class="d-flex align-items-center justify-content-around">
                                @foreach ($codeTitle['condition-type']['item'] as $key => $condition_type)
                                    @if ($condition_type['Code'] !== '')
                                        <div class="mr-1">
                                            <input type="radio" name="condition_type" value="{{ $condition_type['Code'] }}"
                                                   tabindex="-1" class="text-center" id="condition-type-{{ $condition_type['Code'] }}">
                                            <label class="mb-0" for="condition-type-{{ $condition_type['Code'] }}">{{ $condition_type['Title'] }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">소비자 정가</label>
                                <input type="text" id="list-prc-txt" class="rounded w-100 decimal" autocomplete="off"
                                       data-point="decimal('sales_prc')">
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['SalesPrc'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['SalesPrc'] }}</label>
                                <input type="text" id="sales-prc-txt" class="rounded w-100 decimal" autocomplete="off"
                                       data-point="decimal('sales_prc')"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['SalesPrc'] }}"
                                    {{ $formA['FormVars']['Required']['SalesPrc'] }}>
                            </div>

                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">판매 커미션율</label>
                                <input type="text" id="seller-comm-rate-txt" class="rounded w-100 decimal" autocomplete="off"
                                       data-point="decimal('acc_amt')"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['RewardRate'] }}">
                            </div>
                            <div class="form-group {{ $formA['FormVars']['Display']['RewardRate'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['RewardRate'] }}</label>
                                <input type="text" id="reward-rate-txt" class="rounded w-100 decimal" autocomplete="off"
                                       data-point="decimal('acc_amt')"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['RewardRate'] }}"
                                    {{ $formA['FormVars']['Required']['RewardRate'] }}>
                            </div>

                            <div class="form-group {{ $formA['FormVars']['Display']['CurrStkQty'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['CurrStkQty'] }}</label>
                                <input type="text" id="curr-stk-qty-txt" class="rounded w-100 decimal" autocomplete="off"
                                       data-point="decimal('stock_qty')"
                                       maxlength="{{ $formA['FormVars']['MaxLength']['CurrStkQty'] }}"
                                    {{ $formA['FormVars']['Required']['CurrStkQty'] }}>
                            </div>
							<div class="form-group {{ $formA['FormVars']['Display']['IsCreditProduct'] }} align-items-center mb-3">
								<input class="rounded" type="checkbox" id="is-credit-product-check" value="1">
								<label class="m-0">{{ $formA['FormVars']['Title']['IsCreditProduct'] }}</label>
							</div>
                            <div class="form-group {{ $formA['FormVars']['Display']['OfferCredit'] }} flex-column mb-3">
								<label class="m-0">{{ $formA['FormVars']['Title']['OfferCredit'] }}</label>
								<input type="text" id="offer-credit-txt" class="rounded w-100 decimal" autocomplete="off"
									data-point="decimal('acc_amt')"
								   maxlength="{{ $formA['FormVars']['MaxLength']['OfferCredit'] }}"
									{{ $formA['FormVars']['Required']['OfferCredit'] }}>
							</div>
                            <div class="form-group {{ $formA['FormVars']['Display']['MediaId'] }} flex-column mb-2">
                                <label class="m-0">{{ $formA['FormVars']['Title']['MediaId'] }}</label>
                                <input type="text" id="bd-file-url-txt" class="w-100 rounded mb-1 tooltip-show-img" disabled>
                                <input type="hidden" id="media-id-txt">
                                <div class="d-flex justify-content-center">
                                    <button class="btn col text-white bg-grey-700 border-grey-700 bg-grey-700-hover" id="file-upload-btn" onclick="PopupForm1FormAItemForm.upload_file(this)">
                                        {{ $formA['FormVars']['Title']['FileUpload'] }}
                                    </button>
                                    <button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAItemForm.delete_media_id('#media-id-txt', '#bd-file-url-txt')">삭제</button>
                                </div>
                            </div>

                            <div class="form-group {{ $formA['FormVars']['Display']['ItemDesc'] }} flex-column mb-3">
                                <label class="m-0">{{ $formA['FormVars']['Title']['ItemDesc'] }}</label>
                                <textarea style="height: 85px" class="rounded w-100 bg-white" id="remarks-txt-area" role="button" readonly></textarea>
                                <div class="fr-view" id="remarks-preview" hidden></div>
                            </div>

                            <div class="form-group d-flex flex-column mb-3">
                                <label class="m-0">간단 상품설명(더블클릭)</label>
                                <textarea style="height: 85px" class="rounded w-100 bg-white" id="short-desc-txtarea" role="button" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

		<!-- erp -->
		<div class="tab-pane fade" id="erp">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group {{ $formA['FormVars']['Display']['PurchPrc'] }} flex-column mb-3">
									<label class="m-0">{{ $formA['FormVars']['Title']['PurchPrc'] }}</label>
									<input type="text" id="purch-prc-txt" class="rounded w-100 decimal" autocomplete="off"
										   data-point="decimal('purch_prc')"
										   maxlength="{{ $formA['FormVars']['MaxLength']['PurchPrc'] }}"
										{{ $formA['FormVars']['Required']['PurchPrc'] }}>
								</div>
								<div class="form-group {{ $formA['FormVars']['Display']['DiscountPrc'] }} flex-column mb-3">
								   <label class="m-0">{{ $formA['FormVars']['Title']['DiscountPrc'] }}</label>
								   <input type="text" id="discount-prc-txt" class="rounded w-100 decimal" autocomplete="off"
										  data-point="decimal('sales_prc')"
										  maxlength="{{ $formA['FormVars']['MaxLength']['DiscountPrc'] }}"
									 {{ $formA['FormVars']['Required']['DiscountPrc'] }}>
								</div>
								<div class="form-group {{ $formA['FormVars']['Display']['ItemMemo'] }} flex-column mb-3">
									<label class="m-0">{{ $formA['FormVars']['Title']['ItemMemo'] }}</label>
									<textarea style="height: 85px" class="rounded w-100 bg-white" id="item-memo-txtarea" role="button" readonly></textarea>
								</div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->
					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
                                <div class="form-group {{ $formA['FormVars']['Display']['IsErpStk'] }} align-items-center mb-3">
									<input class="rounded" type="checkbox" id="is-erp-stk-check" value="1">
									<label class="m-0">{{ $formA['FormVars']['Title']['IsErpStk'] }}</label>
								</div>
								<div class="form-group {{ $formA['FormVars']['Display']['IsMaterial'] }} align-items-center mb-3">
									<input class="rounded" type="checkbox" id="is-material-check" value="1">
									<label class="m-0">{{ $formA['FormVars']['Title']['IsMaterial'] }}</label>
								</div>
								<div class="form-group {{ $formA['FormVars']['Display']['IsItemEnd'] }} align-items-center mb-3">
									<input class="rounded" type="checkbox" id="is-item-end-check" value="1">
									<label class="m-0">{{ $formA['FormVars']['Title']['IsItemEnd'] }}</label>
								</div>
								<div class="form-group {{ $formA['FormVars']['Display']['IsntStkio'] }} align-items-center">
									<input class="rounded" type="checkbox" id="isnt-stkio-check" value="1">
									<label class="m-0">{{ $formA['FormVars']['Title']['IsntStkio'] }}</label>
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// erp 끝 -->

        @include('front.dabory.erp.master-data.item-badge')

        @include('front.dabory.erp.master-data.item-related')

        @include('front.dabory.erp.master-data.item-revindex')

        @include('front.dabory.erp.master-data.item-thm-media')

        @include('front.dabory.erp.master-data.item-optpro')

        @include('front.dabory.erp.master-data.item-prod-addon-ipn')

        @include('front.dabory.erp.master-data.item-delivery')
    </div>
</div>

@section('modal')
    @include('front.outline.static.memo')
    @include('front.outline.static.memo2')
@endsection

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        $(document).ready(async function() {
            PopupForm1FormAItemForm.data_init()
            await PopupForm1FormAItemForm.include_blades()
            // await PopupForm1FormAItemForm.create_igroup_select_box_options();

            $('.item-act').on('click', function () {
                // console.log($(this).data('value'))
                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAItemForm.btn_act_save(); break;
                    case 'new': PopupForm1FormAItemForm.btn_act_new(); break;
                    case 'copy': PopupForm1FormAItemForm.btn_act_copy(); break;
                    case 'del': Atype.btn_act_del('#item-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide')
                    }, 'PopupForm1FormAItemForm'); break;
                }
            });

            $('#item-form').find('#remarks-txt-area').on('dblclick', function () {
                $('#froala-editor').data('preview_id', '#remarks-preview')
                $('#froala-editor').data('txtarea_id', '#remarks-txt-area')
                $('#froala-editor').data('media_brand_code', 'item')

                $('#modal-memo').find('.fr-view').html($('#remarks-preview').html())
                $('#modal-memo').modal('show');
            });

            $('#item-form').find('#short-desc-txtarea').on('dblclick', function () {
                $('#modal-memo2').find('#memo-textarea').val('')
                $('#modal-memo2').data('txtarea_id', '#short-desc-txtarea')

                $('#modal-memo2').find('#memo-textarea').val($('#short-desc-txtarea').val())
                $('#modal-memo2').modal('show');
            });

            $('#item-form').find('#item-memo-txtarea').on('dblclick', function () {
                $('#modal-memo2').find('#memo-textarea').val('')
                $('#modal-memo2').data('txtarea_id', '#item-memo-txtarea')

                $('#modal-memo2').find('#memo-textarea').val($('#item-memo-txtarea').val())
                $('#modal-memo2').modal('show');
            });

            $(document).on('unlink.company', '#modal-company', function (event) {
                init_company_id($('#item-form').find('#supplier-txt'))
            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                $(unique_key).val(id_list[0])
                $(unique_key).closest('.form-group').find('#bd-file-url-txt').val(file_url_list[0])
            });

            activate_button_group({save_spinner_btn: '#item-save-spinner-btn', btn_group: '#item-btn-group'})
        });

        (function( PopupForm1FormAItemForm, $, undefined ) {
            PopupForm1FormAItemForm.formA = {!! json_encode($formA) !!}
            PopupForm1FormAItemForm.companyModal
            PopupForm1FormAItemForm.itemModal
            PopupForm1FormAItemForm.igroupModal
            PopupForm1FormAItemForm.etcBrandModal

            PopupForm1FormAItemForm.btn_act_copy = function () {
                const prev_id = Number( $('#item-form').find('#Id').val() )
                Atype.btn_act_copy('#item-form #frm', async function () {
                    const response = await get_api_data('item-thm-pick', {
                        Page: [ { Id: prev_id } ]
                    })

                    const current_id = Number( $('#item-form').find('#Id').val() )
                    const act_data = { ...response.data['Page'][0], ...{Id: current_id} }
                    const item_thm_act = await get_api_data('item-thm-act', {
                        Page: [ act_data ]
                    })
                }, 'PopupForm1FormAItemForm')
            }

            PopupForm1FormAItemForm.delete_media_id = function (media_dom_id, file_url_dom_id) {
                $(media_dom_id).val(0)
                $(file_url_dom_id).val('')
            }

            PopupForm1FormAItemForm.upload_file = function ($this) {
                if (! PopupForm1FormBMediaForm.btn_act_new('item')) {
                    return
                }

                $('#modal-media').data('target-id', '')
                const target_id = '#' + $($this).closest('.form-group').find('#media-id-txt').attr('id')
                $('#modal-media').data('unique-key', target_id)
                $('#item-form').find('#modal-media-btn').data('target', 'media')
                $('#item-form').find('#modal-media-btn').data('variable', mediaModal)
                $('#item-form').find('#modal-media-btn').trigger('click')
            }

            PopupForm1FormAItemForm.set_company_data_to_textbox = async function (company) {
                await PopupForm1FormAItemForm.get_override_supplier_id(company.Id)

                return $('#item-form #supplier-txt')
            }

            PopupForm1FormAItemForm.btn_act_save = function () {
                if (itemOptproTab1.optproErrorCheck()) { return }

                Atype.btn_act_save('#item-form #frm', async function () {
                    await PopupForm1FormAMasterItemThmMediaForm.btn_act_save()
                    await PopupForm1FormAItemBadgeForm.btn_badge_act_save()
                    await PopupForm1FormAItemRevindexForm.btn_revindex_act_save()

                    $('#modal-select-popup.show').trigger('item.create', [$('#item-form').find('#Id').val(), $('#item-form').find('#quantity-txt').val()]);
                    $('#modal-select-popup.show').trigger('list.requery');
                    // $('#modal-select-popup.show').modal('hide')
                }, 'PopupForm1FormAItemForm');
            }

            PopupForm1FormAItemForm.data_init = function () {
                $('#modal-select-popup.popup-form1-form-a-item-form .modal-header').removeClass('bg-grey-700 px-0')
                $('#modal-select-popup.popup-form1-form-a-item-form .modal-body thead th').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-item-form .modal-body button').addClass('bg-primary border-primary bg-primary-hover')
                $('#modal-select-popup.popup-form1-form-a-item-form .modal-header').addClass('bg-original-purple')

                $('#modal-select-popup.popup-form1-form-a-item-form #prod-addon-ipn thead button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover bg-primary border-primary bg-primary-hover')

                Atype.set_parameter_callback(PopupForm1FormAItemForm.parameter)
                Atype.btn_act_new('#item-form #frm')

                $('#item-form').find('#media-id-txt').val(0)
                $('#item-form').find(`input:radio[name=is_self_option]:input[value='0']`).prop('checked', true)
                $('#item-form').find('input:radio[name=condition_type]:input[value=' + '0' + ']').prop('checked', true)
            }

            PopupForm1FormAItemForm.btn_act_new = async function () {
                PopupForm1FormAItemForm.data_init()
                PopupForm1FormAMasterItemOptproForm.btn_act_new()
                PopupForm1FormAMasterItemThmMediaForm.btn_act_new()
                PopupForm1FormAItemBadgeForm.btn_act_new()
                PopupForm1FormAItemRelatedForm.btn_act_new()
                PopupForm1FormAItemDeliveryForm.btn_act_new()

                if (window.User['MemberId'] !== 0) {
                    await get_supplier_id(window.User['MemberCompanyId'])
                }
                $('#item-form').find('#item-code-txt').val(await make_slip_no('item-auto-create', 'item-yw'))
            }

            PopupForm1FormAItemForm.btn_act_new_callback = function () {
                if ($('#element_in_which_to_insert').find('#modal-company').length == 0) {
                    iziToast.error({
                        title: 'Error', message: '아직 로딩 중 입니다. 잠시 후 다시 시도해주세요',
                    });
                    return -1
                }
                $('#item-modal-btn').prop('hidden', true)
                PopupForm1FormAItemForm.btn_act_new()
            }

            PopupForm1FormAItemForm.show_popup_callback = async function (id) {
                if ($('#element_in_which_to_insert').find('#modal-company').length == 0) {
                    iziToast.error({
                        title: 'Error', message: '아직 로딩 중 입니다. 잠시 후 다시 시도해주세요',
                    });
                    return -1
                }

                $('#item-modal-btn').prop('hidden', true)
                PopupForm1FormAItemForm.data_init()
                await PopupForm1FormAItemForm.fetch_item(Number(id));
            }

            PopupForm1FormAItemForm.include_blades = async function() {
                const company = await get_para_data('modal', '/search/company-search/supplier')
                PopupForm1FormAItemForm.companyModal = company['data']

                const item = await get_para_data('modal', '/search/item-search/item')
                PopupForm1FormAItemForm.itemModal = item['data']

                const igroup = await get_para_data('modal', '/search/setting-search/igroup')
                PopupForm1FormAItemForm.igroupModal = igroup['data']

                const etc_brand = await get_para_data('modal', '/search/setting-search/etc-brand')
                PopupForm1FormAItemForm.etcBrandModal = etc_brand['data']

                get_blades_html('front.outline.static.item', PopupForm1FormAItemForm.itemModal, function (html) {
                    if ($('#element_in_which_to_insert').find('#modal-item').length) {
                        html = html.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
                    }
                    $('#element_in_which_to_insert').append(html);
                }, 'moealSetFile', { modalClassName: 'basic' });

                get_blades_html('front.outline.static.setting-igroup', PopupForm1FormAItemForm.igroupModal, function (html) {
                    if ($('#element_in_which_to_insert').find('#modal-setting-igroup.igroup').length) return;
                    $('#element_in_which_to_insert').append(html);
                }, 'moealSetFile', { modalClassName: 'igroup' });

                get_blades_html('front.outline.static.setting', PopupForm1FormAItemForm.etcBrandModal, function (html) {
                    if ($('#element_in_which_to_insert').find('#modal-setting.etc-brand').length) return;
                    $('#element_in_which_to_insert').append(html);
                }, 'moealSetFile', { modalClassName: 'etc-brand' });

                get_blades_html('front.outline.static.company', PopupForm1FormAItemForm.companyModal, function (html) {
                    if ($('#element_in_which_to_insert').find('#modal-company').length) return;
                    $('#element_in_which_to_insert').append(html);

                    const itemId = getParameterByName('id')
                    if (itemId) {
                        return PopupForm1FormAItemForm.fetch_item(Number(itemId))
                    }

                    const isItemRegist = '{{ $isItemRegist ?? 0 }}'
                    if (isItemRegist == '1') {
                        PopupForm1FormAItemForm.btn_act_new()
                    }


                });
            }

            PopupForm1FormAItemForm.create_igroup_select_box_options = async function () {
                let response = await get_api_data('setting-search-page', {
                    QueryVars: {
                        QueryName: 'igroup',
                        FilterName: 'dbr_igroup.id',
                    },
                    PageVars: {
                        Limit: 9999,
                        Offset: 0,
                    }
                })
                const igroup_id_select = custom_create_options('Id', 'Name', response.data.Page)
                $('#item-form').find('#igroup-id-select').append(igroup_id_select);
            }

            PopupForm1FormAItemForm.get_igroup_id = async function (igroup_id) {
                const response = await get_setting_pick('igroup-pick', igroup_id)

                const igroup = response.data.Page[0]

                $('#item-form').find('#igroup-id-txt').val(igroup['BreadCrumb'])
                $('#item-form').find('#igroup-id-txt').data('id', igroup['Id'])

                $('#modal-setting_igroup.show').modal('hide');
            }

            PopupForm1FormAItemForm.get_override_supplier_id = async function (supplier_id) {
                await get_supplier_id(supplier_id);
            }

            PopupForm1FormAItemForm.get_ete_brand_id = function (brand_name) {
                $('#item-form').find('#brand-name-txt').val(brand_name)
                $('#modal-setting.show').modal('hide');
            }

            PopupForm1FormAItemForm.parameter = function () {
                const item_form = $('#item-form')

                const id = Number( $(item_form).find('#Id').val() )

                let parameter = {
                    Id: id,
                    ItemCode: $(item_form).find('#item-code-txt').val(),
                    IgroupId: Number($(item_form).find('#igroup-id-txt').data('id')),
                    ItemName: $(item_form).find('#item-name-txt').val(),
                    SubName: $(item_form).find('#sub-name-txt').val(),
                    ItemSlug: $(item_form).find('#item-slug-txt').val(),
                    CountUnit: $(item_form).find('#count-unit-txt').val(),
                    SupplierId: Number($(item_form).find('#supplier-txt').data('id')),
                    Brand: $(item_form).find('#brand-name-txt').val(),
                    SizeNationStd: $(item_form).find('#product-option-nation-std').val(),
                    MediaId: Number($(item_form).find('#media-id-txt').val()),

                    PurchPrc: minusComma($(item_form).find('#purch-prc-txt').val()) || '0',
                    SalesPrc: minusComma($(item_form).find('#sales-prc-txt').val()) || '0',
                    ListPrc: minusComma($(item_form).find('#list-prc-txt').val()) || '0',
                    DiscountPrc: minusComma($(item_form).find('#discount-prc-txt').val()) || '0',
                    CurrStkQty: minusComma($(item_form).find('#curr-stk-qty-txt').val()) || '0',
                    OfferCredit: minusComma($(item_form).find('#offer-credit-txt').val()) || '0',
                    SellerCommRate: minusComma($(item_form).find('#seller-comm-rate-txt').val()) || '0',
                    RewardRate: minusComma($(item_form).find('#reward-rate-txt').val()) || '0',
                    SalesCreditRate: '0',
                    ItemMemo: $(item_form).find('#item-memo-txtarea').val(),
                    ShortDesc: $(item_form).find('#short-desc-txtarea').val(),
                    ItemDesc: $(item_form).find('#remarks-preview').html(),
                    IsErpStk: $(item_form).find('#is-erp-stk-check:checked').val() ?? '0',
                    IsMaterial: $(item_form).find('#is-material-check:checked').val() ?? '0',
                    IsItemEnd: $(item_form).find('#is-item-end-check:checked').val() ?? '0',
                    ExposeType: $(item_form).find('#isnt-pro-check:checked').val() ?? '0',
                    IsCreditProduct: $(item_form).find('#is-credit-product-check:checked').val() ?? '0',
                    IsSelfOption: $(item_form).find('input:radio[name=is_self_option]:checked').val(),
                    IsntStkio: $(item_form).find('#isnt-stkio-check:checked').val() ?? '0',

                    Tags: $(item_form).find('#tags-txt').val(),
                    ModelNo: $(item_form).find('#model-no-txt').val(),
                    Origin: $(item_form).find('#origin-txt').val(),
                    Maker: $(item_form).find('#maker-txt').val(),
                    ConditionType: $(item_form).find('input:radio[name=condition_type]:checked').val(),

                    ProdAddonJson: JSON.stringify({ProdAddonJson: PopupForm1FormAItemProdAddonIpnForm.addonParameter()}),
                    ProdIpnJson: JSON.stringify({ProdIpnJson: PopupForm1FormAItemProdAddonIpnForm.ipnParameter()}),

                    ...PopupForm1FormAItemDeliveryForm.parameter(),
                    OptionJson: JSON.stringify({OptionJson: itemOptproTab1.parameter()}),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }
                console.log(parameter)

                return parameter;
            }

            PopupForm1FormAItemForm.call_item_pick = async function(page) {
                return await get_api_data(PopupForm1FormAItemForm.formA['General']['PickApi'], {
                    ImageType: 'thumb',
                    Page: page
                })
            }

            PopupForm1FormAItemForm.fetch_item = async function (id) {
                const response = await PopupForm1FormAItemForm.call_item_pick([ { Id: id } ])
                console.log(response);
                PopupForm1FormAItemForm.set_item_ui(response)
            }

            PopupForm1FormAItemForm.set_item_ui = async function (response) {
                console.log(response)
                if (isEmpty(response.data) || response.data.apiStatus) {
                    $('#modal-item.basic').modal('hide');
                    return;
                }

                $('#basic-tab').trigger('click')

                const item = response.data.Page[0]
                const media_bd1_page = response.data.MediaBd1Page[0]
                const item_form = $('#item-form')
                $(item_form).find('#Id').val(item.Id)

                $(item_form).find('#item-code-txt').val(item.ItemCode)
                $(item_form).find('#igroup-id-txt').data('id', item.IgroupId)

                $(item_form).find('#item-name-txt').val(item.ItemName)
                $(item_form).find('#sub-name-txt').val(item.SubName)
                $(item_form).find('#item-slug-txt').val(item.ItemSlug)
                $(item_form).find('#count-unit-txt').val(item.CountUnit)
                $(item_form).find('#supplier-txt').val(item.CompanyName)
                $(item_form).find('#brand-name-txt').val(item.Brand)
                $(item_form).find('#product-option-nation-std').val(item.SizeNationStd)

                $(item_form).find('#bd-file-url-txt').val(media_bd1_page.BdFileUrl)

                $(item_form).find('#media-id-txt').val(item.MediaId)

                $(item_form).find('#tags-txt').val(item.Tags)
                $(item_form).find('#model-no-txt').val(item.ModelNo)
                $(item_form).find('#origin-txt').val(item.Origin)
                $(item_form).find('#maker-txt').val(item.Maker)
                $(item_form).find('input:radio[name=condition_type]:input[value=' + item.ConditionType + ']').prop('checked', true)

                if (item.IgroupId !== 0) {
                    await PopupForm1FormAItemForm.get_igroup_id(item.IgroupId)
                }

                if (item.SupplierId !== 0) {
                    await get_supplier_id(item.SupplierId)
                }

                $(item_form).find('#purch-prc-txt').val(format_conver_for(item.PurchPrc, "decimal('purch_prc')"))
                $(item_form).find('#sales-prc-txt').val(format_conver_for(item.SalesPrc, "decimal('sales_prc')"))
                $(item_form).find('#list-prc-txt').val(format_conver_for(item.ListPrc, "decimal('sales_prc')"))
                $(item_form).find('#discount-prc-txt').val(format_conver_for(item.DiscountPrc, "decimal('sales_prc')"))
                $(item_form).find('#curr-stk-qty-txt').val(format_conver_for(item.CurrStkQty, "decimal('stock_qty')"))
                $(item_form).find('#offer-credit-txt').val(format_conver_for(item.OfferCredit, "decimal('acc_amt')"))
                $(item_form).find('#seller-comm-rate-txt').val(format_conver_for(item.SellerCommRate, "decimal('acc_amt')"))
                $(item_form).find('#reward-rate-txt').val(format_conver_for(item.RewardRate, "decimal('acc_amt')"))
                $(item_form).find('#item-memo-txtarea').val(item.ItemMemo)
                $(item_form).find('#short-desc-txtarea').val(item.ShortDesc)
                $(item_form).find('#remarks-txt-area').val(remove_tag(item.ItemDesc))
                $(item_form).find('#remarks-preview').html(item.ItemDesc)
                $(item_form).find('#is-erp-stk-check').prop('checked', item.IsErpStk == '1')
                $(item_form).find('#is-material-check').prop('checked', item.IsMaterial == '1')
                $(item_form).find('#is-item-end-check').prop('checked', item.IsItemEnd == '1')
                $(item_form).find('#isnt-pro-check').prop('checked', item.ExposeType == '1')
                $(item_form).find('#is-credit-product-check').prop('checked', item.IsCreditProduct == '1')
                $(item_form).find('input:radio[name=is_self_option]:input[value=' + item.IsSelfOption + ']').prop('checked', true)
                $(item_form).find('#isnt-stkio-check').prop('checked', item.IsntStkio == '1')

                PopupForm1FormAMasterItemOptproForm.set_ui(item)
                PopupForm1FormAMasterItemThmMediaForm.set_ui(item.Id)
                PopupForm1FormAItemBadgeForm.set_ui(item.Id)
                PopupForm1FormAItemRelatedForm.set_ui(item.Id)
                PopupForm1FormAItemRevindexForm.set_ui(item.Id)
                PopupForm1FormAItemProdAddonIpnForm.set_ui(item.ProdAddonJson, item.ProdIpnJson)
                PopupForm1FormAItemDeliveryForm.set_ui(item)

                $('#modal-item.basic').modal('hide')
            }

        }( window.PopupForm1FormAItemForm = window.PopupForm1FormAItemForm || {}, jQuery ));

    </script>
@endpush
@endonce
