<div class="tab-pane fade show active" id="post-lang-body">
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
                    <button class="btn btn-sm btn-primary post-lang-bd-act" data-parameter="{{ $formB['BodySelectOptions'][0]['ParameterName'] ?? '' }}" data-value="{{ $formB['BodySelectOptions'][0]['Value'] }}">
                        {{ $formB['BodySelectOptions'][0]['Caption'] }}
                    </button>

                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => array_slice($formB['BodySelectOptions'], 1),
                        'eventClassName' => 'post-lang-bd-act'
                    ])
                </div>
            @else
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary post-lang-bd-act" data-value="add">
                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                    </button>

                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['BodySelectOptions'],
                        'eventClassName' => 'post-lang-bd-act'
                    ])
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
        <table class="table-row post-lang-table">
            <thead id="post-lang-table-head">
                @include('front.dabory.erp.partial.make-thead', [
                    'listVars' => $formB['ListVars'],
                    'checkboxName' => 'bd-cud-check'
                ])
            </thead>
            <tbody id="post-lang-table-body">
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
                        class="text-{{ $formB['ListVars']['Align']['LangType'] }}" {{ $formB['ListVars']['Hidden']['LangType'] }}>
                        <select class="text-{{ $formB['ListVars']['Align']['LangType'] }} w-100 border-0 bg-white"
                                v-model="item['LangType']" disabled>
                            @foreach ($codeTitle['lang-type']['lang-type'] as $key => $lang_type)
                                <option value="{{ $lang_type['Code'] }}">
                                    {{ $lang_type['Title'] }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangTitle'] }}" {{ $formB['ListVars']['Hidden']['LangTitle'] }}>
                        <input type="text" v-model="item['LangTitle']"
                               class="text-{{ $formB['ListVars']['Align']['LangTitle'] }} w-100 border-0 bg-white" disabled>
                    </td>
                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangContents'] }}" {{ $formB['ListVars']['Hidden']['LangContents'] }}>
                        <textarea style="max-height: 30px;" class="rounded w-100 bg-white remarks-txt-area" :id="remarksId(index)"
                                  :value="remove_tag(item['LangContents'])"
                                  @dblclick="dblclickMemoTextarea(index)" role="button" readonly></textarea>
                        <div class="fr-view" v-html="item['LangContents']" :id="remarksPreviewId(index)" hidden></div>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc1'] }}" {{ $formB['ListVars']['Hidden']['LangPc1'] }}>
                        <input type="text" v-model="item['LangPc1']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc1'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc2'] }}" {{ $formB['ListVars']['Hidden']['LangPc2'] }}>
                        <input type="text" v-model="item['LangPc2']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc2'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc3'] }}" {{ $formB['ListVars']['Hidden']['LangPc3'] }}>
                        <input type="text" v-model="item['LangPc3']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc3'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc4'] }}" {{ $formB['ListVars']['Hidden']['LangPc4'] }}>
                        <input type="text" v-model="item['LangPc4']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc4'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc5'] }}" {{ $formB['ListVars']['Hidden']['LangPc5'] }}>
                        <input type="text" v-model="item['LangPc5']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc5'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc6'] }}" {{ $formB['ListVars']['Hidden']['LangPc6'] }}>
                        <input type="text" v-model="item['LangPc6']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc6'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc7'] }}" {{ $formB['ListVars']['Hidden']['LangPc7'] }}>
                        <input type="text" v-model="item['LangPc7']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc7'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc8'] }}" {{ $formB['ListVars']['Hidden']['LangPc8'] }}>
                        <input type="text" v-model="item['LangPc8']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc8'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc9'] }}" {{ $formB['ListVars']['Hidden']['LangPc9'] }}>
                        <input type="text" v-model="item['LangPc9']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc9'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPc10'] }}" {{ $formB['ListVars']['Hidden']['LangPc10'] }}>
                        <input type="text" v-model="item['LangPc10']"
                               class="text-{{ $formB['ListVars']['Align']['LangPc10'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPt1'] }}" {{ $formB['ListVars']['Hidden']['LangPt1'] }}>
                        <input type="text" v-model="item['LangPt1']"
                               class="text-{{ $formB['ListVars']['Align']['LangPt1'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td onkeydown="Btype.handleEnterPressedinTabCell(event)"
                        class="text-{{ $formB['ListVars']['Align']['LangPt2'] }}" {{ $formB['ListVars']['Hidden']['LangPt2'] }}>
                        <input type="text" v-model="item['LangPt2']"
                               class="text-{{ $formB['ListVars']['Align']['LangPt2'] }} w-100 border-0 bg-white" disabled>
                    </td>

                    <td
                        class="text-{{ $formB['ListVars']['Align']['Buttons'] }}" {{ $formB['ListVars']['Hidden']['Buttons'] }}>
                        <button type="button" class="btn btn-primary" :disabled="item['Saving']" @click="addTdLastTapOut(index)">
                            {{ $formB['FormVars']['Title']['SaveButton'] }}
                        </button>
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
        var PostLangBody = new Vue({
            el: '#post-lang-body',

            data: function () {
                return {
                    formB: @json($formB),
                    bdPage: [],
                };
            },

            computed: {
                total: function() {
                    return format_decimal(this.bdPage.length, 0);
                }
            },

            mounted() {
                make_dynamic_table_css('#post-lang-body .post-lang-table', make_dynamic_table_px(formB['ListVars']['Size']))

                $('.post-lang-bd-act').on('click', (event) => {
                    switch( $(event.target).data('value') ) {
                        case 'add': this.actAdd(); break;
                        case 'multi-delete': this.actMultiDelete(); break;
                    }
                });

                const self = this
                $(document).on('complete.memo', function (e, txtarea_id, preview_id) {
                    const preview_split = preview_id.split('-')
                    const index = Number(preview_split[preview_split.length - 1])
                    self.bdPage[index]['LangContents'] = $(preview_id).html()
                });
            },

            methods: {
                dblclickMemoTextarea: function (index) {
                    $('#froala-editor').data('preview_id', `#remarks-preview-${index}`)
                    $('#froala-editor').data('txtarea_id', `#remarks-txt-area-${index}`)
                    $('#froala-editor').data('media_brand_code', 'post')

                    $('#modal-memo').find('.fr-view').html($(`#remarks-preview-${index}`).html())
                    $('#modal-memo').modal('show');
                },

                emptyArrayDelete: function () {
                    this.bdPage = this.bdPage.filter(item => item['Id'] !== 0)
                },

                actMultiDelete: function () {
                    this.emptyArrayDelete()

                    const deletePage = this.bdPage.filter(item => item['Checked']).map(item => {
                        return { Id: Number(`-${item['Id']}`) }
                    })

                    if (isEmptyArr(deletePage)) {
                        return iziToast.error({
                            title: 'Error',
                            message: $('#click-the-checkbox-es-of-line-for-action').text(),
                        });
                    }

                    const self = this

                    confirm_message_shw_and_delete(async function() {
                        const response = await get_api_data(self.formB['General']['BdActApi'], {
                            Page: deletePage
                        })

                        show_iziToast_msg(response.data, function () {
                            self.bdPage = self.bdPage.filter(item => !item['Checked'])
                        })
                    })
                },

                cursorId: function (index) {
                    return `cursor-${index}`
                },

                remarksId: function (index) {
                    return `remarks-txt-area-${index}`
                },

                remarksPreviewId: function (index) {
                    return `remarks-preview-${index}`
                },

                actNew: function () {
                    this.bdPage = []
                },

                updateBdUi: function (bdPage) {
                    this.bdPage = bdPage ?? []
                    this.bdPage = this.bdPage.map(item => {
                        return {...item, ...{Saving: false}}
                    })
                },

                lastItemAddedCheck: function (table_id, start_index = -1) {
                    const tr = $(`${table_id} tr:last`);
                    const index = this.bdPage.length
                    const table = $(table_id).closest('table');

                    if (index > 0 && this.bdPage[index - 1].Id === 0) {
                        $(tr).children(`td:eq(0)`).find('input').prop('checked', true);
                        $(tr).children(`td:eq(0)`).find('input').trigger('click');
                        $(tr).children(`td:eq(${Btype.get_first_required_th_index(table, start_index)})`).find('input').focus();

                        iziToast.error({
                            title: 'Error',
                            message: $('#finish-editting-in-the-last-item-line').text(),
                        });
                        return true
                    }

                    return false
                },

                langTypeOverlapCheck: function (index) {
                    const id = this.bdPage[index]['Id']
                    const langType = this.bdPage[index]['LangType']
                    const overlap = this.bdPage.filter(item => item['Id'] !== id)
                        .filter(item => item['LangType'] === langType)

                    return isEmptyArr(overlap)
                },

                addTdLastTapOut: async function (index) {
                    if (this.bdPage[index].PostId !== 0) {
                        if (! this.langTypeOverlapCheck(index)) {
                            return iziToast.error({
                                title: 'Error', message: '언어구분 중복 입력',
                            });
                        }

                        this.bdPage[index].Saving = true

                        if (this.bdPage[index].Last) {
                            this.bdPage[index].SeqNo = await Btype.get_last_seq_no('post-lang', $('#post-no-txt').val())
                        }

                        const response = await get_api_data(this.formB['General']['BdActApi'], {
                            Page: [
                                this.bdPage[index]
                            ]
                        })

                        const page = response.data.Page
                        const self = this
                        show_iziToast_msg(page, function () {
                            self.bdPage[index].Id = page[0].Id

                            if (self.bdPage[index].Last) {
                                self.actAdd()
                                self.bdPage[index].Last = false
                            }

                            self.bdPage[index].Saving = false
                        })
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: @json(_e('(*)Required item(s) omitted')),
                        });
                    }
                },

                actAdd: async function () {
                    const postId = Number($('#post-lang-form').find('#Id').val())
                    if (postId === 0) {
                        return iziToast.error({
                            title: 'Error', message: @json(_e('Action failed')),
                        });
                    }

                    if (! this.lastItemAddedCheck('#post-lang-body #post-lang-table-body')) {
                        this.bdPage.push({
                            Id: 0,
                            PostId: postId,
                            SeqNo: 0,
                            LangType: 'ko',
                            LangTitle: '',
                            LangContents: '',
                            LangPc1: '',
                            LangPc2: '',
                            LangPc3: '',
                            LangPc4: '',
                            LangPc5: '',
                            LangPc6: '',
                            LangPc7: '',
                            LangPc8: '',
                            LangPc9: '',
                            LangPc10: '',
                            LangPt1: '',
                            LangPt2: '',
                            Checked: false,
                            Last: true,
                            Saving: false,
                        })

                        // TODO: 나중에 Vue 코드로 변경
                        const index = this.bdPage.length - 1
                        await setTimeout( function() {
                            $('#post-lang-body').find(`#cursor-${index}`).trigger('click')
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
