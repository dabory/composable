@php
    $currentBpa = App\Helpers\Utils::bpaDecoding(request('bpa'));
    $menuPage = App\Helpers\Utils::getMainMenu()['Page'] ?? [];
    $bpa = App\Helpers\Utils::bpaEncoding($menuPage)->pluck('bpa')->toArray();
    $menuPage = collect($menuPage)->map(function ($menu, $index) use ($bpa) {
        return array_merge($menu, ['bpa' => $bpa[$index]]);
    });
@endphp

<div class="sidebar sidebar-dark sidebar-right sidebar-expand-xl sidebar-collapsed overflow-auto">
    <!-- Sidebar content -->
    <div class="sidebar-section sidebar-user my-0 d-flex align-items-center justify-content-center p-1">
        <button class="btn btn-danger w-100 mr-1" onclick="show_manual_modal()">{{ $form['FormVars']['Title']['SelfManual'] }}</button>
        <button class="btn btn-primary w-100 mr-1" onclick="shortcut_in_or_out(1)">{{ $form['FormVars']['Title']['ShortcutIn'] }}</button>
        <button class="btn btn-primary w-100" onclick="shortcut_in_or_out(0)">{{ $form['FormVars']['Title']['ShortcutOut'] }}</button>
        <button type="button" class="tab-close position-absolute top-0 right-0 color-danger" onclick="close_right_sidebar()">
            <i class="fas fa-times fa-xs"></i>
        </button>
        {{-- <button class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> {{ $form['FormVars']['Title']['ShortcutIn'] }}</button>
        <button class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> {{ $form['FormVars']['Title']['ShortcutOut'] }}</button> --}}
    </div>
    <ul class="sidebar-section nav-right-sidebar nav nav-sidebar">
    </ul>
    <!-- /sidebar content -->
</div>

<script>
    $(document).ready(async function() {
        nav_right_sidebar_init();
    });

    function show_manual_modal() {
        const para_name = currentBpa['para_name'];
        get_para_data('manual', `/etc/self-manual${para_name}`, function (parameter) {
            // console.log(parameter)
            get_blades_html('front.outline.static.manual', parameter, function (html) {
                if (! $('#element_in_which_to_insert').find('#modal-manual').length) {
                    $('#element_in_which_to_insert').append(html);
                }
                $('#modal-manual').find('#myModalLabel').text(`${currentBpa['menu_name']} 매뉴얼`)
                $('#modal-manual').modal('show')
            }, 'manual');

        })
    }

    function close_right_sidebar() {
        $('.sidebar-right').addClass('sidebar-collapsed')
        $('.sidebar-right').removeClass('sidebar-mobile-expanded')
    }

    function nav_right_sidebar_init() {
        let html = '';
        myMenu = menuPage.filter(menu => menu.IsMymenu == '1')
        myMenu.forEach(menu => {
            html +=
                `<li class="nav-item list-unstyled ml-0 text-left">
                    <a href="${menu.PageUri}?bpa=${menu.bpa}" target="${menu.IsNewtab == 1 ? '_blank' : '_self'}"
                    class="nav-link d-block ${menu.MenuCode == menuCode ? 'active text-orange' : 'text-orange'}"><i class="${menu.Icon} mr-2" style="width: 10px;"></i>
                        ${menu.MenuName}
                    </a>
                </li>`;
        });
        $('.nav-right-sidebar').html(html);
    }

    async function shortcut_in_or_out(is_mymenu) {
        let user_menu_id = menuPage.filter(menu => menu.MenuCode == menuCode)[0]['UserMenuId']
        let response = await get_api_data('is-mymenu-set', {
            UserMenuId: user_menu_id,
            IsMymenu: String(is_mymenu),
        })
        if (response.status == 200) {
            menuPage.map(menu => {
                if (menu.MenuCode == menuCode) {
                    menu.IsMymenu = is_mymenu;
                }
                return menu;
            })
            nav_right_sidebar_init();
            $.ajax({
                url: "/clear-menu-cache",
                type:'POST',
                data: {
                    _token:"{{ csrf_token() }}",
                },
                cache: false,
                success: function(response) {
                }
            });
        }
    }

    const menuPage = {!! json_encode($menuPage) !!};
    const currentBpa = {!! json_encode($currentBpa) !!};
</script>
