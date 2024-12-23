{{-- Todo: member-left-sidebar 새탭에 메뉴열기 수정하기 --}}
<!-- User menu -->
<div class="sidebar-section sidebar-user my-1" id="left-sidebar-head-box">
    <div class="sidebar-section-body">
        <div class="media profile" >
            <a href="#" class="mr-3 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('/images/placeholders/placeholder.jpg') }}" class="rounded-circle" alt="">
            </a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">사용권한</a>
				<a class="dropdown-item" href="#">지사구분</a>
				<a class="dropdown-item" href="#">창고구분</a>
				<a class="dropdown-item" href="#">영업구분</a>
				<a class="dropdown-item" href="#">지사구분</a>
				<a class="dropdown-item" href="#">창고구분</a>
				<a class="dropdown-item" href="#">회계구분</a>
				<a class="dropdown-item" href="#">국가코드</a>
			 </div>
            <div class="media-body">
                <div class="font-weight-semibold">{{ Str::limit(session('user.NickName') ?? '', 10, '') }}</div>
                <div class="font-size-sm line-height-sm opacity-50">
                    {{ session('user.Email') ?? '' }}
                </div>
            </div>
            <div class="ml-3 align-self-center">
                <button type="button"
                        class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm d-none d-xl-inline-block">
                    <i class="icon-cog3"></i>
                </button>

                <button type="button"
                        class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm d-xl-none">
                    <i class="icon-cog3"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="ml-3">
        <input type="checkbox" value="1" class="text-center" id="open-left-menu-new-tab-check"> <label class="mb-0" for="open-left-menu-new-tab-check">{{ $form['FormVars']['Title']['OpenMenuNewTab'] }}</label>
    </div>
</div>
<!-- /user menu -->

<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion" id="left-sidebar">
        @foreach($menuList ?? [] as $menu)
            <li class="nav-item {{ empty($menu['child']) ? '' : 'nav-item-submenu' }}">
                <a href="{{ $menu['PageUri'] ? $menu['PageUri'].'?bpa='.$menu['bpa']: '#' }}" target="{{ $menu['IsNewtab'] ? '_blank' : '_self' }}"
                   class="nav-link {{ $menu['MenuCode'] == $menuCode ? 'active' : '' }}">
                    <i class="{{ $menu['Icon'] }}"></i> <span>{{ $menu['MenuName'] }}</span>
                </a>
                @if(isset($menu['child']) && count($menu['child']) > 0)
                    <ul class="nav nav-group-sub" data-submenu-title="Menu levels" style="display: none;">
                        @foreach($menu['child'] as $secondMenu)
                            <li class="nav-item {{ empty($secondMenu['child']) ? '' : 'nav-item-submenu' }}">
                                <a href="{{ $secondMenu['PageUri'] }}?bpa={{ $secondMenu['bpa'] }}" target="{{ $secondMenu['IsNewtab'] ? '_blank' : '_self' }}"
                                    class="nav-link {{ $secondMenu['MenuCode'] == $menuCode ? 'active' : '' }}">
                                    <i class="{{ $secondMenu['Icon'] }}"></i> {{ $secondMenu['MenuName'] }}</a>
                                @if(!empty($secondMenu['child']))
                                    <ul class="nav nav-group-sub">
                                        @foreach($secondMenu['child'] as $thirdMenu)
                                            <li class="nav-item">
                                                <a href="{{ $thirdMenu['PageUri'] }}?bpa={{ $thirdMenu['bpa'] }}" target="{{ $thirdMenu['IsNewtab'] ? '_blank' : '_self' }}"
                                                    class="nav-link {{ $thirdMenu['MenuCode'] == $menuCode ? 'active' : '' }}">
                                                    <i class="{{ $thirdMenu['Icon'] }}"></i> {{ $thirdMenu['MenuName'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>

@once
@push('js')
<script>
    $(document).ready(function() {
        // 왼쪽 메뉴클릭 이벤트
        $('#left-sidebar a').on('click', function (e) {
            if ($(this).attr('href') && ! $(this).closest('li').hasClass('nav-item-submenu')
                && $('#left-sidebar-head-box').find('#open-left-menu-new-tab-check').prop('checked')) {
                e.preventDefault();
                window.open($(this).attr('href'), '_blank');
            }
        });

        if ({!! json_encode($disableLMenu) !!} == 1) {
            $('.sidebar-main').addClass('sidebar-collapsed')
        }
        if ({!! json_encode($enableRMenu) !!} == 1) {
            $('.sidebar-right').removeClass('sidebar-collapsed')
        }

        $('a.active').closest('ul').closest('.nav-item-submenu').closest('ul').closest('.nav-item-submenu').addClass('nav-item-open');
        $('a.active').closest('ul').closest('.nav-item-submenu').addClass('nav-item-open');
        $('a.active').closest('.nav-item-submenu').addClass('nav-item-open');
        $('a.active').closest('.nav-group-sub').show();
        $('a.active').closest('ul').closest('.nav-item-submenu').closest('.nav-group-sub').show();
    });


    const menuCode = {!! json_encode($menuCode) !!};
    const menuList = {!! json_encode($menuList) !!};
    const menuPages = {!! json_encode($menuPages) !!};
</script>
@endpush
@endonce
