@php
    $createdItemFormA = new App\Models\Parameter\FormB(request('bpa'), '/form/form-b/master/item-optpro');

    $createdItemFormA = $createdItemFormA->getData()['formB'];
@endphp

<div class="tab-pane fade" id="optpro">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <div class="card-header">
		<div class="stit">
			<h3>옵션</h3>
		</div>
        <div class="col-12 card-header-item">
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-header p-0 mb-3">
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="flex-column mb-2">
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0">옵션명(콤마로 분리 예: 사이즈,색상,스타일)</label>
                                <input type="text" class="w-100 rounded" id="captions" onchange="PopupForm1FormAMasterItemOptproForm.changeCaptions($(this).val())">
                            </div>
                            <div class="form-group d-flex flex-column mb-2">
                                <label class="m-0">국가별 표준 사이즈 옵션 지정</label>
                                <select class="w-100 rounded" id="product-option-nation-std" onchange="itemOptproTab1.productOptionNationStd($(this).val())">
                                    <option value="direct">직접입력</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
{{--                        <!-- 탭시작 -->--}}
{{--                        <ul class="nav nav-tabs nav-tabs-solid rounded">--}}
{{--                            <li class="nav-item item-optpro-tab1"><a href="#item-optpro-tab1" class="nav-link rounded-left active" data-toggle="tab">옵션 할당</a></li>--}}
{{--                            <li class="nav-item item-optpro-tab2"><a href="#item-optpro-tab2" class="nav-link" data-toggle="tab">생성된 옵션 품목</a></li>--}}
{{--                        </ul>--}}
{{--                        <!--// 탭 끝 -->--}}

{{--                        <!-- 탭내용 시작 -->--}}
{{--                        <div class="tab-content">--}}
{{--                            @include('front.dabory.erp.basic-settings.master.item-optpro-tab1', [ 'ref' => 'itemOptproTab1', 'formB' => $createdItemFormA] )--}}
{{--                            @include('front.dabory.erp.basic-settings.master.item-optpro-tab2', [ 'formB' => $createdItemFormB ])--}}
{{--                        </div>--}}
{{--                        <!--// 탭 내용 끝 -->--}}
                        @include('front.dabory.erp.basic-settings.master.item-optpro-tab1', [ 'ref' => 'itemOptproTab1', 'formB' => $createdItemFormA] )

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
    <script>
        $(document).ready(async function() {
            const response = await get_api_data('select-option', {
                QueryVars: {
                    QueryName: '/form/form-a/item-option/product-option-nation-std',
                },
                PageVars: {
                    Limit: 100000,
                    Offset: 0
                }
            })

            $('#item-form').find('#product-option-nation-std').append(window.create_options(response.data.Page ?? []));
        });

        (function( PopupForm1FormAMasterItemOptproForm, $, undefined ) {
            PopupForm1FormAMasterItemOptproForm.formB = {!! json_encode($createdItemFormA) !!};

            PopupForm1FormAMasterItemOptproForm.changeCaptions = function (val) {
                itemOptproTab1.changeCaptions(val)
            }

            PopupForm1FormAMasterItemOptproForm.btn_act_new = async function () {
                table_head_check_box_reset('.color-size-aassign-table')
                itemOptproTab1.actNew()
                // itemOptproTab2.actNew()
            }

            PopupForm1FormAMasterItemOptproForm.set_ui = async function (item) {
                PopupForm1FormAMasterItemOptproForm.update_hd_ui(item)
            }

            PopupForm1FormAMasterItemOptproForm.update_hd_ui = async function (item) {
                itemOptproTab1.updateBdUi(item)
                // itemOptproTab2.updateBdUi()
            }

        }( window.PopupForm1FormAMasterItemOptproForm = window.PopupForm1FormAMasterItemOptproForm || {}, jQuery ));
    </script>
@endpush
@endonce
