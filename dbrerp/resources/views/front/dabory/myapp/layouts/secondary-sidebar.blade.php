<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar tabs -->
        <div class="sortable">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a href="#components-tab" class="nav-link active" data-toggle="tab">
                        고객정보
                    </a>
                </li>

                <li class="nav-item" style="background-color: #f5f5f5">
                    <a href="#forms-tab" class="nav-link" data-toggle="tab">

                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show px-2" id="components-tab">
                    <div class="card card card-primary mb-3 mb-md-0 border-light">
                        <div class="card-header p-0 mb-2">
                            {{-- <p class="card-title p-1 ml-2">주요 정보</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">고객 코드</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">고객 약칭</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">고객 명</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">휴대 전화</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">유션 전화</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">이메일</label>
                                <input class="rounded w-100" type="text" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">고객분류*</label>
                                <select class="rounded w-100" data-closed="0" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0 ">우편번호</label>
                                <div class="d-flex">
                                    <input type="text" data-id="0" class="rounded w-100 radius-r0" autocomplete="off" required>
                                    <button type="button"
                                        class="btn-dark rounded btn-open-modal border-0 radius-l0 col-3"
                                        data-target="company"
                                        data-clicked="get_supplier_id"
                                        data-variable="companyModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">주소</label>
                                <textarea style="height: 85px" class="rounded w-100" id="remarks-txt-area"></textarea>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="mr-1 mb-0">문자발송</label>
                                <input class="rounded mb-0" type="checkbox" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="mr-1 mb-0">이메일발송</label>
                                <input class="rounded mb-0" type="checkbox" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="mr-1 mb-0">디엠발송</label>
                                <input class="rounded mb-0" type="checkbox" required>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="m-0">적요(M)</label>
                                <textarea style="height: 85px" class="rounded w-100" id="remarks-txt-area"></textarea>
                            </div>
                            <div class="d-flex flex-column">
                                <button class="btn btn-light">고객별 연말정산</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="forms-tab">
                </div>
            </div>
        </div>
    </div>
    <!-- /sidebar content -->

</div>
