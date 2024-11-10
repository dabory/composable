@extends($masterName)
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                @include('front.dabory.erp.form-post.post-tabbed-standard')
            </div>
        </div>
    </div>
@endsection
