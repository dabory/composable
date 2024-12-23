@extends('front.dabory.pro.my-app.layouts.master')
@section('content')

    <link href="/css/dashboard/components.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->


    <script src="/js/dashboard/echarts.min.js"></script>
    <script src="/js/dashboard/streamgraph.js"></script>
    <script src="/js/dashboard/sparklines.js"></script>
    <script src="/js/dashboard/lines.js"></script>
    <script src="/js/dashboard/areas.js"></script>
    <script src="/js/dashboard/donuts.js"></script>
    <script src="/js/dashboard/bars.js"></script>
    <script src="/js/dashboard/progress.js"></script>
    <script src="/js/dashboard/heatmaps.js"></script>
    <script src="/js/dashboard/pies.js"></script>
    <script src="/js/dashboard/bullets.js"></script>
    <script src="/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="/js/plugins/visualization/d3/d3_tooltip.js"></script>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">홈</span> - 대시보드</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn-link btn-float text-default"><i
                            class="icon-bars-alt text-primary"></i><span>접속통계</span></a>
                    <a href="#" class="btn-link btn-float text-default"><i class="icon-calculator text-primary"></i>
                        <span>공지사항</span></a>
                    <a href="#" class="btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i>
                        <span>문의사항</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> 홈</a>
                    <span class="breadcrumb-item active">대시보드</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <a href="#" class="breadcrumb-elements-item">
                        <i class="icon-comment-discussion mr-2"></i>
                        문의사항
                    </a>

                    <div class="breadcrumb-elements-item dropdown p-0">
                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-gear mr-2"></i>
                            설정
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                            <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <div class="p-2" style="background-color: #f5f5f5">

        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-7">

                <!-- Traffic sources -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">접속 소스</h6>
                        <div class="header-elements">
                            <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                                <label class="form-check-label">
                                    Live update:
                                    <input type="checkbox" class="form-input-switchery" checked data-fouc>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#"
                                       class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <div>
                                        <div class="font-weight-semibold">New visitors</div>
                                        <span class="text-muted">2,349 avg</span>
                                    </div>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="new-visitors"></div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#"
                                       class="btn bg-transparent border-warning-400 text-warning-400 rounded-round border-2 btn-icon mr-3">
                                        <i class="icon-watch2"></i>
                                    </a>
                                    <div>
                                        <div class="font-weight-semibold">New sessions</div>
                                        <span class="text-muted">08:20 avg</span>
                                    </div>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="new-sessions"></div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#"
                                       class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon mr-3">
                                        <i class="icon-people"></i>
                                    </a>
                                    <div>
                                        <div class="font-weight-semibold">Total online</div>
                                        <span class="text-muted"><span class="badge badge-mark border-success mr-2"></span>
                                        5,378 avg</span>
                                    </div>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="total-online"></div>
                            </div>
                        </div>
                    </div>

                    <div class="chart position-relative" id="traffic-sources"></div>
                </div>
                <!-- /traffic sources -->

            </div>

            <div class="col-xl-5">

                <!-- Sales stats -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">접속 통계</h6>
                        <div class="header-elements">
                            <select class="form-control custom-select" id="select_date" style="padding:.4375rem 1.3125rem .4375rem .875rem !important;">
                                <option value="val1">June, 29 - July, 5</option>
                                <option value="val2">June, 22 - June 28</option>
                                <option value="val3" selected>June, 15 - June, 21</option>
                                <option value="val4">June, 8 - June, 14</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body py-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">5,689</h5>
                                    <span class="text-muted font-size-sm">new orders</span>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">32,568</h5>
                                    <span class="text-muted font-size-sm">this month</span>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">$23,464</h5>
                                    <span class="text-muted font-size-sm">expected profit</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart mb-2" id="app_sales"></div>
                    <div class="chart" id="monthly-sales-stats"></div>
                </div>
                <!-- /sales stats -->

            </div>
        </div>
        <!-- /main charts -->



        <div class="row">

            <!-- 오른쪽 시작 -->
            <div class="col-xl-8">

                <!-- Marketing campaigns -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">총 회원수</h6>
                        <div class="header-elements"> <span class="badge bg-success badge-pill">28 active</span>
                            <div class="list-icons ml-3">
                                <div class="dropdown"> <a href="#" class="list-icons-item dropdown-toggle"
                                                          data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu"> <a href="#" class="dropdown-item"><i class="icon-sync"></i>
                                            Update data</a> <a href="#" class="dropdown-item"><i
                                                class="icon-list-unordered"></i> Detailed log</a> <a href="#"
                                                                                                     class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-sm-flex flex-column flex-md-row align-items-sm-center justify-content-sm-between flex-sm-wrap">
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div id="campaigns-donut"></div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">38,289 <span
                                        class="text-success font-size-sm font-weight-normal"><i class="icon-arrow-up12"></i>
                                    (+16.2%)</span></h5>
                                <span class="badge badge-mark border-success mr-1"></span> <span class="text-muted">May 12,
                                12:30 am</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div id="campaign-status-pie"></div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">2,458 <span
                                        class="text-danger font-size-sm font-weight-normal"><i
                                            class="icon-arrow-down12"></i> (-4.9%)</span></h5>
                                <span class="badge badge-mark border-danger mr-1"></span> <span class="text-muted">Jun 4,
                                4:00 am</span>
                            </div>
                        </div>
                        <div> <a href="#" class="btn bg-indigo-300"><i class="icon-statistics mr-2"></i> View report</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th>Campaign</th>
                                <th>Client</th>
                                <th>Changes</th>
                                <th>Budget</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="table-active table-border-double">
                                <td colspan="5">Today</td>
                                <td class="text-right"><span class="progress-meter" id="today-progress"
                                                             data-progress="30"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/facebook.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Facebook</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-blue mr-1"></span> 02:00 - 03:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Mintlime</span></td>
                                <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.43%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$5,489</h6>
                                </td>
                                <td><span class="badge bg-blue">Active</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/youtube.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Youtube videos</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-danger mr-1"></span> 13:00 - 14:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">CDsoft</span></td>
                                <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 3.12%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$2,592</h6>
                                </td>
                                <td><span class="badge bg-danger">Closed</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/spotify.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Spotify ads</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-grey-400 mr-1"></span> 10:00 - 11:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Diligence</span></td>
                                <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> - 8.02%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$1,268</h6>
                                </td>
                                <td><span class="badge bg-grey-400">On hold</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/twitter.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Twitter ads</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-grey-400 mr-1"></span> 04:00 - 05:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Deluxe</span></td>
                                <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$7,467</h6>
                                </td>
                                <td><span class="badge bg-grey-400">On hold</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/spotify.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Spotify ads</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-grey-400 mr-1"></span> 10:00 - 11:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Diligence</span></td>
                                <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> - 8.02%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$1,268</h6>
                                </td>
                                <td><span class="badge bg-grey-400">On hold</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/twitter.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Twitter ads</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-grey-400 mr-1"></span> 04:00 - 05:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Deluxe</span></td>
                                <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$7,467</h6>
                                </td>
                                <td><span class="badge bg-grey-400">On hold</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3"> <a href="#"> <img src="../images/twitter.png"
                                                                             class="rounded-circle" width="32" height="32" alt=""> </a> </div>
                                        <div> <a href="#" class="text-default font-weight-semibold">Twitter ads</a>
                                            <div class="text-muted font-size-sm"> <span
                                                    class="badge badge-mark border-grey-400 mr-1"></span> 04:00 - 05:00
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">Deluxe</span></td>
                                <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span>
                                </td>
                                <td>
                                    <h6 class="font-weight-semibold mb-0">$7,467</h6>
                                </td>
                                <td><span class="badge bg-grey-400">On hold</span></td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown"> <a href="#"
                                                                  class="list-icons-item dropdown-toggle caret-0"
                                                                  data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a href="#"
                                                                                               class="dropdown-item"><i class="icon-file-stats"></i> View
                                                    statement</a> <a href="#" class="dropdown-item"><i
                                                        class="icon-file-text2"></i> Edit campaign</a> <a href="#"
                                                                                                          class="dropdown-item"><i class="icon-file-locked"></i> Disable
                                                    campaign</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /marketing campaigns -->

            </div>
            <!--// 오른쪽 끝 -->

            <!--왼쪽 시작 -->
            <div class="col-xl-4">

                <!-- Progress counters -->
                <div class="row">
                    <div class="col-sm-6">

                        <!-- Available hours -->
                        <div class="card text-center">
                            <div class="card-body">

                                <!-- Progress counter -->
                                <div class="svg-center position-relative" id="hours-available-progress"></div>
                                <!-- /progress counter -->


                                <!-- Bars -->
                                <div id="hours-available-bars"></div>
                                <!-- /bars -->

                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="col-sm-6">

                        <!-- Productivity goal -->
                        <div class="card text-center">
                            <div class="card-body">

                                <!-- Progress counter -->
                                <div class="svg-center position-relative" id="goal-progress"></div>
                                <!-- /progress counter -->

                                <!-- Bars -->
                                <div id="goal-bars"></div>
                                <!-- /bars -->

                            </div>
                        </div>
                        <!-- /productivity goal -->

                    </div>
                </div>
                <!-- /progress counters -->

                <!-- Daily sales -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Daily sales stats</h6>
                        <div class="header-elements">
                            <span class="font-weight-bold text-danger-600 ml-2">$4,378</span>
                            <div class="list-icons ml-3">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-cog3"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed
                                            log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart" id="sales-heatmap"></div>
                    </div>

                </div>
                <!-- /daily sales -->
            </div>
            <!--// 왼쪽 끝 -->


        </div>
    </div>

@endsection

