<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <title>@yield('title', env('APP_NAME'))</title>
    <meta property="og:image" content="https://newerp.daboryhost.com/public/images/ogm_img.jpg" />

    <link rel="icon" href="{{ msset(env('FAVICON_PATH')) }}">

    @include('partial.site.meta')
    <link href="{{ csset('/css/common.css', '220901') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/css/custom.css') }}" rel="stylesheet" type="text/css">
    @include('partial.site.scripts')

    @yield('css')
    @stack('css')
</head>

<body>
<!-- Main navbar -->
@empty (request('popup'))
    @include('layouts.navbar')
@endempty
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content">

@empty($isDbupdate)
    <!-- Main sidebar -->
    @include('layouts.left-sidebar')
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

            <div class="p-5 flex-column text-center position-absolute top-50 left-50 justify-content-center align-items-center"
                 id="spinner-processing"
                 style="z-index: 9999; display: none;">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Processing...</span>
                </div>
                <div class="small pt-2 text-success">Processing…</div>
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
        @include('layouts.footer')
        <!-- /footer -->


        </div>
    </div>
    <!-- /main content -->


@empty($isDbupdate)
    <!-- Right sidebar -->
    @include('layouts.right-sidebar')
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
    window.User = @json(session('user'));
    window.CodeTitle = @json($codeTitle ?? '');

    window.MainAppName = @json($mainAppName ?? null);
    window.GuestAppName = @json($guestAppName ?? null);
</script>

@yield('js')
@stack('js')

</body>
</html>
