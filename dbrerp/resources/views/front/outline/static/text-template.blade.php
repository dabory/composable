<!--- item-search --->
@php $modalClassName = $modalClassName ?? ''; @endphp
<div class="modal fade modal-cyan {{ $modalClassName }}" id="modal-text_template" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1060;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1180px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row p-0 mt-2 m-auto">
                    {{-- 기본 텍스트 --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['ItemCode'] }}</label>
                            <input type="text" class="rounded w-100 item-code" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['ItemCode'] }}>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['ItemName'] }}</label>
                            <input type="text" class="rounded w-100 item-name" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['ItemName'] }}>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['SubName'] }}</label>
                            <input type="text" class="rounded w-100 sub-name" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['SubName'] }}>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-dark btn-sm icon-search4 modal-search position-absolute" data-target="item" data-class="{{ $modalClassName }}">
                </button>
            </div>
            <div class="modal-footer">
                <div class="col mt-2 mb-2 table-responsive" style="height: 400px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="mms_wrap col-3 pr-0" id="text-template-form" style="height: 400px;">
                    <div class="mms w-100 pb-0" id="frm">
                        <div class="input_field mt-0 w-100 radius-r0 radius-l0">
                            <input type="hidden" id="Id" name="Id" value="0">
                            <div class="txt_byte">
                                <div class="byte-info">
                                    <span class="cur-byte">0</span>/999 byte
                                </div>
                            </div>
                            <div class="input_box">
                                <ul class="nav nav-tabs nav-tabs-solid rounded">
                                    <li class="nav-item main-text-tab"><a href="#main-text-tab" class="nav-link rounded-left active" data-toggle="tab">{{ $moealSetFile['FormVars']['Title']['TextTab'] }}</a></li>
                                    <li class="nav-item"><a href="#main-media-tab" class="nav-link" data-toggle="tab">{{ $moealSetFile['FormVars']['Title']['MediaTab'] }}</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="main-text-tab" style="height: 330px;">
                                        <textarea id="main-text-txt-area" class="h-100" disabled></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="main-media-tab" style="height: 330px;">
                                        <div class="py-1"></div>
                                        <div id="main-media-group" style="overflow-y: scroll; height: 310px;">
                                            <img class="w-100 mb-1" src="http://localhost:8080/uploads/2021/10/%E1%84%8B%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%B21.jpg">
                                            <img class="w-100 mb-1" src="http://localhost:8080/uploads/2021/10/%E1%84%8B%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%B21.jpg">
                                            <img class="w-100 mb-1" src="http://localhost:8080/uploads/2021/10/%E1%84%8B%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%B21.jpg">
                                            <img class="w-100 mb-1" src="http://localhost:8080/uploads/2021/10/%E1%84%8B%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%B21.jpg">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="item" data-class="{{ $modalClassName }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="item" data-class="{{ $modalClassName }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="/js/modals-controller/a-type/text-template.js?{{date('YmdHis')}}"></script>
@endonce
