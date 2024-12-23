<div class="tab-pane fade active show" id="body-situation">
    <input type="hidden" id="Id" name="Id" value="0">
    <div class="card-header p-0 mr-1">
        <div class="row">
            <div class="col-7 pr-0 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">클레임 처리</label>
                            <div class="title-br"></div>
                            @php
                                $situationList = collect($codeTitle['body-situation']['sorder-bd'])->filter(function ($situation) {
                                    return $situation['Code'] !== '';
                                })->map(function ($situation) {
                                    return array_merge($situation, ['Unique' => $situation['Code'][0]]);
                                })->groupBy('Unique')->toArray();
                            @endphp
                            @foreach ($situationList as $chunk)
                                <div class="d-flex align-items-center mb-2">
                                    @forelse ($chunk as $key => $situation)
                                        @if ($situation['Code'] !== '' && $situation['Code'] !== 'ETC' && $situation['Code'] !== '')
                                            <div class="d-flex align-items-center mr-3">
                                                <input type="radio" name="body_situation" value="{{ $situation['Code'] }}" class="text-center mr-1" id="list-situation-radio-{{ $situation['Code'] }}">
                                                <label class="mb-0" for="list-situation-radio-{{ $situation['Code'] }}">
                                                    {{ $situation['Title'] }}
                                                </label>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 px-1 card-header-item">
                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <label class="m-0 font-weight-bold">클레임 사유</label>
                            <div class="title-br"></div>
                            <textarea id="body_situation_notes" style="height: 91px;"></textarea>
{{--                            <input type="text" class="rounded w-100" id="situation_notes">--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(async function() {
    });

    (function( ListTypeList1FromTab, $, undefined ) {
        ListTypeList1FromTab.save = async function () {
            const response = await get_api_data('sorder-bd-act', {
                Page : [
                    ListTypeList1FromTab.getParameter()
                ]
            })

            show_iziToast_msg(response.data, function () {
                $('#modal-select-popup.show').trigger('list.requery');
                // ListTypeList1FromTab.ui($('#delivery').find(`input[name="Id"]`).val())
            })
        }

        ListTypeList1FromTab.getParameter = function () {
            let id = parseInt($('#body-situation').find(`input[name="Id"]`).val());
            let parameter = {
                Id: id,
                BodySituation: $('#body-situation').find(`input:radio[name=body_situation]:checked`).val(),
                BodySituationNotes: $('#body-situation').find('#body_situation_notes').val(),
            }

            // console.log(parameter)
            return parameter;
        }

        ListTypeList1FromTab.ui = async function (id) {
            let response = await get_api_data('sorder-bd-pick', {
                Page : [ { Id: Number(id) } ]
            })
            const sorder_bd = response.data.Page[0]
            $('#body-situation').find(`input[name="Id"]`).val(sorder_bd['Id'])
            $('#body-situation').find(`input:radio[name=body_situation]:input[value='${sorder_bd['BodySituation']}']`).prop('checked', true)
            $('#body-situation').find('#body_situation_notes').val(sorder_bd['BodySituationNotes'])
        }

    }( window.ListTypeList1FromTab = window.ListTypeList1FromTab || {}, jQuery ));

</script>
