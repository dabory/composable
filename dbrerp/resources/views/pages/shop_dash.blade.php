@extends('layouts.master')

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


    <script type="text/javascript" src="{{ csset('/js/components/FlipClock/compiled/flipclock.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ csset('/js/components/FlipClock/compiled/flipclock.css') }}" />
    <style>
        .content {
            padding: 0;
        }

        .content>.content {
            padding: 0.5rem;
        }
    </style>

    <div class="content dbr_standard1_dash" style="background-color: #f5f5f5;">
        <div class="row">
            <div class="col-xl-8">
                <!-- 색깔 카드 -->
                <div class="summary  row">
                    <!-- 신규주문 -->
                    <div class="col-lg-4">
                        <div class="new_order card bg-teal-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ number_format($listType1Book['Book'][0]['Page'][0]['C1'] ?: 0) }} 원</h3>
                                    <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">신규주문</span> </div>
                                 <div> 배송완료 {{ $listType1Book['Book'][0]['Page'][0]['C2'] }}
                                    <div class="font-size-sm opacity-75">{{ $listType1Book['Book'][0]['Page'][0]['C3'] }} 건</div>
                                </div>
                            </div>
{{--                            <div class="container-fluid">--}}
{{--                                <div id="members-online"></div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <!-- //신규주문 끝 -->
                    <!-- 처리지연 -->
                    <div class="col-lg-4">
                        <div class="card bg-pink-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $listType1Book['Book'][1]['Page'][0]['C1'] }} 건</h3>
                                    <span class="badge bg-pink-800 badge-pill align-self-center ml-auto">처리지연</span>
                                </div>
                                <div> {{ number_format($listType1Book['Book'][1]['Page'][0]['C2'] ?: 0) }} 원
                                    <div class="font-size-sm opacity-75">{{ $listType1Book['Book'][1]['Page'][0]['C3'] }}</div>
                                </div>
                            </div>
{{--                            <div id="server-load"></div>--}}
                        </div>
                    </div>
                    <!--// 처리지연 끝 -->

                    <!-- 취소반품 -->
                    <div class="col-lg-4">
                        <div class="card bg-blue-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ number_format($listType1Book['Book'][1]['Page'][0]['C2'] ?: 0) }} 원</h3>
                                    <span class="badge bg-blue-800 badge-pill align-self-center ml-auto">취소/반품</span>
                                </div>
                                <div> 취소/반품 요청: {{ $listType1Book['Book'][2]['Page'][0]['C2'] }} 건
                                    <div class="font-size-sm opacity-75">교환 요청: {{ $listType1Book['Book'][2]['Page'][0]['C3'] }} 건</div>
                                </div>
                            </div>
{{--                            <div id="today-revenue"></div>--}}
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
                                    신규 주문 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">{{ number_format($listType1Book['Book'][3]['Page'][0]['C1'] ?: 0) }} 건 </span>

                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>입금대기</span>
                                        <span>{{ number_format($listType1Book['Book'][3]['Page'][0]['C2'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][3]['Page'][0]['C7'] }}%">
                                            <span>{{ $listType1Book['Book'][3]['Page'][0]['C7'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>결제완료</span>
                                        <span>{{ number_format($listType1Book['Book'][3]['Page'][0]['C3'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][3]['Page'][0]['C8'] }}%">
                                            <span>{{ $listType1Book['Book'][3]['Page'][0]['C8'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>배송준비</span>
                                        <span>{{ number_format($listType1Book['Book'][3]['Page'][0]['C4'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][3]['Page'][0]['C9'] }}%">
                                            <span>{{ $listType1Book['Book'][3]['Page'][0]['C9'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>배송중</span>
                                        <span>{{ number_format($listType1Book['Book'][3]['Page'][0]['C5'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][3]['Page'][0]['C10'] }}%">
                                            <span>{{ $listType1Book['Book'][3]['Page'][0]['C10'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>배송완료</span>
                                        <span>{{ number_format($listType1Book['Book'][3]['Page'][0]['C6'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][3]['Page'][0]['C11'] }}%">
                                            <span>{{ $listType1Book['Book'][3]['Page'][0]['C11'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//신규주문내역 -->

                    <!-- 처리지연내역 -->
                    <div class="delay col-lg-6">
                        <div class="toast-header mb-1" style="border-radius: .25rem; background-color: #586fab;">

                            <span class="font-weight-semibold mr-auto">데이터 갱신</span>
                            <div id="countdown" class="mr-2"></div>
                            <a class="list-icons-item" data-action="reload"></a>
                            <i class="icon-spinner2 spinner text-muted top-0" style="display: none;"></i>
                        </div>
                        <style>
                            .flip-clock-wrapper .flip-clock-label {
                                display: none; /* "Minutes"와 "Seconds" 글씨 숨기기 */
                            }

                            .flip-clock-wrapper {
                                width: unset !important;
                            }
                            /* 크기 조절 */
                            .flip-clock-wrapper {
                                zoom: 0.4; /* 전체 크기를 50%로 줄임 */
                            }

                            /* 숫자 크기를 조정하려면 아래 코드로 개별 설정 가능 */
                            .flip-clock-wrapper ul li a div div.inn {
                                font-size: 40px; /* 숫자 크기를 줄입니다 (필요에 따라 조정) */
                            }
                        </style>
                        <script>
                            var countdown = $('#countdown').FlipClock(10, { // 600초 = 10분
                                clockFace: 'MinuteCounter',      // 분과 초로 표시
                                countdown: true,                 // 카운트다운 활성화
                                autoStart: true,                 // 자동 시작 설정
                                callbacks: {
                                    stop: function() {
                                        $('.list-icons-item').trigger('click')
                                    }
                                }
                            });
                        </script>
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">
                                    처리 지연
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">{{ number_format($listType1Book['Book'][4]['Page'][0]['C1'] ?: 0) }} 건</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>발송지연</span>
                                        <span>{{ number_format($listType1Book['Book'][4]['Page'][0]['C2'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][4]['Page'][0]['C5'] }}%">
                                            <span>{{ $listType1Book['Book'][4]['Page'][0]['C5'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>반품지연</span>
                                        <span>{{ number_format($listType1Book['Book'][4]['Page'][0]['C3'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][4]['Page'][0]['C6'] }}%">
                                            <span>{{ $listType1Book['Book'][4]['Page'][0]['C6'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>교환지연</span>
                                        <span>{{ number_format($listType1Book['Book'][4]['Page'][0]['C4'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][4]['Page'][0]['C7'] }}%">
                                            <span>{{ $listType1Book['Book'][4]['Page'][0]['C7'] }}%</span>
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
                                    취소/반품/교환
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">{{ number_format($listType1Book['Book'][5]['Page'][0]['C1'] ?: 0) }} 건 </span>
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
                                        <span>고객취소요청</span>
                                        <span>{{ number_format($listType1Book['Book'][5]['Page'][0]['C2'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][5]['Page'][0]['C5'] }}%">
                                            <span>{{ $listType1Book['Book'][5]['Page'][0]['C5'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>반품요청</span>
                                        <span>{{ number_format($listType1Book['Book'][5]['Page'][0]['C3'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][5]['Page'][0]['C6'] }}%">
                                            <span>{{ $listType1Book['Book'][5]['Page'][0]['C6'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>교환요청</span>
                                        <span>{{ number_format($listType1Book['Book'][5]['Page'][0]['C4'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][5]['Page'][0]['C7'] }}%">
                                            <span>{{ $listType1Book['Book'][5]['Page'][0]['C7'] }}%</span>
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
                                            <form>
                                                <input type="hidden" name="notice_filter" value="{{ request('notice_filter') }}">
                                                <input type="hidden" name="review_filter" value="{{ request('review_filter') }}">
                                                상품 문의 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                                <select class="form-control custom-select" name="inquiry_filter" id="select_date" onchange="$(this).closest('form').submit()">
                                                    <option value="">전체</option>
                                                    <option value="0" {{ request('inquiry_filter') == '0' ? 'selected' : '' }}>답변대기</option>
                                                    <option value="1" {{ request('inquiry_filter') == '1' ? 'selected' : '' }}>답변완료</option>
                                                </select>
                                            </form>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listType1Book['Book'][6]['Page'] ?? [] as $post)
                                    <tr>
                                        <td class="sort text-blue font-weight-semibold">{{ DataConverter::execute($post['C3'], "status('post-item-inquiry')") }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div><a href="#" class="font-weight-semibold">{{ $post['C1'] }}</a></div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted font-size-sm">{{ DataConverter::createFromTimestamp($post['C2'], 'm/d') }}</span></td>
                                    </tr>
                                    @endforeach
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
                                    상품 관리 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </h6>
                                <div class="header-elements"> <span class="font-weight-bold text-danger-600 ml-2">{{ number_format($listType1Book['Book'][7]['Page'][0]['C1'] ?: 0) }} 건</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="progress_tit">
                                        <span>판매중 상품</span>
                                        <span>{{ number_format($listType1Book['Book'][7]['Page'][0]['C2'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][7]['Page'][0]['C5'] }}%">
                                            <span>{{ $listType1Book['Book'][7]['Page'][0]['C5'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>품절 상품</span>
                                        <span>{{ number_format($listType1Book['Book'][7]['Page'][0]['C3'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][7]['Page'][0]['C6'] }}%">
                                            <span>{{ $listType1Book['Book'][7]['Page'][0]['C6'] }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress_tit">
                                        <span>판매 중지 상품</span>
                                        <span>{{ number_format($listType1Book['Book'][7]['Page'][0]['C4'] ?: 0) }} 건</span>
                                    </div>
                                    <div class="progress rounded-round">
                                        <div class="progress-bar" style="width: {{ $listType1Book['Book'][7]['Page'][0]['C7'] }}%">
                                            <span>{{ $listType1Book['Book'][7]['Page'][0]['C7'] }}%</span>
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
                                    <form>
                                        <input type="hidden" name="review_filter" value="{{ request('review_filter') }}">
                                        <input type="hidden" name="inquiry_filter" value="{{ request('inquiry_filter') }}">
                                        공지사항 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                        <select class="form-control custom-select" name="notice_filter" id="select_date" onchange="$(this).closest('form').submit()">
                                            <option value="">전체</option>
                                            <option value="0" {{ request('notice_filter') == '0' ? 'selected' : '' }}>임시저장</option>
                                            <option value="1" {{ request('notice_filter') == '1' ? 'selected' : '' }}>반복노출</option>
                                            <option value="2" {{ request('notice_filter') == '2' ? 'selected' : '' }}>노출누락</option>
                                        </select>
                                    </form>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listType1Book['Book'][8]['Page'] ?? [] as $post)
                                <tr>
                                    <td class="sort text-blue font-weight-semibold">{{ DataConverter::execute($post['C3'], "status('post-notice')") }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="badge badge-danger mr-1">{{ $post['C4'] === '1' ? '상단고정' : '' }}</div>
                                            <div><a href="#" class="font-weight-semibold">{{ $post['C1'] }}</a></div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted font-size-sm">{{ DataConverter::createFromTimestamp($post['C2'], 'm/d') }}</span></td>
                                </tr>
                            @endforeach
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
                                    <form>
                                        <input type="hidden" name="notice_filter" value="{{ request('notice_filter') }}">
                                        <input type="hidden" name="inquiry_filter" value="{{ request('inquiry_filter') }}">
                                        리뷰 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                        <select class="form-control custom-select" name="review_filter" id="select_date" onchange="$(this).closest('form').submit()">
                                            <option value="">전체</option>
                                            <option value="down" {{ request('review_filter') == 'down' ? 'selected' : '' }}>평점 낮은</option>
                                            <option value="up" {{ request('review_filter') == 'up' ? 'selected' : '' }}>평점 높은</option>
                                        </select>
                                    </form>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($listType1Book['Book'][9]['Page']))
                                @foreach($listType1Book['Book'][9]['Page'] as $post)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
    {{--                                        <div class="badge badge-danger mr-1">평점낮은</div>--}}
                                            <div class="badge {{ $post['C2'] >= 4 ? 'bg-success' : 'badge-danger' }}  mr-1">평점: {{ $post['C2'] }}</div>
                                            <div><a href="#" class="font-weight-semibold">{{ $post['C1'] }}</a></div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted font-size-sm">{{ $post['C3'] }}</span></td>
                                    <td><span class="text-muted font-size-sm">{{ DataConverter::createFromTimestamp($post['C4'], 'm/d') }}</span></td>
                                </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--//리뷰 끝 -->

                <!-- 판매통계 -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">
                            매출 통계 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                        </h6>
{{--                        <div class="header-elements">--}}
{{--                            <select class="form-control custom-select" id="select_date">--}}
{{--                                <option value="val1">매출 금액</option>--}}
{{--                                <option value="val2">매출 건수</option>--}}
{{--                                <option value="val4">고객 수</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-body py-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">{{ number_format($listType1Book['Book'][10]['Page'][0]['C1'] ?: 0) }}</h5>
                                    <span class="text-muted font-size-sm">매출 금액 합계</span> </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">{{ number_format($listType1Book['Book'][10]['Page'][0]['C2'] ?: 0) }}</h5>
                                    <span class="text-muted font-size-sm">매출 건수 합계</span> </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">{{ number_format($listType1Book['Book'][10]['Page'][0]['C3'] ?: 0) }}</h5>
                                    <span class="text-muted font-size-sm">고객 수 합계</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart mb-2" id="app_sales"></div>
                    <!-- <div class="chart" id="monthly-sales-stats"></div> -->
                </div>
                <!--// 판매통계 끝 -->

                <!-- 정산내역 -->
                <div class="calculate card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">
                            정산 내역 <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                        </h6>
                        <div class="header-elements"><span>정산 주기</span> <span class="badge bg-success align-self-start ml-3">매주 수요일</span> </div>
                    </div>

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
                    <div class="tab-content card-body">
                        <div class="tab-pane active fade show" id="messages-tue">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-blue-800 align-self-start">표준 매출가 금액</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-blue-800 align-self-start">표준 매출가 합계</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-blue-800 align-self-start">수수료 합계</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-blue-800 align-self-start">파트너 분담액과 할인 등</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-blue-800 align-self-start">기타 수료와 클레임</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge badge-danger align-self-start">다음 정산 합계</span>
                                            <span class="d-flex justify-content-between">
                                        <h6 class="card-title">12,234,000 원</h6>
                                        </span>
                                        </div>
                                </li>
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
                            </ul>
                        </div>
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

<script>
    var formatted = @json($salesStatisticsGraph);
</script>
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
