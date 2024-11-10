<div class="tab-pane fade" id="item-optpro-tab2">
    <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
        <table class="table-row created-item-table">
            <thead id="created-item-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
            </thead>
            <tbody id="created-item-table-body">
                <tr v-for="(item, index) in bdPage">
                    <td class="text-{{ $formB['ListVars']['Align']['$Radio'] }} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                               class="text-{{ $formB['ListVars']['Align']['$Radio'] }}"
                               onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['ItemCode'] }}">
                        @{{ item['ItemCode'] }}
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['ItemName'] }}">
                        @{{ item['ItemName'] }}
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['SubName'] }}">
                        @{{ item['SubName'] }}
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['PurchPrc'] }}">
                        @{{ format_conver_for( item['PurchPrc'], formB.ListVars['Format'].PurchPrc ) }}
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['SalesPrc'] }}">
                        @{{ format_conver_for( item['SalesPrc'], formB.ListVars['Format'].SalesPrc ) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
        <div class="d-flex flex-column flex-md-row" id="total-frm">
            <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SumTotal'] }}>
                    {{ $formB['FooterVars']['Title']['SumTotal'] }}
                </label>
                <input type="text" class="w-100 w-md-80 rounded" :value="total" disabled>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        var itemOptproTab2 = new Vue({
            el: '#item-optpro-tab2',

            data: function () {
                return {
                    formB: @json($formB),
                    bdPage: []
                };
            },

            computed: {
                total: function() {
                    return format_decimal(this.bdPage.length, 0);
                }
            },

            mounted() {
                set_min_width_table('#item-optpro-tab2 .created-item-table', 870)

                $('.item-optpro-tab2 a').on('click', () => {
                    this.updateBdUi()
                });
            },

            created: function () {
                // console.log(this.formB)
            },

            methods: {
                actNew: function () {
                    this.bdPage = []
                },

                updateBdUi: async function () {
                    const itemId = Number($('#item-form').find('#Id').val())
                    if (itemId === 0) { return }

                    const response = await get_api_data('item-page', {
                        PageVars: {
                            Query: `style_id = ${itemId}`,
                            Limit: 9999999,
                            Offset: 0
                        }
                    })

                    this.bdPage = response.data.Page ?? []
                },
            }
        });
    </script>
@endpush
