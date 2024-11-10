<div class="tab-pane fade" id="revindex">
    <div class="card-header">
		<div class="stit">
			<h3>리뷰</h3>
		</div>
        <div class="col-12 col-md-6 card-header-item" {{ $formA['FormVars']['Hidden']['Revindex'] }}>
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-header p-0 mb-3">
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">{{ $formA['FormVars']['Title']['Revindex'] }}</label>
                        <select id="revindex-select" name="revindex" class="revindex-selection-multiple" multiple="multiple">
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
    <script>
        $(document).ready(function() {
            PopupForm1FormAItemRevindexForm.get_revindex_data()

            $('#revindex-select').on('select2:select', function (evt) {
                const element = evt.params.data.element
                const $element = $(element)

                $element.detach()
                $(this).append($element)
                $(this).trigger('change')
            });
        });

        (function( PopupForm1FormAItemRevindexForm, $, undefined ) {
            PopupForm1FormAItemRevindexForm.old_item_revpro_ids = []

            PopupForm1FormAItemRevindexForm.btn_act_new = function () {
                $('#item-form').find('select[name=revindex]')
                    .val([])
                    .trigger('change')
            }

            PopupForm1FormAItemRevindexForm.set_ui = async function (item_id) {
                const response = await get_api_data('item-revpro-page', {
                    PageVars: {
                        Query: `item_id = '${item_id}'`,
                        Asc: 'seq_no',
                        Limit: 9999
                    }
                })

                PopupForm1FormAItemRevindexForm.old_item_revpro_ids = _.pluck(response.data.Page, 'Id')

                const server_render_data = _.pluck(response.data.Page, 'RevindexId')
                //usually we render data by this way, but select2 will auto sorting
                $('#revindex-select').val(server_render_data).trigger('change')

                //so we re-append select data
                const options = [];
                for (let i = 0; i < server_render_data.length; i++) {
                    options.push($("#revindex-select option[value=" + server_render_data[i] + "]"));
                }
                $('#revindex-select').append(...options).trigger('change');
            }

            PopupForm1FormAItemRevindexForm.revindex_parameter = function (revindex) {
                const item_form = $('#item-form')

                const item_id = Number( $(item_form).find('#Id').val() )

                return {
                    Id: 0,
                    ItemId: item_id,
                    SeqNo: revindex['SeqNo'],
                    RevindexId: Number(revindex['RevindexId']),
                }
            }

            PopupForm1FormAItemRevindexForm.btn_revindex_act_save = async function () {
                const sel_badge_code_list = $('#item-form').find('select[name=revindex]').val()
                const page = sel_badge_code_list.map((revindex_id, index) => {
                    return PopupForm1FormAItemRevindexForm.revindex_parameter({ SeqNo: index, RevindexId: revindex_id })
                })

                // 현재 item연결 된 pro_item_revpro db 데이터 전부 삭제
                const delData = PopupForm1FormAItemRevindexForm.old_item_revpro_ids.map(revpro_id => {
                    return { Id: Number(-revpro_id) }
                })

                const realPage = [...page, ...delData]

                if (isEmptyArr(realPage)) { return }

                const response = await get_api_data('item-revpro-act', {
                    Page: realPage
                })

                PopupForm1FormAItemRevindexForm.old_item_revpro_ids = _.difference(_.pluck(response.data.Page, 'Id'), PopupForm1FormAItemRevindexForm.old_item_revpro_ids)
            }

            PopupForm1FormAItemRevindexForm.get_revindex_data = async function () {
                const lang_type = window.User['CountryCode'].split('_')[0]
                const response = await get_api_data('item-revindex-page', {
                    PageVars: {
                        Query: `lang_type = '${lang_type}'`,
                        Asc: 'id',
                        Limit: 9999
                    }
                })

                const page = response.data.Page ?? []
                const data = page.map(revindex => {
                    return { id: revindex['Id'], text: revindex['IndexName'] }
                })

                $('#revindex-select').select2({
                    placeholder: 'Search or Select a Revindex',
                    multiple: true,
                    allowClear: true,
                    data : data
                });
            }
        }( window.PopupForm1FormAItemRevindexForm = window.PopupForm1FormAItemRevindexForm || {}, jQuery ));
    </script>
@endpush
@endonce
