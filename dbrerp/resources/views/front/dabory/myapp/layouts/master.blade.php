<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <title>@yield('title', env('APP_NAME'))</title>
    @php $basePath = '/themes/'  .env('DBR_THEME') . '/pro/resources'; @endphp
    <link rel="icon" href="{{ csset($basePath . '/assets/brand-images/pavicon.jpg') }}">

    @include('front.dabory.myapp.partial.site.meta')
    <link href="{{ csset('/myapp/css/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/myapp/css/custom.css') }}" rel="stylesheet" type="text/css">
    @include('front.dabory.myapp.partial.site.scripts')

    @yield('css')
    @stack('css')
</head>

<body>
<!-- Main navbar -->
@empty (request('popup'))
    @include('front.dabory.myapp.layouts.navbar')
@endempty
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content">

@empty($isDbupdate)
    <!-- Main sidebar -->
    @include('front.dabory.myapp.layouts.left-sidebar')
    <!-- /main sidebar -->
@endempty

<!-- Main content -->
    <div class="content-wrapper">
        @include('layouts.js-lang')
        <div class="content-inner">
            @include('vendor.lara-izitoast.toast')
            <div class="pace-demo text-center position-absolute top-50 left-50 ml-2" hidden style="z-index: 9999" id="pace-progress-panel">
                <div class="theme_squares">
                    <div class="pace-progress"></div>
                    <div class="pace_activity"></div>
                </div>
            </div>
            <!-- Inner content -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <!-- Content area -->
            <div class="content" id="app">
                @yield('content')
            </div>
            <!-- /content area -->

            <!-- /inner content -->

            <!-- Footer -->
        @include('front.dabory.myapp.layouts.footer')
        <!-- /footer -->


        </div>
    </div>
    <!-- /main content -->


@empty($isDbupdate)
    <!-- Right sidebar -->
    @include('front.dabory.myapp.layouts.right-sidebar')
    <!-- /right sidebar -->
    @endempty

    <div id="element_in_which_to_insert">
        @yield('modal')
        @stack('modal')
    </div>
</div>
<!-- 모달 -->
<script src="{{ csset('/js/modals-controller/modal.js') }}"></script> <!-- moadl All -->

<!-- 절대 지우지 마세요 -->
{{--<iframe name="ifrm" style="display: none"></iframe>--}}

<!-- /page content -->
<script src="{{ csset('/js/setup.js') }}"></script>

<script>
    window.env = (@json($_ENV));
    window.User = @json(session('member'));
    window.Member = @json(session('member'));
    window.CodeTitle = @json($codeTitle ?? '');

    window.MainAppName = @json($mainAppName ?? null);
    window.GuestAppName = @json($guestAppName ?? null);
</script>

@yield('js')
@stack('js')

</body>
</html>
