<!--- media-search --->
@php $modalClassName = $modalClassName ?? ''; @endphp
<div class="modal fade modal-cyan {{ $modalClassName }}" id="modal-media" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1060;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1180px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="px-2" style="background-color: #f5f5f5;">
                <div class="mt-2 mb-2 card">
                    <ul class="nav nav-tabs nav-tabs-solid rounded my-0">
                        <li class="nav-item"><a href="#file-upload" class="nav-link rounded radius-r0 active" data-toggle="tab">미디어 업로드</a></li>
                        <li class="nav-item"><a href="#media-search" class="nav-link" data-toggle="tab">미디어 붙여넣기</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="file-upload">
                        @include('front.dabory.erp.popup-form1.form-b.media-form', [
                            'formB' => $moealSetFile['MediaParameter'],
                        ])
                    </div>
                    <div class="tab-pane fade" id="media-search">
                        <div class="mb-1 pt-2 text-right btn-groups">
                            <button type="button" class="btn btn-success btn-sm modal-search position-static media-save-spinner-btn" disabled>
                                <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                            <button type="button" class="btn btn-success btn-sm icon-search4 modal-search position-static media-search-btn" data-target="media" data-class="{{ $modalClassName }}">
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary media-search-act save-button" data-value="save" {{ $moealSetFile['FormVars']['Hidden']['SaveButton'] }}>
                                    {{ $moealSetFile['FormVars']['Title']['SaveButton'] }}
                                </button>
                                @include('front.dabory.erp.partial.select-btn-options', [
                                    'selectBtns' => $moealSetFile['SelectButtonOptions'],
                                    'eventClassName' => 'media-search-act',
                                ])
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header modal-body my-0 py-2" id="frm">
                                <div class="row p-0">
                                    {{-- 기본 텍스트 --}}
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="{{ $moealSetFile['FormVars']['Display']['DateRange'] }} flex-column mb-2">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['DateRange'] }}</label>
                                            <div class="d-flex align-items-center" style="height: 28px;">
                                                @foreach ($moealSetFile['DateRangeOptions'] as $key => $option)
                                                    <input  autocomplete="off" name="media-date-range" type="radio" value="{{ $option['Value'] }}" id="{{ 'media-date-range-'.($key+1) }}"
                                                    {{ $option['Value'] == 'all' ? 'checked' : ''}} onchange="change_media_query_speed()">
                                                    <label for="{{ 'media-date-range-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="{{ $moealSetFile['FormVars']['Display']['Date'] }} flex-column">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['Date'] }}</label>
                                            <div class="d-flex">
                                                <input class="rounded overflow-hidden w-100 text-nowrap" id="media-start-date" type="date" value="1990-01-01">
                                                <label class="btn disabled p-1 text-center">~</label>
                                                <input class="rounded overflow-hidden w-100 text-nowrap" id="media-end-date" type="date" value="3000-12-31">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg col-md-6 col-12">
                                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SlipNo'] }}</label>
                                            <input type="text" id="slip-no-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['SlipNo'] }}>
                                        </div>
                                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['MediaName'] }}</label>
                                            <input type="text" id="media-name-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['MediaName'] }}>
                                        </div>
                                    </div>
                                    <div class="col-lg col-md-6 col-12">
                                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['FileName'] }}</label>
                                            <input type="text" id="file-name-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['FileName'] }}>
                                        </div>
                                        <div class="d-flex flex-column" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['LinkLocation'] }}</label>
                                            <input type="text" id="link-location-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['LinkLocation'] }}>
                                        </div>
                                    </div>
                                    <div class="col-lg col-md-6 col-12">
                                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['UserName'] }}</label>
                                            <input type="text" id="user-name-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['UserName'] }}>
                                        </div>
                                        <div class="d-flex flex-column" style="height: 50px;">
                                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['BranchName'] }}</label>
                                            <input type="text" id="branch-name-txt" class="rounded w-100" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['BranchName'] }}>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body modal-footer px-2">
                                <div class="mt-2 mb-2 table-responsive" style="height: 400px;">
                                    <table class="table-row">
                                        <thead id="table-head">
                                        </thead>
                                        <tbody id="table-body">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row">
                                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="media" data-class="{{ $modalClassName }}">
                                        @include('front.outline.moption')
                                    </select>
                                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                                        <select class="modal-order-by-select w-100 rounded" data-target="media" data-class="{{ $modalClassName }}">
                                        </select>
                                    </div>
                                    <ul class="pagination pagination-sm"></ul>
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
<script src="{{ csset('/js/modals-controller/list-type1/media.js') }}"></script>

@endonce
