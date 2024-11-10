<ul class="nav nav-sidebar sidebar-collapsed" data-nav-type="accordion">
    @foreach($menuList ?? [] as $menu)
        <li class="nav-item {{ empty($menu['child']) ? '' : 'nav-item-submenu' }}">
            <a href="{{ $menu['PageUri'] ? $menu['PageUri'].'?bpa='.$menu['bpa']: '#' }}" target="{{ $menu['IsNewtab'] ? '_blank' : '_self' }}"
               class="nav-link {{ $menu['MenuCode'] == $menuCode ? 'active' : '' }} d-flex align-items-center">
                <i class="{{ $menu['Icon'] }}"></i> <span>{{ $menu['MenuName'] }}</span>
            </a>
            @if(isset($menu['child']) && count($menu['child']) > 0)
                <ul class="nav nav-group-sub" data-submenu-title="Menu levels" style="display: none;">
                    @foreach($menu['child'] as $secondMenu)
                        <li class="nav-item {{ empty($secondMenu['child']) ? '' : 'nav-item-submenu' }}">
                            <a href="{{ $secondMenu['PageUri'] }}?bpa={{ $secondMenu['bpa'] }}" target="{{ $secondMenu['IsNewtab'] ? '_blank' : '_self' }}"
                               class="nav-link {{ $secondMenu['MenuCode'] == $menuCode ? 'active' : '' }} d-flex align-items-center">
                                <i class="{{ $secondMenu['Icon'] }}"></i> {{ $secondMenu['MenuName'] }}</a>
                            @if(!empty($secondMenu['child']))
                                <ul class="nav nav-group-sub">
                                    @foreach($secondMenu['child'] as $thirdMenu)
                                        <li class="nav-item">
                                            <a href="{{ $thirdMenu['PageUri'] }}?bpa={{ $thirdMenu['bpa'] }}" target="{{ $thirdMenu['IsNewtab'] ? '_blank' : '_self' }}"
                                               class="nav-link {{ $thirdMenu['MenuCode'] == $menuCode ? 'active' : '' }} d-flex align-items-center">
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

@once
@push('js')
<script>
    $(document).ready(function() {
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
</script>
@endpush
@endonce
