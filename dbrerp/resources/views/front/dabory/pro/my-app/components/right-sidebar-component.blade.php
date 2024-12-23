<div class="sidebar-section sidebar-user my-0 d-flex align-items-center justify-content-center"
    id="right-side-bar">
    <button class="btn btn-danger w-100 mr-1" id="manual-btn"
        onclick="show_manual_modal(this)">매뉴얼</button>
    <button class="btn btn-light w-100 mr-1" onclick="shortcut_in_or_out(1)">넣기</button>
    <button class="btn btn-light w-100" onclick="shortcut_in_or_out(0)">빼기</button>
    <button type="button" class="tab-close position-absolute top-0 right-0 color-danger"
        onclick="close_right_sidebar()"><i class="fas fa-times fa-xs"></i></button>
</div>

<ul class="sidebar-section nav-right-sidebar nav nav-sidebar">
</ul>


@once
@push('js')
<script>
    $(document).ready(async function() {
        nav_right_sidebar_init();

        $(document).on('hide.bs.modal','#modal-manual', function () {
            $('#right-side-bar').find('#manual-btn').prop('disabled', false);
        });
    });

    async function show_manual_modal($this) {
        $($this).prop('disabled', true);
        const para_name = currentBpa['para_name'];
        let response = await get_para_data('manual', `/etc/self-manual${para_name}`)
        get_blades_html('front.outline.static.manual', response['data'], function (html) {
            if (! $('#element_in_which_to_insert').find('#modal-manual').length) {
                $('#element_in_which_to_insert').append(html);
            }
            $('#modal-manual').find('#myModalLabel').text(`${currentBpa['menu_name']} 매뉴얼`)
            $('#modal-manual').modal('show')
        }, 'manual');
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
                    class="nav-link d-block ${menu.MenuCode == menuCode ? 'active' : ''}"><i class="${menu.Icon} mr-2" style="width: 10px;"></i>
                        ${menu.MenuName}
                    </a>
                </li>`;
        });
        $('.nav-right-sidebar').html(html);
    }

    async function shortcut_in_or_out(is_mymenu) {
        let member_menu_id = menuPage.filter(menu => menu.MenuCode == menuCode)[0]['MemberMenuId']
        let response = await get_api_data('is-mymenu-set', {
            TableCode: 'member',
            MenuId: member_menu_id,
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
                url: "/my-app/clear-menu-cache",
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
