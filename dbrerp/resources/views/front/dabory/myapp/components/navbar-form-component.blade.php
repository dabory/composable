<ul class="navbar-nav align-items-center d-flex flex-column flex-md-row">
    <li class="mx-0 mr-md-2 mb-2 mb-md-0 w-md-auto">
        <a href="/" target="_blank">{{ $form['FormVars']['Title']['Home'] }}</a>
    </li>
{{--    <li class="mx-0 mr-md-2 mb-2 mb-md-0 w-md-auto">--}}
{{--        <button type="button" class="btn btn-outline-primary w-100 w-md-auto" onclick="clear_cache()" style="height:28px; padding: 0 10px;">{{ $form['FormVars']['Title']['ClearCache'] }}</button>--}}
{{--    </li>--}}
    <li class="mx-0 mr-md-2 mb-2 mb-md-0 nav-item dropdown dropdown-user">
        <a href="{{ route('member-logout') }}"><i class="icon-switch2"></i>&nbsp;{{ $form['FormVars']['Title']['Logout'] }}</a>
    </li>
</ul>

@once
@push('js')
<script>
    function clear_cache() {
        confirm_message_shw_and_delete(function() {
            window.location.href = '{{ route('myapp.clear.cache') }}';
        })
    }
</script>
@endpush
@endonce
