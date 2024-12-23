<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', env('APP_NAME'))</title>
    @php $basePath = '/themes/'  .env('DBR_THEME') . '/pro/resources'; @endphp
    <meta property="og:image" content="https://newerp.daboryhost.com/public/images/ogm_img.jpg" />

    <!--<link rel="icon" href="{{ csset($basePath . '/assets/brand-images/pavicon.jpg') }}">-->
	<link rel="icon" href="{{ config('app.theme_path') }}/pro/resources/assets/brand-images/logo-small.jpg">

    <link href="{{ csset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    @include('partial.site.meta')
    <link href="{{ csset('/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/css/auth/common.css') }}" rel="stylesheet" type="text/css">
    @include('partial.site.scripts')
    @yield('css')
    @stack('css')
</head>

<body>

<!-- Page content -->
<div class="page-content">

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
            <div class="content">
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


    <div id="element_in_which_to_insert">
        @yield('modal')
        @stack('modal')
    </div>
</div>

<!-- /page content -->
<script src="{{ csset('/js/setup.js') }}"></script>

@yield('js')
@stack('js')
</body>
</html>
