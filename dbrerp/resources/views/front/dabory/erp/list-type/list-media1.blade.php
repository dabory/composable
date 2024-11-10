@extends($masterName)
@section('title', $listMedia1['General']['Title'])
@section('content')

@include('front.dabory.erp.list-type.list-media1-form', ['listMedia1' => $listMedia1])

@endsection
