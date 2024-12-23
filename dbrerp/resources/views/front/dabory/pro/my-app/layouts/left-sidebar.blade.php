<div class="d-md-none" style="float:right; text-align:right;">
	<button type="button" class="btn sidebar-mobile-right-toggle">
    	<i class="icon-arrow-right8"></i>
    </button>
    <button class="btn" type="button" data-toggle="collapse" data-target="#navbar-mobile">
        <i class="icon-tree5"></i>
    </button>
    <button class="btn sidebar-mobile-main-toggle" type="button">
        <i class="icon-paragraph-justify3"></i>
    </button>
    <button type="button" class="btn sidebar-control sidebar-right-toggle">
        <i class="fas fa-th-large"></i>
    </button>
</div>

<!-- Main sidebar -->
<div id="left_nave" class="sidebar sidebar-main sidebar-expand-xl">
    <div class="d-xl-none">
        <button class="sidebar-mobile-main-toggle" type="button" data-toggle="collapse"
                data-target="#navbar-demo1-mobile">
            <i class="icon-arrow-right8"></i>
        </button>
    </div>

    <div class="sidebar-content position-static">
        <!-- User menu -->
        <div class="card sidebar-user">
            <div class="card-body">
                <div class="media">
                    <a href="#" class="mr-3">
                        <img src="{{ asset('/images/pic.jpg') }}" width="38" height="38" class="rounded-circle" alt="">
                    </a>
                    <div class="media-body">
                        <div class="media-title font-weight-semibold">
                            {{ session('member.NickName') ?? '' }}</div>
                        <div class="font-size-xs opacity-50">
                            {{ session('member.Email') ?? '' }}</div>
                    </div>
                    <div class="ml-1 align-self-center">
                        <button type="button"
                                class="btn btn-outline-light-100 border-transparent btn-icon rounded-pill btn-sm d-none d-xl-inline-block"><i
                                class="icon-cog3"></i></button>
                        <button type="button"
                                class="btn btn-outline-light-100 border-transparent btn-icon rounded-pill btn-sm d-xl-none"><i
                                class="icon-cog3"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Navigation -->
        <div class="card">
            <x-my-app-left-sidebar-component :menuCode="$menuCode ?? ''"/>
        </div>
        <!-- /navigation -->
    </div>
</div>
<!-- /pro sidebar -->
<script>
    //$(document).ready(function() {
    //	var windowWidth = $( window ).width();
    //	if(windowWidth <= 1200) {
    //	 	$('.sidebar-main').addClass('collapse');
    //	} else {
    //		$('.sidebar-main').removeClass('collapse');
    //	}

    //	});
</script>
