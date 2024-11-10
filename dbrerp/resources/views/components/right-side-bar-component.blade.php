{{-- Todo: member-right-sidebar 새탭에 메뉴열기 수정하기 --}}
<!-- Sidebar content -->
<div class="sidebar-section sidebar-user my-0 d-flex align-items-center justify-content-center p-1" id="right-side-bar">
    <button class="btn btn-danger w-100 mr-1" id="manual-btn" onclick="show_manual_modal(this)">{{ $form['FormVars']['Title']['SelfManual'] }}</button>
    <button class="btn btn-primary w-100 mr-1" onclick="shortcut_in_or_out(1)">{{ $form['FormVars']['Title']['ShortcutIn'] }}</button>
    <button class="btn btn-primary w-100" onclick="shortcut_in_or_out(0)">{{ $form['FormVars']['Title']['ShortcutOut'] }}</button>
    <button type="button" class="tab-close position-absolute top-0 right-0 color-danger" onclick="close_right_sidebar()">
        <i class="fas fa-times fa-xs"></i>
    </button>
    {{-- <button class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> {{ $form['FormVars']['Title']['ShortcutIn'] }}</button>
    <button class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> {{ $form['FormVars']['Title']['ShortcutOut'] }}</button> --}}
</div>
<div class="ml-3 my-1">
    <input type="checkbox" value="1" class="text-center" id="open-right-menu-new-tab-check"> <label class="mb-0" for="open-right-menu-new-tab-check">{{ $form['FormVars']['Title']['OpenMenuNewTab'] }}</label>
</div>
<ul class="sidebar-section nav-right-sidebar nav nav-sidebar">
</ul>
<!-- /sidebar content -->

@once
@push('js')
<script>
    $(document).ready(async function() {
        nav_right_sidebar_init();

        // 오른쪽 메뉴클릭 이벤트
        $('.nav-right-sidebar a').on('click', function (e) {
            if ($(this).attr('href') && ! $(this).closest('li').hasClass('nav-item-submenu')
                && $('#right-sidebar-head-box').find('#open-right-menu-new-tab-check').prop('checked')) {
                e.preventDefault();
                window.open($(this).attr('href'), '_blank');
            }
        });

        $(document).on('hide.bs.modal','#modal-manual', function () {
            $('#right-side-bar').find('#manual-btn').prop('disabled', false);
        });
    });

    async function show_manual_modal($this) {
        $($this).prop('disabled', true)
        const para_name = currentBpa['para_name'];
        const para_path = `/etc/self-manual${para_name}`;
        const response = await get_para_data('manual', para_path, getParameterByName('bpa'))

        if (! isEmpty(response.data.apiStatus)) {
            $($this).prop('disabled', false)
            return iziToast.error({ title: 'Error', message: response.data.body })
        }

        get_blades_html('front.outline.static.manual', response['data'], function (html) {
            if (! $('#element_in_which_to_insert').find('#modal-manual').length) {
                $('#element_in_which_to_insert').append(html);
            }
            $('#modal-manual').find('#myModalLabel').text(`${currentBpa['menu_name']} 매뉴얼`)
            $('#modal-manual').modal('show')
        }, 'manual');

        // $($this).prop('disabled', false);
    }

    function close_right_sidebar() {
        $('.sidebar-right').addClass('sidebar-collapsed')
        $('.sidebar-right').removeClass('sidebar-mobile-expanded')
    }

    function nav_right_sidebar_init() {
        let html = '';
        const my_menu = menuPage.filter(menu => menu.IsMymenu == '1')
        my_menu.forEach(menu => {
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
        console.log(user_menu_id)
        let response = await get_api_data('is-mymenu-set', {
            TableCode: 'users',
            MenuId: user_menu_id,
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

@endpush
@endonce
