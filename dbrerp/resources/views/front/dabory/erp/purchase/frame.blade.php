@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content purchase">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal item-modal-btn"
                    data-target="item"
                    data-clicked="Btype.get_item_id"
                    data-variable="itemModal">
                </button>

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary pquote-act" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
                        {{ $formB['FormVars']['Title']['SaveButton'] }}
                    </button>
                    @include('front.dabory.erp.partial.select-btn-options', [
                        'selectBtns' => $formB['HeadSelectOptions'],
                        'eventClassName' => 'pquote-act',
                    ])
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="Id" name="Id" value="0">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0 overflow-hidden text-nowrap">11</label>
                                        <div class="col-12 d-flex p-0">
                                            <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                                onclick="get_last_slip_no(this)">
                                                <span class="icon-cogs"></span>
                                            </button>
                                            <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" required disabled>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">22</label>
                                        <input class="rounded w-100" type="date" value="" id="" required>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0 ">33</label>
                                        <div class="d-flex">
                                            <input type="text" id="supplier-txt" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" required disabled>
                                            <button type="button"
                                                class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3"
                                                data-target="company"
                                                data-clicked="get_supplier_id"
                                                data-variable="companyModal">
                                                <i class="icon-folder-open"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">44</label>
                                        <input class="rounded w-100" type="text" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0 ">11</label>
                                        <select class="rounded w-100" id="deal-type-select" required>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">22</label>
                                        <select class="rounded w-100" id="vat-type-select" onchange="set_vat_type_rate(this)" required>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">33</label>
                                        <input type="text" id="vat-type-rate-text" class="rounded w-100" autocomplete="off" value="" disabled>
                                    </div>
                                    <div class="d-flex flex-column ">
                                        <label class="m-0">44</label>
                                        <select class="rounded w-100" data-closed="0" id="status-select" onchange="Btype.set_is_closed_val(this)">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 250px"><!--260-->
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">11</label>
                                        <select class="rounded w-100" id="delivery-select"></select>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">22</label>
                                        <select class="rounded w-100" id="payTerms-select"></select>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">33</label>
                                        <select class="rounded w-100" id="-select"></select>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">44</label>
                                        <input class="rounded w-100" type="text" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-3 mb-md-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">기타</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">11</label>
                                        <textarea style="height: 85px" class="rounded w-100" id="remarks-txt-area"></textarea>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">22</label>
                                        <input class="rounded w-100" type="text" required>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="m-0">33</label>
                                        <input class="rounded w-100" type="text" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-danger mb-0 border-light" style="height: 250px">
                                <div class="card-header p-0 mb-2">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">44</label>
                                        <select class="rounded w-100" data-closed="0" id="">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column mb-2">
                                        <label class="m-0">22</label>
                                        <input class="rounded w-100" type="text" required>
                                    </div>
                                    <div class="d-flex flex-column ">
                                        <label class="m-0">33</label>
                                        <select class="rounded w-100" data-closed="0" id="">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 mt-2 mx-2">
                    <div id="">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary mr-1" onclick="Btype.seq_no_up_down(this, 'down')"
                                data-clicked="">▼
                            </button>
                            <button class="btn btn-primary mr-1" onclick="Btype.seq_no_up_down(this, 'up')"
                                data-clicked="">▲
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary porder-bd-act" data-value="add">
                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $formB['BodySelectOptions'],
                                    'eventClassName' => 'porder-bd-act'
                                ])
                            </div>
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;">
                            <table class="table-row">
                                <thead id="porder-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="porder-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-end col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            @foreach ($formB['FooterVars']['Title'] as $key => $title)
                                <div class="d-flex align-items-stretch  flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden'][$key] }}
                                        rowspan="1" colspan="1">
                                        {{ $title }}
                                    </label>
                                    <input type="text" class="w-80 rounded" id="{{ $key }}" disabled>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('js')
    <script>

    </script>
@endsection
