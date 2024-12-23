@extends('front.dabory.myapp.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Global stylesheets -->
    <link href="{{ csset('/css/dashboard/components.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->


    <script src="{{ csset('/js/dashboard/echarts.min.js') }}"></script>
    {{-- <script src="/js/dashboard/dashboard.js"></script> --}}
    <script src="{{ csset('/js/dashboard/streamgraph.js') }}"></script>
    <script src="{{ csset('/js/dashboard/sparklines.js') }}"></script>
    <script src="{{ csset('/js/dashboard/lines.js') }}"></script>
    <script src="{{ csset('/js/dashboard/areas.js') }}"></script>
    <script src="{{ csset('/js/dashboard/donuts.js') }}"></script>
    <script src="{{ csset('/js/dashboard/bars.js') }}"></script>
    <script src="{{ csset('/js/dashboard/progress.js') }}"></script>
    <script src="{{ csset('/js/dashboard/heatmaps.js') }}"></script>
    <script src="{{ csset('/js/dashboard/pies.js') }}"></script>
    <script src="{{ csset('/js/dashboard/bullets.js') }}"></script>

    <style>
        .content {
            padding: 0;
        }

        .content>.content {
            padding: 0.5rem;
        }

        /* 부모 컨테이너가 flexbox로 설정 */
        .tab-pane {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* media-body가 한 개만 있을 때에도 최소한 화면을 채우도록 */
        .media-body {
            flex-grow: 1; /* 남은 공간을 채우도록 설정 */
        }

        /* footer를 페이지 하단에 고정 */
        .footer {
            margin-top: auto; /* 콘텐츠가 부족할 경우 footer를 하단으로 밀어넣음 */
        }

        .cancel {
            display: flex;
            flex-direction: column;
            min-height: 400px; /* 다른 요소들에 영향을 주지 않으면서 높이를 조정 */
        }

    </style>

    <div class="content dbr_standard1_dash">
        <div class="row">
            <div class="col-xl-8">
                <!-- 색깔 카드 -->
                <div class="summary  row">
                    <!-- 신규주문 -->
                    <div class="col-lg-4">
                        <div class="new_order card bg-teal-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">0 원</h3>
                                    <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">Blank</span> </div>
                                <div> 0%
                                    <div class="font-size-sm opacity-75">0건</div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div id="members-online"></div>
                            </div>
                        </div>
                    </div>
                    <!-- //신규주문 끝 -->

                    <!-- 처리지연 -->
                    <div class="col-lg-4">
                        <div class="card bg-pink-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">0 건</h3>
                                    <span class="badge bg-pink-800 badge-pill align-self-center ml-auto">Blank</span>
                                </div>
                                <div> 0 원
                                    <div class="font-size-sm opacity-75">0%</div>
                                </div>
                            </div>
                            <div id="server-load"></div>
                        </div>
                    </div>
                    <!--// 처리지연 끝 -->

                    <!-- 취소반품 -->
                    <div class="col-lg-4">
                        <div class="card bg-blue-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">0 원</h3>
                                    <span class="badge bg-blue-800 badge-pill align-self-center ml-auto">Blank</span>
                                </div>
                                <div> 0 건
                                    <div class="font-size-sm opacity-75">0 건</div>
                                </div>
                            </div>
                            <div id="today-revenue"></div>
                        </div>
                    </div>
                    <!--// 취소반품 끝 -->
                </div>
                <!-- //색깔 카드 끝 -->

                <!--row -->
                <div class="row">
                    <!-- 신규주문내역-->
                    <div class="new_order col-lg-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                    Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">0 건 </span>

                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//신규주문내역 -->

                    <!-- 처리지연내역 -->
                    <div class="delay col-lg-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                    Blank
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">0 건</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//처리지연내역 끝 -->

                    <!-- 취소 반품 -->
                    <div class="cancel col-lg-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                    Blank
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">0 건 </span>
                                    <div class="list-icons ml-3">
                                        <div class="dropdown"> <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a> <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a> <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//취소 반품 끝 -->

                    <!-- 상품문의 -->
                    <div class="inquiry col-lg-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th colspan="3">
                                            <div>
                                                Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                                <select class="form-control custom-select" id="select_date">
                                                    <option value="val1">Blank</option>
                                                    <option value="val2">Blank</option>
                                                    <option value="val3">Blank</option>
                                                    <option value="val3">Blank</option>
                                                </select>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="sort text-blue font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sort text-purple font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sort text-success font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sort text-success font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sort text-success font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sort text-success font-weight-semibold">Blank</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">Blank</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--// 상품문의 끝 -->

                    <!-- 상품 관리 내역 -->
                    <div class="manage col-lg-12">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">0 건</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 개</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>Blank</span>
                                        <span>0 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: 0%">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// 상품 관리 내역 끝 -->

                    <!-- 상품 관리 -->
                    <!-- <div class="inquiry col-lg-12">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                    <a href="#">상품 관리 <i class="fas fa-chevron-right"></i></a>
                                </h6>
                                <div class="header-elements">
                                    <div class="form-check form-check-inline form-check-right form-check-switchery form-check-switchery-sm">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-input-switchery" id="realtime" checked="" data-fouc="" data-switchery="true" style="display: none;">
                                            <span class="switchery switchery-default" style="background-color: rgb(100, 189, 99); border-color: rgb(100, 189, 99); box-shadow: rgb(100, 189, 99) 0px 0px 0px 10px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 18px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>
                                            실시간 보기
                                        </label>
                                    </div>
                                    <span class="badge bg-danger-400 badge-pill">+86</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="chart mb-3" id="bullets"></div>
                            </div>
                        </div>
                    </div> -->
                    <!--// 상품 관리 끝 -->
                </div>
                <!--// row 끝 -->
            </div>

            <div class="col-xl-4">
                <!-- 공지사항 -->
                <div class="notice card">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th colspan="3">
                                    <div>
                                        Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                        <select class="form-control custom-select" id="select_date">
                                            <option value="val1">Blank</option>
                                            <option value="val2">Blank</option>
                                            <option value="val3">Blank</option>
                                            <option value="val4">Blank</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="sort text-blue font-weight-semibold">Blank</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td class="sort text-purple font-weight-semibold">Blank</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td class="sort text-success font-weight-semibold">Blank</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td class="sort text-success font-weight-semibold">Blank</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--//공지사항 끝 -->

                <!-- 리뷰 -->
                <div class="review card">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th colspan="4">
                                    <div>
                                    Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                        <select class="form-control custom-select" id="select_date">
                                            <option value="val1">Blank</option>
                                            <option value="val2">Blank</option>
                                            <option value="val3">Blank</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank<span></td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-success mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank<span></td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-success mr-1">Blank</div>
                                        <div><a href="#" class="font-weight-semibold">Blank</a></div>
                                    </div>
                                </td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                                <td><span class="text-muted font-size-sm">Blank</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--//리뷰 끝 -->

                <!-- 판매통계 -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">
                            Blank <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                        </h6>
                        <div class="header-elements">
                            <select class="form-control custom-select" id="select_date">
                                <option value="val1">Blank</option>
                                <option value="val2">Blank</option>
                                <option value="val4">Blank</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">0</h5>
                                    <span class="text-muted font-size-sm">Blank</span> </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">0</h5>
                                    <span class="text-muted font-size-sm">Blank</span> </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">$0</h5>
                                    <span class="text-muted font-size-sm">Blank</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart mb-2" id="app_sales"></div>
                    <!-- <div class="chart" id="monthly-sales-stats"></div> -->
                </div>
                <!--// 판매통계 끝 -->

                <!-- 정산내역 -->
                    <div class="card-header header-elements-inline">

                    <!-- Numbers -->
                    <!-- <div class="card-body py-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">2,345</h5>
                                    <span class="text-muted font-size-sm">표준판매가 기준</span> </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">3,568</h5>
                                    <span class="text-muted font-size-sm"></span>수수료 등</div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">3,568</h5>
                                    <span class="text-muted font-size-sm">이번 정산 금액</span> </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- /numbers -->

                    <!-- Area chart -->
                    <!-- <div id="messages-stats"></div> -->
                    <!-- /area chart -->

                    <!-- Tabs -->
                    <!-- <ul class="nav nav-tabs nav-tabs-solid nav-justified bg-indigo-400 border-x-0 border-bottom-0 border-top-indigo-300 mb-0">
                        <li class="nav-item"> <a href="#messages-tue" class="nav-link font-size-sm text-uppercase active" data-toggle="tab"> Tuesday </a> </li>
                        <li class="nav-item"> <a href="#messages-mon" class="nav-link font-size-sm text-uppercase" data-toggle="tab"> Monday </a> </li>
                        <li class="nav-item"> <a href="#messages-fri" class="nav-link font-size-sm text-uppercase" data-toggle="tab"> Friday </a> </li>
                    </ul> -->
                    <!-- /tabs -->

                    <!-- Tabs content -->
                        <div class="tab-pane active fade show" id="messages-tue">
                                    <div class="media-body"></div>
                                <!--
                                                            <li class="media">
                                                                <div class="mr-3 position-relative"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">6</span> </div>
                                                                <div class="media-body">
                                                                    <div class="d-flex justify-content-between"> <a href="#">수수료 합계</a> <span class="font-size-sm text-muted">12:16</span> </div>
                                                                    5,000 </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                                                <div class="media-body">
                                                                    <div class="d-flex justify-content-between"> <a href="#">Jeremy Victorino</a> <span class="font-size-sm text-muted">09:48</span> </div>
                                                                    Pert thickly mischievous clung frowned well... </div>
                                                            </li> -->
                        <div class="tab-pane fade" id="messages-mon">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Isak Temes</a> <span class="font-size-sm text-muted">Tue, 19:58</span> </div>
                                        Reasonable palpably rankly expressly grimy... </div>
                                </li>
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Vittorio Cosgrove</a> <span class="font-size-sm text-muted">Tue, 16:35</span> </div>
                                        Arguably therefore more unexplainable fumed... </div>
                                </li>
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Hilary Talaugon</a> <span class="font-size-sm text-muted">Tue, 12:16</span> </div>
                                        Nicely unlike porpoise a kookaburra past more... </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="messages-fri">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Owen Stretch</a> <span class="font-size-sm text-muted">Mon, 18:12</span> </div>
                                        Tardy rattlesnake seal raptly earthworm... </div>
                                </li>
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Jenilee Mcnair</a> <span class="font-size-sm text-muted">Mon, 14:03</span> </div>
                                        Since hello dear pushed amid darn trite... </div>
                                </li>
                                <li class="media">
                                    <div class="mr-3"> <img src="/public/images/placeholders/placeholder.jpg" class="rounded-circle" width="36" height="36" alt=""> </div>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between"> <a href="#">Alaster Jain</a> <span class="font-size-sm text-muted">Mon, 13:59</span> </div>
                                        Dachshund cardinal dear next jeepers well... </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /tabs content -->

                </div>
                <!--// 정산내역 -->
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        var {children: titles} = document.querySelector(".animate-text");
        var txtsLen = titles.length;
        var index = 0;
        var textInTimer = 4000;
        var textOutTimer = 4000;

        function animateText() {
            for (var i = 0; i < txtsLen; i++) {
                titles[i].classList.remove("text-in", "text-out");
            }
            titles[index].classList.add("text-in");

            setTimeout(function () {
                titles[index].classList.add("text-out");
            }, textOutTimer);

            setTimeout(function () {
                if (index == txtsLen - 1) {
                    index = 0;
                } else {
                    index++;
                }
                animateText();
            }, textInTimer);
        }

        window.onload = animateText;
    </script>
@endpush

