@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')


<div class="content basic-settings">
    <div class="row">
        <div class="col-xl-12">
            @include('front.dabory.erp.basic-settings.deal-type-form', [
                'formA' => $formA
            ])
        </div>
    </div>
</div>

{{-- <a href="/download/excel"><button>Download Table as Excel File</button></a> --}}
<button onclick="download_report()">Download Table as Excel File</button>
{{-- @include('charts.c3') --}}
@include('charts.pie')

@endsection

<script>
    function download_report() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/download/report",
            type:'POST',
            success: function(url) {
                console.log(url)
                window.location.href = url;
            }
        });
    }
</script>
