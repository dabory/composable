<!doctype html>
<html lang="ko">
<head>
    <script src="{{ csset('/js/components/screen-size.js') }}"></script>
    <?php
    // used for RESS
    // if ( !Cookie::has('resolution') ) // doesn't work
    if ( !isset( $_COOKIE['screenWidth'] ) || !isset( $_COOKIE['screenHeight']) )
    {
    ?>
    <script>get_screen_size()</script>
    <?php
    }
    ?>

    <script src="{{ csset('/js/plugins/vue/vue@2.6.11.js') }}"></script>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env('APP_NAME'))</title>
    @php $basePath = '/themes/'  .env('DBR_THEME') . '/pro/resources'; @endphp
    <link rel="icon" href="{{ csset($basePath . '/assets/brand-images/pavicon.jpg') }}">

    @php $basePath = '/themes/pro/' . env('DBR_THEME') . '/resources'; @endphp

    @include('front.dabory.pro.shop-1.partial.site.meta', [ 'basePath' => $basePath ])
    @include('front.dabory.pro.shop-1.partial.site.scripts', [ 'basePath' => $basePath ])

    @stack('css')

</head>
<body>

@include('layouts.js-lang')
@include('vendor.lara-izitoast.toast')

@include('views.layouts.header')

@yield('content')

@include('views.layouts.footer')

@stack('js')

</body>

<script>
    window.env = (@json($_ENV));
    window.Member = @json(session('member'));
    window.CodeTitle = @json($codeTitle ?? '');
</script>
</html>
