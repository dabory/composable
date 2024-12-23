<div class="tab-pane fade" id="prod-addon-ipn">

    <div class="card-header">
		<div class="stit">
			<h3>제공정보</h3>
		</div>
        <div class="col-12 card-header-item">
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-header p-0 mb-3">
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">추가 정보</label>
                        <div class="table-responsive mt-2" id="scroll-area">
                            <table class="table-row">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">항목</th>
                                        <th style="width: 10%;">내용</th>
                                        <th style="width: 1%;"><button @click="addItem"><i class="fas fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody class="w-100">
                                <tr v-for="(prod, index) in prodAddonJson" class="w-100">
                                    <td class="td_subject">
                                        <div class="d-flex">
                                            <select class="w-100" v-model="prod['Caption']" @change="changeItem(event, index)">
                                                <option value="">선택해주세요</option>
                                                <option value="모델명">모델명</option>
                                                <option value="제조사">제조사</option>
                                                <option value="원산지">원산지</option>
                                                <option value="input">직접입력</option>
                                            </select>
                                            <input type="text" class="ml-1" id="prod-item-txt" v-model="prod['Direct']" :style="{display: prod['Direct'] ? '' : 'none'}">
                                        </div>
                                    </td>
                                    <td class="td_subject">
                                        <input type="text" v-model="prod['Value']">
                                    </td>
                                    <td class="td_note">
                                        <button @click="removeItem(index)"><i class="fas fa-minus"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0 mb-2">상품정보제공고시</label>

                        <div class="form-group d-flex flex-column mb-2">
                            <label class="m-0">품목</label>
                            <select class="rounded" @change="changeIpnItem">
                                <option value="">품목선택</option>
                                <option :value="opt['Value']" v-for="opt in productIpnGroup">@{{ opt['Value'] }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="m-0">상세정보</label>
                            <div class="table-responsive mt-2" id="scroll-area">
                                <table class="table-row">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%;">항목</th>
                                        <th style="width: 10%;">정보</th>
                                        <th style="width: 1%;"><button @click="addIpnItem"><i class="fas fa-plus"></i></button></th>
                                    </tr>
                                    </thead>
                                    <tbody class="w-100">
                                    <tr v-for="(prod, index) in prodIpnJson" class="w-100">
                                        <td class="td_subject">
                                            <input type="text" v-model="prod['Caption']">
                                        </td>
                                        <td class="td_subject">
                                            <input type="text" v-model="prod['Value']">
                                        </td>
                                        <td class="td_note">
                                            <button @click="removeIpnItem(index)"><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('js')
        <script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
        <script>
            const PopupForm1FormAItemProdAddonIpnForm = new Vue({
                el: '#prod-addon-ipn',

                data: function () {
                    return {
                        prodAddonJson: [],
                        prodIpnJson: [],
                        productIpnGroup: [],
                    }
                },

                computed: {
                },

                mounted: async function () {
                    const response = await get_api_data('select-option', {
                        QueryVars: {
                            QueryName: '/form/form-a/etc/product-ipn-group',
                        },
                        PageVars: {
                            Limit: 100000,
                            Offset: 0
                        }
                    })

                    this.productIpnGroup = response.data.Page
                },

                methods: {
                    addItem: function () {
                        this.prodAddonJson.push({
                            Caption: '',
                            Direct: null,
                            Value: '',
                        })
                    },

                    removeItem: function (index) {
                        this.prodAddonJson.splice(index, 1)
                    },

                    changeItem: function (event, index) {
                        const value = event.target.value
                        const $prodItemTxt = $(event.target).closest('.td_subject').find('#prod-item-txt')
                        if (value === 'input') {
                            $($prodItemTxt).show()
                        } else {
                            $($prodItemTxt).hide()
                            this.prodAddonJson[index]['Direct'] = ''
                        }
                    },

                    addonParameter: function () {
                        return this.prodAddonJson.map((prod) => {
                            return {
                                Caption: prod['Caption'],
                                Direct: prod['Direct'],
                                Value: prod['Value'],
                            }
                        })
                    },

                    ipnParameter: function () {
                        return this.prodIpnJson.map((prod) => {
                            return {
                                Caption: prod['Caption'],
                                Value: prod['Value'],
                            }
                        })
                    },

                    set_ui: function (prodAddonJson, prodIpnJson) {
                        this.prodAddonJson = prodAddonJson ? JSON.parse(prodAddonJson)['ProdAddonJson'] : []
                        this.prodIpnJson = prodIpnJson ? JSON.parse(prodIpnJson)['ProdIpnJson'] : []
                    },

                    addIpnItem: function () {
                        this.prodIpnJson.push({
                            Caption: '',
                            Content: '',
                        })
                    },

                    removeIpnItem: function (index) {
                        this.prodIpnJson.splice(index, 1)
                    },

                    changeIpnItem: async function () {
                        const selectName = event.target.value
                        const response = await get_api_data('etc-page', {
                            PageVars: {
                                Query: `select_name = '${selectName}'`,
                                Asc: 'id',
                                Limit: 9999
                            }
                        })
                        this.prodIpnJson = response.data.Page.map((ipn) => {
                            return {
                                Caption: ipn['Value'],
                                Value: '',
                            }
                        })
                    }
                }
            });

        </script>
    @endpush
@endonce
