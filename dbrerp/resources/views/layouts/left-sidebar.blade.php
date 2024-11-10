<div class="sidebar sidebar-dark sidebar-main sidebar-expand-xl">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center d-md-none">
        <a href="#" class="sidebar-mobile-main-toggle"><i class="icon-arrow-left8"></i></a>
        Navigation
    </div>
    <!-- Sidebar content -->
    <div class="sidebar-content" style="background-color: {{ '#' . session()->get('user.SortMenu.C3') }};">
        <x-nav-side-bar-component :menuCode="$menuCode ?? ''" />
    </div>
    <!-- /sidebar content -->


</div>
