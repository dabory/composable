<!-- card-header 시작 -->
<div class="card-header header-element-inline">


    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="navbar-nav align-items-center d-flex flex-md-row">
            <li class="nav-item control_left">
                <a href="#" id="sidebar-main"
                   class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
            <li>
                <button type="button" class="btn btn-outline-primary w-100"
                        onclick="clear_cache()">캐시삭제
                </button>
            </li>
{{--            <li class="nav-item dropdown dropdown-user w-100">--}}
{{--                <select class="select w-100 select2-hidden-accessible"--}}
{{--                        onchange="window.location.href='/my-app/country-code?code='+this.value" tabindex="-1" aria-hidden="true">--}}
{{--                    @foreach(config('constants.countries') ?? [] as $country)--}}
{{--                        <option {{ session('member.CountryCode') == $country ? 'selected' : '' }}--}}
{{--                                value="{{ $country }}">--}}
{{--                            {{ config('languages')[strtolower(explode('_', $country)[0])]['isoName'] }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </li>--}}
        </ul>
    </div>


    <div class="d-none d-md-flex control_right">
        <ul>
            <li class="nav-item">
                <button type="button" class="btn toggle-full-screen">
                    <i class="fas fa-expand-arrows-alt"></i>
                </button>
            </li>
            <li>
                <button type="button" class="btn sidebar-control sidebar-right-toggle"><i
                        class="fas fa-th-large"></i></button>
            </li>
        </ul>
    </div>
</div>
<!--// card-header 끝 -->

@once
    @push('js')
        <script>
            function clear_cache() {
                confirm_message_shw_and_delete(function() {
                    window.location.href = '{{ route('my-app.clear.cache') }}';
                })
            }
        </script>
    @endpush
@endonce
