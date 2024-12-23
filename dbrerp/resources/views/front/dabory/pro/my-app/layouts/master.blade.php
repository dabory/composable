<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', env('APP_NAME'))</title>
    @php $basePath = '/themes/'  .env('DBR_THEME') . '/pro/resources'; @endphp
    <link rel="icon" href="{{ csset($basePath . '/assets/brand-images/pavicon.jpg') }}">

    @stack('css')

{{--    @php--}}
{{--        $baseProPath = '/themes/pro/'. env('DBR_THEME');--}}
{{--        $basePath = $baseProPath . '/resources/my-app-css';--}}
{{--    @endphp--}}

    <link href="{{ csset('/my-app-css/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/my-app-css/common.css') }}" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="{{ csset('/js/plugins/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ csset('/js/plugins/codemirror/theme/mdn-like.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ csset('/js/plugins/codemirror/addon/hint/show-hint.css') }}">

    <link href="{{ csset('/css/iziToast.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">--}}
    <!-- laravel webpack -->
    <link href="{{ csset('/css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- laravel webpack -->

    <link href="{{ csset('/css/external/froala_editor.pkgd.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ csset('/css/external/boxicons.min.css') }}" rel="stylesheet" type="text/css">
    {{--    <link href='https://cdn.jsdelivr.net/npm/froala-editor@3.2.7/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />--}}
{{--    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>--}}

    <!-- Core JS files -->
    <script src="{{ csset('/js/main/jquery.min.js') }}"></script>
    <script src="{{ csset('/js/external/jquery-ui.js') }}"></script>
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    <script src="{{ csset('/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ csset('/js/core.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('theme-js')

    <script src="{{ csset('/js/plugins/shortcuts/shortcut.js') }}"></script>
    <script src="{{ csset('/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ csset('/js/plugins/notifications/sweet_alert.min.js') }}"></script>

    <script src="{{ csset('/js/plugins/ui/moment/moment.min.js') }}"></script>

    <script src="{{ csset('/js/external/froala_editor.pkgd.min.js') }}"></script>
{{--    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.2.7/js/froala_editor.pkgd.min.js'></script>--}}
    <!-- /theme JS files -->

    <!-- Custom -->
    <script src="{{ csset('/js/app.js') }}"></script>
    <script src="{{ csset('/js/common.js') }}"></script>
    <script src="{{ csset('/js/api/core.js') }}"></script>

    <script src="{{ csset('/js/utils/lib.js') }}"></script>
    <script src="{{ csset('/js/utils/date.js') }}"></script>
    <script src="{{ csset('/js/utils/make-dom.js') }}"></script>
    <script src="{{ csset('/js/utils/string.js') }}"></script>
    <script src="{{ csset('/js/utils/check-dom.js') }}"></script>

    <!-- /Custom -->

    <!-- external JS files -->
    <script src="{{ csset('/js/external/numeral.min.js') }}"></script>
    <script src="{{ csset('/js/external/underscore-umd-min.js') }}"></script>
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-umd-min.js"></script>--}}
    <script src="{{ csset('/js/iziToast.js') }}"></script>
    <!-- /external JS files -->

    <!-- Axios -->
    <script src="{{ csset('/js/axios.min.js') }}"></script>
    <!-- /axios -->


</head>
<body>
    <div class="sub_wrap app_manage my-app">
        @include('layouts.js-lang')
        @include('vendor.lara-izitoast.toast')
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- content 시작 -->
        <div class="myapp_wrapper full_width">
            <div class="content container">

            @include('front.dabory.pro.my-app.layouts.left-sidebar')

            <!-- right_wrap 시작 -->
                <div class="right_warp">
                    <div class="card right mb-0">

                    @include('front.dabory.pro.my-app.layouts.navbar')

                    <!-- card-body 시작 -->
                    @yield('content')
                        <!--// card-body 끝 -->
                    </div>
                    <!--// right 끝 -->
                    @include('front.dabory.pro.my-app.layouts.right-sidebar')
                </div>
                <!--// right_wrap 끝 -->
            </div>
        </div>
        <!--// content 끝 -->

        <div id="element_in_which_to_insert">
            @yield('modal')
            @stack('modal')
        </div>
        <script src="{{ csset('/js/modals-controller/modal.js') }}"></script> <!-- moadl All -->
    </div>

    <script src="{{ csset('/js/setup.js') }}"></script>

    <script>
        window.env = (@json($_ENV));
        window.Member = @json(session('member'));
        window.CodeTitle = @json($codeTitle ?? '');

        window.MainAppName = @json($mainAppName ?? null);
        window.GuestAppName = @json($guestAppName ?? null);
    </script>

    @yield('js')
    @stack('js')
</body>

</html>
