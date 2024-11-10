<div class="tab-pane fade show active" id="item-optpro-tab1">
    <div class="d-flex justify-content-end">
{{--        <button class="btn btn-primary mr-1" id="down-btn" onclick="ColorSizeAassign.override_seq_no_up_down('down')"--}}
{{--            data-clicked="">▼--}}
{{--        </button>--}}
{{--        <button class="btn btn-primary mr-1" id="up-btn" onclick="ColorSizeAassign.override_seq_no_up_down('up')"--}}
{{--            data-clicked="">▲--}}
{{--        </button>--}}
        <div class="btn-group">
            @if ($formB['FormVars']['Hidden']['AddNewBdButton'] == 'hidden')
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary color-size-aassign-act" data-parameter="{{ $formB['BodySelectOptions'][0]['ParameterName'] ?? '' }}" data-value="{{ $formB['BodySelectOptions'][0]['Value'] }}">
                        {{ $formB['BodySelectOptions'][0]['Caption'] }}
                    </button>

                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => array_slice($formB['BodySelectOptions'], 1),
                        'eventClassName' => 'color-size-aassign-act'
                    ])
                </div>
            @else
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary color-size-aassign-act" data-value="add">
                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                    </button>

                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['BodySelectOptions'],
                        'eventClassName' => 'color-size-aassign-act'
                    ])
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
        <table class="table-row color-size-aassign-table">
            <thead id="color-size-aassign-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
            </thead>
            <tbody id="color-size-aassign-table-body">
                <tr v-for="(item, index) in bdPage">
                    <td class="text-{{ $formB['ListVars']['Align']['$Radio'] }} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                               :id="cursorId(index)"
                               class="text-{{ $formB['ListVars']['Align']['$Radio'] }}"
                               onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-{{ $formB['ListVars']['Align']['$Check'] }} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                               v-model="item['Checked']"
                               class="{{ $formB['ListVars']['Align']['$Check'] }}">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['FuncTitle'] }}" {{ $formB['ListVars']['Hidden']['FuncTitle'] }}>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['FuncVer'] }}" {{ $formB['ListVars']['Hidden']['FuncVer'] }}>
                        <input type="text" v-model="item['FuncVer']"
                               class="text-{{ $formB['ListVars']['Align']['FuncVer'] }} w-100 border-0 bg-white">
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['ModelVer'] }}" {{ $formB['ListVars']['Hidden']['ModelVer'] }}>
                        <input type="text" v-model="item['ModelVer']"
                               class="text-{{ $formB['ListVars']['Align']['ModelVer'] }} w-100 border-0 bg-white">
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['PromptFeed'] }}" {{ $formB['ListVars']['Hidden']['PromptFeed'] }}>
                        <!-- <input type="text" class="text-{{ $formB['ListVars']['Align']['PromptFeed'] }} border-0 bg-white"
                               :value="format_conver_for( item['PromptFeed'], formB.ListVars['Format'].PromptFeed )" readonly> -->
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['PromptNo'] }}" {{ $formB['ListVars']['Hidden']['PromptNo'] }}>
                        <!-- <input type="text" class="text-{{ $formB['ListVars']['Align']['Qty'] }} border-0 bg-white"
                               :value="format_conver_for( item['PromptNo'], formB.ListVars['Format'].SalesQty )" readonly> -->
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['Status'] }}" {{ $formB['ListVars']['Hidden']['Status'] }}>
                        <input type="checkbox" v-model="item['Status']"
                               class="text-{{ $formB['ListVars']['Align']['Status'] }} border-0 bg-white">
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
        var itemOptproTab1 = new Vue({
            el: '#item-optpro-tab1',

            data: function () {
                return {
                    formB: @json($formB),
                    bdPage: [],
                    itemSizeOptionNationStd: [],
                    itemOptionNationStd: [],
                    itemOptionCount: 0,
                    itemOptionCaptions: [],
                };
            },

            computed: {
                total: function() {
                    return format_decimal(this.bdPage.length, 0);
                }
            },

            mounted() {
                set_min_width_table('#item-optpro-tab1 .color-size-aassign-table', 870)

                $('.color-size-aassign-act').on('click', (event) => {
                    switch( $(event.target).data('value') ) {
                        case 'add': this.actAdd(); break;
                        case 'multi-delete': this.actMultiDelete(); break;
                    }
                });

                const color_size_aassign_table_head = $('#color-size-aassign-table-head')
                $(color_size_aassign_table_head).find('tr th:eq(2)').prop('hidden', true)
                $(color_size_aassign_table_head).find('tr th:eq(3)').prop('hidden', true)
                $(color_size_aassign_table_head).find('tr th:eq(4)').prop('hidden', true)
            },

            created: async function () {
                const response = await get_api_data('item-option-page', {
                    PageVars: {
                        Limit: 9999999,
                        Offset: 0
                    }
                })

                const page = response.data.Page

                this.itemOptionList = groupBy(page, 'OptionType')
                this.itemSizeOptionNationStd = this.itemOptionList['size']
            },

            methods: {
                actMultiDelete: function () {
                    const deletePage = this.bdPage.filter(item => item['Checked'])

                    if (isEmptyArr(deletePage)) {
                        return iziToast.error({
                            title: 'Error',
                            message: $('#click-the-checkbox-es-of-line-for-action').text(),
                        });
                    }

                    const self = this
                    confirm_message_shw_and_delete(function() {
                        self.bdPage = self.bdPage.filter(item => ! item['Checked'])
                    })
                },

                productOptionNationStd: function (val) {
                    this.itemSizeOptionNationStd = this.itemOptionList['size'].filter(opt => opt['NationStd'] === val)
                    if (val === 'direct') {
                        this.bdPage = this.bdPage.map(item => {
                            item['Opt1'] = '0'
                            item['SelfOpt1Hidden'] = false
                            return item
                        })
                    }
                },

                changeOpt1: function (event, index) {
                    if (event.target.value === '0') {
                        this.bdPage[index]['SelfOpt1Hidden'] = false
                    } else {
                        this.bdPage[index]['SelfOpt1Hidden'] = true
                    }
                },

                cursorId: function (index) {
                    return `cursor-${index}`
                },

                actNew: function () {
                    this.bdPage = []
                    this.itemOptionCaptions = []
                    $('#optpro').find('#captions').val('')
                    return this.changeCaptions('')
                },

                updateBdUi: function (item) {
                    this.productOptionNationStd($('#item-form').find('#product-option-nation-std').val())

                    const optionJson = item['OptionJson'] ? JSON.parse(item['OptionJson'])['OptionJson'] : []
                    if (isEmptyArr(optionJson)) {
                        return this.actNew()
                    }
                    this.bdPage = optionJson['Options'].map(opt => {
                        const overlap = this.itemSizeOptionNationStd.filter(natOpt => natOpt['OptionName'] === opt['Opt1'])
                        opt['SelfOpt1Hidden'] = true
                        if (isEmptyArr(overlap)) {
                            opt['SelfOpt1Hidden'] = false
                            opt['Opt1Direct'] = opt['Opt1']
                            opt['Opt1'] = '0'
                        }
                        return opt
                    })
                    this.itemOptionCaptions = optionJson['Captions']
                    const captions = optionJson['Captions'].join(',')
                    $('#optpro').find('#captions').val(captions)
                    this.changeCaptions(captions)
                },

                changeCaptions: async function (val) {
                    if (val) {
                        this.itemOptionCaptions = val.split(',')
                    } else {
                        this.itemOptionCaptions = val
                    }
                    this.itemOptionCount = this.itemOptionCaptions.length

                    console.log(this.itemOptionCaptions)

                    const color_size_aassign_table_head = $('#color-size-aassign-table-head')
                    $(color_size_aassign_table_head).find('tr th:eq(2)').prop('hidden', true)
                    $(color_size_aassign_table_head).find('tr th:eq(3)').prop('hidden', true)
                    $(color_size_aassign_table_head).find('tr th:eq(4)').prop('hidden', true)

                    switch (this.itemOptionCount) {
                        case 1:
                            $(color_size_aassign_table_head).find('tr th:eq(2)').text('옵션1' + '(' + this.itemOptionCaptions[0] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(2)').prop('hidden', false)
                            break;
                        case 2:
                            $(color_size_aassign_table_head).find('tr th:eq(2)').text('옵션1' + '(' + this.itemOptionCaptions[0] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(3)').text('옵션2' + '(' + this.itemOptionCaptions[1] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(2)').prop('hidden', false)
                            $(color_size_aassign_table_head).find('tr th:eq(3)').prop('hidden', false)
                            break;
                        case 3:
                            $(color_size_aassign_table_head).find('tr th:eq(2)').text('옵션1' + '(' + this.itemOptionCaptions[0] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(3)').text('옵션2' + '(' + this.itemOptionCaptions[1] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(4)').text('옵션3' + '(' + this.itemOptionCaptions[2] + ')')
                            $(color_size_aassign_table_head).find('tr th:eq(2)').prop('hidden', false)
                            $(color_size_aassign_table_head).find('tr th:eq(3)').prop('hidden', false)
                            $(color_size_aassign_table_head).find('tr th:eq(4)').prop('hidden', false)
                            break;
                    }

                    await setTimeout( function() {
                        $('#item-optpro-tab1 #color-size-aassign-table-body').find('#cursor-0').prop('checked', true);
                        $('#item-optpro-tab1 #color-size-aassign-table-body').find('#cursor-0').trigger('click');
                    }, 100);
                },

                lastItemAddedCheck: function (table_id, start_index = -1) {
                    const tr = $(`${table_id} tr:last`);
                    const index = this.bdPage.length
                    const table = $(table_id).closest('table');

                    if (index > 0) {
                        switch (this.itemOptionCount) {
                            case 1:
                                if (this.bdPage[index - 1].Opt1 !== '') {
                                    return false
                                }
                                break;
                            case 2:
                                if (this.bdPage[index - 1].Opt1 !== '' && this.bdPage[index - 1].Opt2 !== '') {
                                    return false
                                }
                                break;
                            case 3:
                                if (this.bdPage[index - 1].Opt1 !== '' && this.bdPage[index - 1].Opt2 !== ''
                                    && this.bdPage[index - 1].Opt3 !== '') {
                                    return false
                                }
                                break;
                        }
                        $(tr).children(`td:eq(0)`).find('input').prop('checked', true);
                        $(tr).children(`td:eq(0)`).find('input').trigger('click');
                        $(tr).children(`td:eq(${Btype.get_first_required_th_index(table, start_index)})`).find('input').focus();

                        iziToast.error({
                            title: 'Error',
                            message: '옵션 추가 마지막 품목 라인의 수정을 완료해주세요',
                        });
                        return true
                    }

                    return false
                },

                optproOverlapCheck: function () {
                    for (let i = 0; i < this.bdPage.length; i++) {
                        for (let j = 0; j < this.bdPage.length; j++) {
                            if (i !== j) {
                                if (this.getOptName(i) === this.getOptName(j)) {
                                    iziToast.error({
                                        title: 'Error',
                                        message: '(' + this.getOptName(i) + ')' + ' 옵션이 이미 존재합니다.',
                                    });
                                    return true
                                }
                            }
                        }
                    }

                    return false
                },

                getOptName: function (index) {
                    let optName = ''
                    let opt1 = this.bdPage[index].Opt1
                    if (opt1 === '0') {
                        opt1 = this.bdPage[index].Opt1Direct
                    }
                    switch (this.itemOptionCount) {
                        case 1:
                            optName = opt1
                            break;
                        case 2:
                            optName = opt1 + ':' + this.bdPage[index].Opt2
                            break;
                        case 3:
                            optName = opt1 + ':' +this.bdPage[index].Opt2 + ':' + this.bdPage[index].Opt3
                            break;
                    }

                    return optName
                },

                optproErrorCheck: function () {
                    if (this.lastItemAddedCheck('#item-optpro-tab1 #color-size-aassign-table-body') || this.optproOverlapCheck()) {
                        return true
                    } else {
                        return false
                    }
                },

                parameter: function () {
                    const options = this.bdPage.map(item => {
                        return {
                            Opt1: item['Opt1'] === '0' ? item['Opt1Direct'] : item['Opt1'],
                            Opt2: item['Opt2'],
                            Opt3: item['Opt3'],
                            Prc: Number(item['Prc']),
                            Qty: Number(item['Qty']),
                            Status: item['Status'],
                        }
                    })
                    // console.log(options)

                    return {
                        Captions: this.itemOptionCaptions,
                        Options: options,
                    }
                },

                actAdd: async function () {
                    itemOptproTab1.parameter()

                    const itemId = Number($('#item-form').find('#Id').val())
                    if (itemId === 0) {
                        return iziToast.error({
                            title: 'Error', message: @json(_e('Action failed')),
                        });
                    }

                    if (! this.lastItemAddedCheck('#item-optpro-tab1 #color-size-aassign-table-body')) {
                        let opt1 = ''
                        let selfOpt1Hidden = true
                        if ($('#item-form').find('#product-option-nation-std').val() === 'direct') {
                            opt1 = '0'
                            selfOpt1Hidden = false
                        }
                        this.bdPage.push({
                            Opt1: opt1,
                            Opt2: '',
                            Opt3: '',
                            Prc: 0,
                            Qty: 0,
                            Checked: false,
                            SelfOpt1Hidden: selfOpt1Hidden,
                            Status: true,
                        })

                        // TODO: 나중에 Vue 코드로 변경
                        const index = this.bdPage.length - 1
                        await setTimeout( function() {
                            $('#item-optpro-tab1').find(`#cursor-${index}`).trigger('click')
                        }, 100);
                    }
                },

                setFieldData: function (index, field) {
                    this.bdPage[index][field] = event.target.value
                }


            }
        });
    </script>
@endpush
