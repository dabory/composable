<div class="tab-pane fade" id="related">
    <div class="card-header">
		<div class="stit">
			<h3>연관상품</h3>
		</div>
        <div class="col-12 card-header-item" {{ $formA['FormVars']['Hidden']['TabC'] }}>
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-body py-2">
                    <div class="form-group d-flex justify-content-end align-items-center">
                        <button type="button" id="item-related-modal-btn"
                                class="btn btn-success btn-open-modal"
                                data-target="item"
                                data-class="related"
                                data-clicked="PopupForm1FormAItemRelatedForm.fetch_item"
                                data-variable="PopupForm1FormAItemRelatedForm.itemModal">
                            <i class="icon-folder-open"></i>
                            {{ $formA['FormVars']['Title']['ItemRelated'] }}
                        </button>

                        <div class="btn-group ml-1">
                            <button class="btn btn-sm btn-primary item-related-act" data-value="save">
                                연관상품 저장
                            </button>

                            @include('front.dabory.erp.partial.select-btn-options', [
                                'selectBtns' => [
                                    [ 'Value' => 'multi-delete', 'Caption' => '연관상품 일괄 삭제' ],
                                ],
                                'eventClassName' => 'item-related-act'
                            ])
                        </div>
                    </div>

                    <div class="table-responsive mt-2" style="height:600px;" id="scroll-area">
                        <table class="table-row item-related-table">
                            <thead id="item-related-table-head">
                            @include('front.dabory.erp.partial.make-thead', [
                                'listVars' => [
                                    'Title' => [ '$Check' => '$Check', 'No' => '번호', 'C1' => '이미지', 'C2' => '품목코드', 'C3' => '품명', 'C4' => '서브명', 'C5' => '매출가', ],
                                    'Hidden' => [  '$Check' => '', 'No' => '', 'C1' => '', 'C2' => '', 'C3' => '', 'C4' => '', 'C5' => '', ],
                                    'Size' => [ '$Check' => '1', 'No' => '1', 'C1' => '3', 'C2' => '3', 'C3' => '3', 'C4' => '3', 'C5' => '3', ],
                                ],
                                'checkboxName' => 'item-related-cud-check'
                            ])
                            </thead>
                            <tbody id="item-related-table-body">
                                <tr v-for="(item, index) in itemRelatedGallery">
                                    <td class="text-center px-import-0">
                                        <input name="item-related-cud-check" v-model="item['Checked']" type="checkbox" value="1" tabindex="-1"
                                               class="center">
                                    </td>
                                    <td>@{{ itemRelatedGallery.length - index }}</td>
                                    <td v-html="format_conver_for(item['C1'], '$_ThumbNail', { ListWidth: 100, ListHeight: 100 })"></td>
                                    <td>@{{ item['C2'] }}</td>
                                    <td>@{{ item['C3'] }}</td>
                                    <td>@{{ item['C4'] }}</td>
                                    <td class="text-right">@{{ format_conver_for(item['C5'], "decimal('sales_prc')") }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@once
@push('js')
    <script>
        var PopupForm1FormAItemRelatedForm = new Vue({
            el: '#related',

            data: function () {
                return {
                    itemModal: [],
                    itemRelatedGallery: [],
                };
            },

            mounted() {
                set_min_width_table('#related .item-related-table', 870)

                $('.item-related-act').on('click', (event) => {
                    switch( $(event.target).data('value') ) {
                        case 'save': this.actSave(); break;
                        case 'multi-delete': this.actMultiDelete(); break;
                    }
                });

                this.includeBlades()
                const self = this

                $(document).on('item.multi.select', '#modal-item', async function (event, id_list) {
                    const page = id_list.map(id => {
                        return { Id: id }
                    })
                    const response = await PopupForm1FormAItemForm.call_item_pick(page)
                    self.selectedItems(response.data)
                });
            },

            methods: {
                callActApi: async function (page) {
                    return await get_api_data('item-related-act', {
                        Page: page
                    })
                },

                actSave: async function () {
                    const itemId = Number( $('#item-form').find('#Id').val() )
                    if (itemId === 0) {
                        return iziToast.warning({
                            title: 'Warning', message: '품목을 먼저 선택해주세요',
                        });
                    }

                    const response = await this.callActApi(this.convertActPage())
                    const self = this
                    show_iziToast_msg(response.data, function () {
                        self.set_ui(itemId)
                    })
                },

                actMultiDelete: function () {
                    const deletePage = this.itemRelatedGallery
                        .filter(item => item['Checked'])


                    if (isEmptyArr(deletePage)) {
                        return iziToast.error({
                            title: 'Error', message: $('#click-the-checkbox-es-of-line-for-action').text(),
                        });
                    }

                    const realDeletePage = deletePage.filter(item => item['Id'] !== 0)
                        .map(item => {
                        return { Id: Number(`-${item['Id']}`) }
                    })

                    const self = this
                    confirm_message_shw_and_delete(async function() {
                        let page = true
                        if (! isEmptyArr(realDeletePage)) {
                            const response = await self.callActApi(realDeletePage)

                            page = response.data.Page
                        }
                        show_iziToast_msg(page, function () {
                            self.itemRelatedGallery = self.itemRelatedGallery.filter(item => !item['Checked'])
                        })
                    })
                },

                convertActPage: function () {
                    const itemId = Number( $('#item-form').find('#Id').val() )

                    return this.itemRelatedGallery.map((itemRelated, index) => {
                        return {
                            Id: itemRelated['Id'],
                            ItemId: itemId,
                            SeqNo: index,
                            ItemRelatedId: itemRelated['HId'],
                        }
                    })
                },

                selectedItems: function (itemList) {
                    for (let i = 0; i < itemList['Page'].length; i++) {
                        this.itemRelatedGallery.push({
                            Id: 0,
                            HId: itemList['Page'][i]['Id'],
                            C1: itemList['MediaBd1Page'][i]['BdFileUrl'],
                            C2: itemList['Page'][i]['ItemCode'],
                            C3: itemList['Page'][i]['ItemName'],
                            C4: itemList['Page'][i]['SubName'],
                            C5: itemList['Page'][i]['SalesPrc'],
                            Checked: false,
                        })
                    }

                    $('#modal-item.related').modal('hide')
                },

                includeBlades: async function() {
                    const item = await get_para_data('modal', '/search/item-search/item-related')
                    this.itemModal = item['data']

                    get_blades_html('front.outline.static.item', this.itemModal, function (html) {
                        if ($('#element_in_which_to_insert').find('#modal-item').length) {
                            html = html.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
                        }
                        $('#element_in_which_to_insert').append(html);
                    }, 'moealSetFile', { modalClassName: 'related' });
                },

                btn_act_new: function () {
                    this.itemRelatedGallery = []
                },

                fetch_item: async function (item_id) {
                    const response = await PopupForm1FormAItemForm.call_item_pick([ { Id: item_id } ])
                    this.selectedItems(response.data)
                },

                set_ui: async function (item_id) {
                    const response = await get_api_data('list-type1-page', {
                        QueryVars: {
                            QueryName: 'pro:shop/item-related-gallery',
                            SimpleFilter: `rel.item_id = ${item_id}`,
                            SubSimpleFilter: "image_type = 'thumb'",
                            IsntPagination: true
                        },
                        ListType1Vars: {
                            OrderBy: 'rel.seq_no asc'
                        },
                        PageVars: {
                            Limit: 9999,
                        }
                    })

                    this.itemRelatedGallery = response.data.Page ?? []
                }
            }
        });
    </script>
@endpush
@endonce
