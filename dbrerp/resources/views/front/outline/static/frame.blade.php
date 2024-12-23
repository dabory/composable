<!--- {{ 작성 }}-search --->
{{-- 고정 변수명 $moealSetFile --}}
{{-- $moealSetFile['FormVars']['Title']['변수명'] --}}
{{-- input에 hidden 처리 하기 --}}
<div class="modal fade" id="modal-{{ 아이디 입력 }}" aria-hidden="true" data-backdrop="static" style="display: none; z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-primary p-2">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row p-0 mt-2 m-auto">
                    <div class="col-lg-3 col-md-6 col-12">

                        {{-- 라디오 버튼 --}}
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">{{ 라벨 이름 }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;">
                                @foreach ({{ 배열 변수 입력 }} as $key => $option)
                                    <input class="w-100" autocomplete="off" name="{{ name 입력 }}" type="radio" value="{{ $option['Value'] }}" id="{{ 'name 입력-'.($key+1) }}"
                                        {{-- 초기에 체크 할 버튼 --}}
                                        {{ $option['Value'] == 'all' ? 'checked' : ''}}>
                                    <label for="{{ 'name 입력-'.($key+1) }}" class="w-100 rounded overflow-hidden mr-0 text-nowrap">{{ $option['Caption'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- 날짜 --}}
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">날짜</label>
                            <div class="d-flex">
                                <input class="rounded overflow-hidden w-100 text-nowrap {{ 클래스명 입력 }}" type="date" value="{{ 초기벨류 }}">
                                <button class="btn disabled p-1 text-center">~</button>
                                <input class="rounded overflow-hidden w-100 text-nowrap {{ 클래스명 입력 }}" type="date" value="{{ 초기벨류 }}">
                            </div>
                        </div>

                        {{-- 라디오 버튼 수동 입력 --}}
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">{{ 라벨명 }}</label>
                            <div class="d-flex align-items-center" style="height: 28px;">
                                <input class="w-100" name="{{ 변수 작성 }}" type="radio" value="0" id="{{ 변수 작성 }}-1" checked>
                                <label class="w-100 rounded overflow-hidden mr-0 text-nowrap" for="{{ 변수 작성 }}-1">일반</label>

                                <input class="w-100" name="{{ 변수 작성 }}" type="radio" value="1" id="{{ 변수 작성 }}-2">
                                <label class="w-100 rounded overflow-hidden mr-0 text-nowrap" for="{{ 변수 작성 }}-2">빠르게</label>

                                <input class="w-100" name="{{ 변수 작성 }}" type="radio" value="2" id="{{ 변수 작성 }}-3">
                                <label class="w-100 rounded overflow-hidden mr-0 text-nowrap" for="{{ 변수 작성 }}-3">디테일하게</label>
                            </div>
                        </div>
                    </div>

                    {{-- 기본 텍스트 --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">{{ 라벨 작성 }}</label>
                            <input type="text" class="rounded w-100 {{ 클래스명 입력 }}" autocomplete="off">
                        </div>
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">{{ 라벨 작성 }}</label>
                            <input type="text" class="rounded w-100 {{ 클래스명 입력 }}" autocomplete="off">
                        </div>
                        <div class="d-flex flex-column mb-2" style="height: 50px;">
                            <label class="m-0 font-weight-bold">{{ 라벨 작성 }}</label>
                            <input type="text" class="rounded w-100 {{ 클래스명 입력 }}" autocomplete="off">
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-dark btn-sm icon-search4 modal-search position-absolute"
                    style="right: 5px; top:5px;" data-target="{{ 작성 }}">
                </button>
            </div>
            <div class="modal-footer">
                <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                    <table class="table-row">
                        <thead id="table-head">
                        </thead>
                        {{-- 체크박스 표시 --}}
                        {{-- <tr id="th-check-box" hidden>
                            <th class="text-center p-0" style="width: 5px"></th>
                        </tr> --}}
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <div class="px-md-0 px-1 w-100 d-flex justify-content-around align-items-stretch align-items-md-center flex-column flex-md-row">
                    <select class="modal-line-select mb-md-0 mb-2 rounded" data-target="{{ 작성 }}">
                        @include('front.outline.moption')
                    </select>
                    <div class="d-flex mb-md-0 mb-2 flex-column flex-md-row align-items-stretch align-items-md-center">
                        <label class="m-0 mr-1 w-20 font-weight-bold" id="oderby-label"></label>
                        <select class="modal-order-by-select w-100 rounded" data-target="{{ 작성 }}">
                        </select>
                    </div>
                    <ul class="pagination pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
