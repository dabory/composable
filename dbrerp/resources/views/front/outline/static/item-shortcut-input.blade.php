<div class="modal fade" id="modal-item-shortcut-input" aria-hidden="true" data-backdrop="static" style="z-index: 1049; overflow: auto;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 850px;">
        <div class="modal-content">
            <div class="modal-header bg-skyblue">
                <h4 class="modal-title text-white" id="myModalLabel">{{ $moealSetFile['General']['Title'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">

                <div class="card mb-2" id="item-shortcut-input-form">
                    <div class="card-header" id="frm">
                        <div class="row">
                            <div class="col-12 col-lg card-header-item">
                                <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                                    <div class="card-header p-0 mb-2">
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="d-flex flex-column mb-2">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SalesQty'] }}</label>
                                            <input type="number" id="sales-qty-txt" min="1" value="1" class="rounded" autocomplete="off">
                                        </div>
                                        <div class="d-flex flex-column mb-2">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['BarCode'] }}</label>
                                            <div class="row">
                                                <div class="col-8 pr-0">
                                                    <input type="text" id="bar-code-txt" class="rounded w-100" autocomplete="off">
                                                </div>
                                                <div class="col-4 pl-1">
                                                    <button class="btn-skyblue rounded w-100 h-100">{{ $moealSetFile['FormVars']['Title']['BarCodeButton'] }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row px-2 my-3" id="shortcut-items">
                                            @php
                                                $frequentCount = count($moealSetFile['ItemInputShortcutSetup']['FrequentItems']);
                                                $rowCount = intdiv($frequentCount, 4);
                                                if ($frequentCount % 4 !== 0) { $rowCount ++; }
                                            @endphp
                                            @foreach (collect($moealSetFile['ItemInputShortcutSetup']['FrequentItems'])->chunk($rowCount) as $chunk)
                                                <div class="col-3">
                                                    <div class="row">
                                                        @foreach ($chunk as $i => $item)
                                                            <button class="w-100 btn-skyblue mb-1 mr-1 rounded" onclick="itemShortcutInput.add_frequent_item('{{ $i }}')">
                                                                {{ $item['ButtonCation'] }}
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="d-flex flex-column mb-2">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['DiscountPrc'] }}</label>
                                            <div class="row">
                                                <div class="col-6 pr-0">
                                                    <input type="text" id="discount-prc-txt" class="decimal rounded w-100" data-point="{{ $moealSetFile['FormVars']['Format']['DiscountPrc'] }}">
                                                </div>
                                                <div class="col-6 pl-1">
                                                    <button class="btn-skyblue rounded w-100 h-100" onclick="itemShortcutInput.add_discount_prc()">
                                                        {{ $moealSetFile['FormVars']['Title']['DiscountPrcButton'] }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
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
    <script>
        $('#modal-item-shortcut-input').on('shown.bs.modal', function () {
            itemShortcutInput.data_init()
        });

        (function( itemShortcutInput, $, undefined ) {
            itemShortcutInput.itemInputShortcutSetup = {!! json_encode($moealSetFile['ItemInputShortcutSetup']) !!};

            itemShortcutInput.add_frequent_item = function (index) {
                const sales_qty = $('#item-shortcut-input-form').find('#sales-qty-txt').val()

                $('#modal-item-shortcut-input').trigger('add.frequent-item', [
                    itemShortcutInput.itemInputShortcutSetup['FrequentItems'][index]['ItemCode'],
                    isEmpty(sales_qty) ? itemShortcutInput.itemInputShortcutSetup['FrequentItems'][index]['BasicQty'] : sales_qty
                ]);

                // $('#modal-item-shortcut-input.show').modal('hide')
            }

            itemShortcutInput.data_init = function () {
                input_box_reset_for('#item-shortcut-input-form')
                $('#item-shortcut-input-form').find('#sales-qty-txt').val(1)
            }

            itemShortcutInput.add_discount_prc = function () {
                if (isEmpty($('#item-shortcut-input-form').find('#discount-prc-txt').val()) || $('#item-shortcut-input-form').find('#discount-prc-txt').val() <= 0) {
                    iziToast.error({ title: 'Error', message: @json(_e('Action failed')) });
                    return
                }
                $('#modal-item-shortcut-input').trigger('add.discount', [
                    $('#item-shortcut-input-form').find('#discount-prc-txt').val(),
                    itemShortcutInput.itemInputShortcutSetup['DiscountItem']
                ]);

                $('#modal-item-shortcut-input.show').modal('hide')
            }
        }( window.itemShortcutInput = window.itemShortcutInput || {}, jQuery ));
    </script>
@endpush
@endonce
