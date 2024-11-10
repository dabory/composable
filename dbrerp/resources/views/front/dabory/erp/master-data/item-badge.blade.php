<div class="tab-pane fade" id="badge">
    <div class="card-header">
		<div class="stit">
			<h3>뱃지</h3>
		</div>
        <div class="col-12 col-md-6 pl-0 card-header-item" {{ $formA['FormVars']['Hidden']['Badge'] }}>
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-header p-0 mb-3">
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column mb-3">
                        <label class="m-0">{{ $formA['FormVars']['Title']['Badge'] }}</label>
                        <select id="badge-select" name="badge" class="badge-selection-multiple" multiple="multiple">
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
            PopupForm1FormAItemBadgeForm.get_badge_data()

            $('#badge-select').on('select2:select', function (evt) {
                const element = evt.params.data.element
                const $element = $(element)

                $element.detach()
                $(this).append($element)
                $(this).trigger('change')
            });
        });

        (function( PopupForm1FormAItemBadgeForm, $, undefined ) {
            PopupForm1FormAItemBadgeForm.old_item_badpro_ids = []

            PopupForm1FormAItemBadgeForm.btn_act_new = function () {
                $('#item-form').find('select[name=badge]')
                    .val([])
                    .trigger('change')
            }

            PopupForm1FormAItemBadgeForm.set_ui = async function (item_id) {
                const response = await get_api_data('item-badpro-page', {
                    PageVars: {
                        Query: `item_id = '${item_id}'`,
                        Asc: 'seq_no',
                        Limit: 9999
                    }
                })

                PopupForm1FormAItemBadgeForm.old_item_badpro_ids = _.pluck(response.data.Page, 'Id')

                const server_render_data = _.pluck(response.data.Page, 'BadgeCode')
                //usually we render data by this way, but select2 will auto sorting
                $('#badge-select').val(server_render_data).trigger('change')

                //so we re-append select data
                const options = [];
                for (let i = 0; i < server_render_data.length; i++) {
                    options.push($("#badge-select option[value=" + server_render_data[i] + "]"));
                }
                $('#badge-select').append(...options).trigger('change');
            }

            PopupForm1FormAItemBadgeForm.badge_parameter = function (badge) {
                const item_form = $('#item-form')

                const item_id = Number( $(item_form).find('#Id').val() )

                return {
                    Id: 0,
                    ItemId: item_id,
                    SeqNo: badge['SeqNo'],
                    BadgeCode: badge['BadgeCode'],
                }
            }

            PopupForm1FormAItemBadgeForm.btn_badge_act_save = async function () {
                const sel_badge_code_list = $('#item-form').find('select[name=badge]').val()
                const page = sel_badge_code_list.map((badge_code, index) => {
                    return PopupForm1FormAItemBadgeForm.badge_parameter({ SeqNo: index, BadgeCode: badge_code })
                })

                // 현재 item연결 된 item_badpro db 데이터 전부 삭제
                const delData = PopupForm1FormAItemBadgeForm.old_item_badpro_ids.map(badpro_id => {
                    return { Id: Number(-badpro_id) }
                })

                const realPage = [...page, ...delData]

                if (isEmptyArr(realPage)) { return }

                const response = await get_api_data('item-badpro-act', {
                    Page: realPage
                })

                PopupForm1FormAItemBadgeForm.old_item_badpro_ids = _.difference(_.pluck(response.data.Page, 'Id'), PopupForm1FormAItemBadgeForm.old_item_badpro_ids)
            }

            PopupForm1FormAItemBadgeForm.get_badge_data = async function () {
                const lang_type = window.User['CountryCode'].split('_')[0]
                const response = await get_api_data('item-badge-page', {
                    PageVars: {
                        Query: `lang_type = '${lang_type}'`,
                        Asc: 'id',
                        Limit: 9999
                    }
                })

                const page = response.data.Page ?? []
                const data = page.map(badge => {
                    return { id: badge['BadgeCode'], text: badge['BadgeName'] }
                })

                $('#badge-select').select2({
                    placeholder: 'Search or Select a Badge',
                    multiple: true,
                    allowClear: true,
                    data : data
                });
            }
        }( window.PopupForm1FormAItemBadgeForm = window.PopupForm1FormAItemBadgeForm || {}, jQuery ));
    </script>
@endpush
@endonce
