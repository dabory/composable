@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content purchase">
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right">
                <button type="button" hidden
                    class="btn btn-success btn-open-modal window item-modal-btn"
                    data-target="item"
                    data-clicked="Btype.get_item_id"
                    data-variable="itemModal">
                </button>

                <button type="button" hidden
                    class="btn btn-success btn-open-modal modal-btn">
                </button>

                <button type="button"
                    class="btn btn-success btn-open-modal"
                    data-target="slip"
                    data-clicked="Btype.fetch_slip_form_book"
                    data-variable="slipModal">
                    <i class="icon-folder-open"></i>
                </button>

{{--                <button type="button" class="btn btn-sm btn-primary save-spinner-btn">--}}
{{--                    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>--}}
{{--                        Loading...--}}
{{--                </button>--}}
{{--                <div class="btn-group" hidden>--}}
{{--                    <button type="button" class="btn btn-sm btn-primary media-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>--}}
{{--                        {{ $formB['FormVars']['Title']['SaveButton'] }}--}}
{{--                    </button>--}}
{{--                    @include('front.dabory.erp.partial.select-btn-options', [--}}
{{--                        'selectBtns' => $formB['HeadSelectOptions'],--}}
{{--                        'eventClassName' => 'media-act',--}}
{{--                    ])--}}
{{--                </div>--}}
            </div>

            <div class="card" id="media-form">
                <div class="card-header" id="frm">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="Id" name="Id" value="0">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0 overflow-hidden text-nowrap">{{ $formB['FormVars']['Title']['AutoSlipNo'] }}</label>
                                        <div class="col-12 d-flex p-0">
                                            <button id="auto-slip-no-btn" class="btn-dark border-white rounded overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                                onclick="get_last_slip_no(this)" disabled>
                                                <span class="icon-cogs"></span>
                                            </button>
                                            <input type="text" id="auto-slip-no-txt" class="rounded w-100 radius-l0" autocomplete="off" disabled
                                                   maxlength="{{ $formB['FormVars']['MaxLength']['AutoSlipNo'] }}"
                                                {{ $formB['FormVars']['Required']['AutoSlipNo'] }}>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['Date'] }}</label>
                                        <input class="rounded w-100" type="date" value="" id="media-date"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['Date'] }}"
                                            {{ $formB['FormVars']['Required']['Date'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['MediaName'] }}</label>
                                        <input class="rounded w-100" id="media-name-txt" type="text"
                                               maxlength="{{ $formB['FormVars']['MaxLength']['MediaName'] }}"
                                            {{ $formB['FormVars']['Required']['MediaName'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래구분 / 세율</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['FileUrl'] }}</label>
                                        <input type="text" id="file-url-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['FileUrl'] }}"
                                            {{ $formB['FormVars']['Required']['FileUrl'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['FileSize'] }}</label>
                                        <input type="text" id="file-size-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['FileSize'] }}"
                                            {{ $formB['FormVars']['Required']['FileSize'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['MineType'] }}</label>
                                        <input type="text" id="mine-type-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['MineType'] }}"
                                            {{ $formB['FormVars']['Required']['MineType'] }}>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg card-header-item">
                            <div class="card card card-success mb-3 mb-md-2 mb-lg-0 border-light" style="height: 200px">
                                <div class="card-header p-0 mb-2">
                                    {{-- <p class="card-title p-1 ml-2">거래 조건</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['MediaBrand'] }}</label>
                                        <input type="text" id="media-brand-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['MediaBrand'] }}"
                                            {{ $formB['FormVars']['Required']['MediaBrand'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['MediaWidth'] }}</label>
                                        <input type="text" id="media-width-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['MediaWidth'] }}"
                                            {{ $formB['FormVars']['Required']['MediaWidth'] }}>
                                    </div>
                                    <div class="form-group d-flex flex-column mb-2">
                                        <label class="m-0">{{ $formB['FormVars']['Title']['MediaHeight'] }}</label>
                                        <input type="text" id="media-height-text" class="rounded w-100" autocomplete="off" value=""
                                               maxlength="{{ $formB['FormVars']['MaxLength']['MediaHeight'] }}"
                                            {{ $formB['FormVars']['Required']['MediaHeight'] }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 mt-2 mx-2">
                    <div id="">
                        <div class="d-flex justify-content-end">
{{--                            <button class="btn btn-primary mr-1" id="down-btn" onclick="override_seq_no_up_down('down')"--}}
{{--                                data-clicked="">▼--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-primary mr-1" id="up-btn" onclick="override_seq_no_up_down('up')"--}}
{{--                                data-clicked="">▲--}}
{{--                            </button>--}}
{{--                            <div class="btn-group">--}}
{{--                                <button class="btn btn-sm btn-primary media-bd-act" data-value="add">--}}
{{--                                        {{ $formB['FormVars']['Title']['AddNewBdButton'] }}--}}
{{--                                </button>--}}
{{--                                @include('front.dabory.erp.partial.select-btn-options', [--}}
{{--                                    'selectBtns' => $formB['BodySelectOptions'],--}}
{{--                                    'eventClassName' => 'media-bd-act'--}}
{{--                                ])--}}
{{--                            </div>--}}
                        </div>

                        <div class="table-responsive mt-2" style="height:400px;" id="scroll-area">
                            <table class="table-row media-table">
                                <thead id="media-table-head">
                                    @include('front.dabory.erp.partial.make-thead', [
                                        'listVars' => $formB['ListVars'],
                                        'checkboxName' => 'bd-cud-check'
                                    ])
                                </thead>
                                <tbody id="media-table-body">
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer justify-content-between col-12 d-flex flex-column flex-md-row align-items-start align-items-stretch mb-2 p-2 border mt-2 rounded">
                            <div class="d-flex flex-column flex-md-row ml-0 ml-md-4">
                            </div>
                            <div class="d-flex flex-column flex-md-row">
                                <div class="d-flex align-items-stretch flex-column  mb-2 mb-md-0 px-2">
                                    <label class="w-100 overflow-hidden text-nowrap m-0 p-0" {{ $formB['FooterVars']['Hidden']['SumTotal'] }}>
                                        {{ $formB['FooterVars']['Title']['SumTotal'] }}
                                    </label>
                                    <input type="text" class="w-100 w-md-80 rounded" id="SumTotal" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $slipModal])
    @include('front.outline.static.image-uploaders')
@endsection

@push('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>

<script>
    window.onload = async function () {
        make_dynamic_table_css('.media-table', make_dynamic_table_px(formB['ListVars']['Size']))

        $(document).on('mouseenter', ".media-table .bd-file-url-txt", function () {
            if ($(this).prop('disabled')) {
                return
            }

            $(this).tooltip({
                html: true,
                title: `<img src="${window.env['MEDIA_URL'] + $(this).val()}"/>`,
                animated: 'fade',
                placement: 'right',
                container: 'body',
                // trigger: 'click'
            });
            $(this).tooltip('show');
            $('.tooltip-inner').css('max-width', '100%')

            $('.tooltip-inner img').css('max-width', '750px')
            $('.tooltip-inner img').css('max-height', '750px')

        }).on('mouseleave', '.media-table .bd-file-url-txt', function() {
            $('.tooltip').tooltip('dispose');
        });

        $(document).on('image.upload', '#modal-image-uploaders', async function (event, file_path, bd_file_url) {
            const response = await call_local_api(
                '{{ url("sub-image-upload") }}',
                {
                    form_file_path: file_path,
                    to_file_path: bd_file_url,
                }
            )

            if (response['status'] === 202) {
                iziToast.error({ title: 'Error', message: response.data })
                return
            }

            iziToast.success({ title: 'Success', message: 'image upload success' });
        });
    }

    function create_bd_page() {
        let html = []
        let sum_total = 0;
        bd_page.forEach(bd => {
            sum_total ++;

            // 품목코드, 수량, 단가, 공급가액, 세액, 합계금액
            html.push (
                `<tr>
                    <td class="text-${formB.ListVars['Align'].$Radio} px-import-0">
                        <input name="bd-cursor-state" type="radio" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Radio}"
                        onclick="Btype.bd_cursor_click(this)">
                    </td>
                    <td class="text-${formB.ListVars['Align'].$Check} px-import-0">
                        <input name="bd-cud-check" type="checkbox" value="1" tabindex="-1"
                        class="text-${formB.ListVars['Align'].$Check}">
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].BdFileUrl}" ${formB.ListVars['Hidden'].BdFileUrl}>
                        <div class="d-flex">
                            <input class="col-8 text-${formB.ListVars['Align'].BdFileUrl} border-0 bg-white bd-file-url-txt" type="text" disabled
                            value="${bd.BdFileUrl}">
                            <button class="btn-primary col overflow-hidden text-nowrap" onclick="show_upload_modal('${bd.BdFileUrl}')">화일 업로드</button>
                        </div>
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].ImageType}" ${formB.ListVars['Hidden'].ImageType}>${bd.ImageType}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].BdFileSize}" ${formB.ListVars['Hidden'].BdFileSize}>${bd.BdFileSize}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].BdWidth}" ${formB.ListVars['Hidden'].BdWidth}>${bd.BdWidth}
                    </td>
                    <td
                        class="text-${formB.ListVars['Align'].BdHeight}" ${formB.ListVars['Hidden'].BdHeight}>${bd.BdHeight}
                    </td>
                </tr>` )
        });

        $('#SumTotal').val(format_decimal(sum_total, 0));

        document.getElementById('media-table-body').innerHTML = html.join('');
        // $('#porder-table-body').html(html);
    }

    function show_upload_modal(bd_file_url) {
        $('#media-form').trigger('modal.show', bd_file_url);
        $('#modal-image-uploaders').modal('show')
    }


    function update_hd_ui(response) {
        if (isEmpty(response.data) || response.data.apiStatus) {
            $('#modal-slip').modal('hide');
            return;
        }
        Btype.set_slip_no_btn_disabled()

        let hd_page = response.data.HdPage[0]
        bd_page = response.data.BdPage ?? []
        // console.log(hd_page)
        // console.log(bd_page)

        $('#Id').val(hd_page.Id)
        $('#auto-slip-no-txt').val(hd_page.MediaNo)
        $('#media-date').val(moment(to_date(hd_page.MediaDate)).format('YYYY-MM-DD'))
        $('#media-name-txt').val(hd_page.MediaName)

        $('#file-url-text').val(hd_page.FileUrl)
        $('#file-size-text').val(hd_page.FileSize)
        $('#mine-type-text').val(hd_page.MineType)

        $('#media-width-text').val(hd_page.MediaWidth)
        $('#media-height-text').val(hd_page.MediaHeight)
        $('#media-brand-text').val(hd_page.MediaBrand)

        // table body에 데이터 추가
        create_bd_page();

        if (bd_page.length > 0) {
            let unique = bd_page[bd_page.length - 1].SeqNo * bd_page[bd_page.length - 1].Id + rand(1, 999);
            bd_page[bd_page.length - 1].cursorId = unique
        }

        $('#modal-slip').modal('hide')
    }

    const slipModal = {!! json_encode($slipModal) !!};
    var formB = {!! json_encode($formB) !!};
    var bd_page = [];
</script>
@endpush
