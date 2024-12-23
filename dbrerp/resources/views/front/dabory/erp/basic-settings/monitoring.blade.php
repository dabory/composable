@extends('layouts.master')
@section('title', $formA['General']['Title'])

@section('content')
    <div class="col-xl-12 px-0">
        <div class="mb-1 pt-0 text-right">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary btn-top-act" data-value="save" {{ $formA['FormVars']['Hidden']['RenewButton'] }}>{{ $formA['FormVars']['Title']['RenewButton'] }}</button>
                @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                    'eventClassName' => 'btn-top-act',
                ])
            </div>
        </div>
{{--        <div class="mb-1 pt-0 text-center">--}}
{{--            <select class="rounded w-100" id="grafana-src-select" onchange="chagne_iframe_src(this)">--}}
{{--                <option value="http://175.126.146.153:3000/d/jRDq7MJ7z/cpu">CPU</option>--}}
{{--                <option value="http://175.126.146.153:3000/d/SS56J41nk/mem">MEM</option>--}}
{{--                <option value="http://175.126.146.153:3000/d/WsJtbV1nk/traffic">Traffic</option>--}}
{{--            </select>--}}
{{--        </div>--}}
    </div>
    <div class="content position-relative" style="height: 100vh;">
        <body style="margin:0px;padding:0px;">
            <iframe src="{{ $formA['SelectButtonOptions'][0]['Value'] }}" id="grafana-iframe" frameborder="0" style="height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px;" height="100%" width="100%"></iframe>
        </body>
    </div>

@endsection

@section('js')
    <script>
        window.onload = function () {
            $('.btn-top-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'save': type1_new(); break;
                    default: chagne_iframe_src($(this).data('value')); break;
                }
            });
        }

        function chagne_iframe_src(src) {
            $('#grafana-iframe').attr('src', src)
        }
    </script>
@endsection
