<!--- company-search --->
@php $modalClassName = $modalClassName ?? ''; @endphp
<div class="modal fade modal-green {{ $modalClassName }}" id="modal-company" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1060;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 1150px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <div>
                    <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    <button type="button" class="close" onclick="unlink_company()"><i class="icon-unlink"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row p-0 mt-2 m-auto">

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['CompanyName'] }}</label>
                            <input type="text" class="rounded w-100 company-name filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['CompanyName'] }}>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['MainContact'] }}</label>
                            <input type="text" class="rounded w-100 main-contact filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['MainContact'] }}>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['MobileNo'] }}</label>
                            <input type="text" class="rounded w-100 mobile-no filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['MobileNo'] }}>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0">{{ $moealSetFile['FormVars']['Title']['TelNo'] }}</label>
                            <input type="text" class="rounded w-100 tel-no filter" autocomplete="off" {{ $moealSetFile['FormVars']['Hidden']['TelNo'] }}>
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-dark btn-sm icon-search4 modal-search position-absolute"
                    data-target="company" data-class="{{ $modalClassName }}">
                </button>
            </div>
            <div class="modal-footer">
                <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row btn_wrap">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="company" data-class="{{ $modalClassName }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="company" data-class="{{ $modalClassName }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="{{ csset('/js/modals-controller/a-type/company.js') }}"></script>
@endonce
{{-- @once
@push('js')
    <script src="/js/modals-controller/a-type/company.js?{{date('YmdHis')}}"></script>
@endpush
@endonce --}}
