<!-- Main navbar -->
<div class="head_nav navbar navbar-expand-md navbar-dark pr-0">
    <div class="navbar-brand">
        <a href="{{ url('/dabory/myapp') }}" class="d-inline-block"><img src="{{ asset('/myapp/images/logo.png') }}" alt=""></a>
    </div>

	<div class="position-relative d-flex flex-wrap flex-1  align-items-center px-2">

		<div class="nav_wrap">
			<button class="btn" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="btn sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse show" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item btn_left_collapse">
					<a href="#" id="sidebar-main" class="navbar-nav-link sidebar-control sidebar-main-toggle">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
				<!-- 언어변환 셀렉트 시작 -->
				<li class="sel_lang nav-item dropdown dropdown-user mx-0 mr-md-2 w-100 w-md-auto mb-2 mb-md-0">
					<select class="select w-100 w-md-auto bg-dark-100 select-sm" onchange="window.location.href='/country-code?code='+this.value">
						@foreach(config('constants.countries') ?? [] as $country)
							<option {{ session('user.CountryCode') == $country ? 'selected' : '' }}
								value="{{ $country }}">
								{{ config('languages')[strtolower(explode('_', $country)[0])]['isoName'] }}
							</option>
						@endforeach
					</select>
				</li>
				<!--// 언어변환 셀렉트 끝 -->
			</ul>
			<span class="badge ml-md-3 mr-md-auto d-none d-md-flex">&nbsp</span>
			<x-myapp.navbar-form-component />
		</div>

		<div class="head_right d-md-flex">
			<ul class="navbar-nav align-items-center right-extend">
				<li class="nav-item">
					<button type="button" class="btn toggle-full-screen">
						<i class="fas fa-expand-arrows-alt"></i>
					</button>
				</li>
				<!-- sort  메뉴 -->
				<li class="nav_sort nav-item dropdown">
					<button type="button" class="btn dropdown-toggle" id="navSortButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-th-large" style="font-size:17px;"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navSortButton">
                        <x-myapp.sort-menu-component />

{{--							<a class="dropdown-item" href="#">--}}
{{--									<span class="icon bg-blue"><i class="fas fa-sitemap"></i></span>--}}
{{--									메뉴1--}}
{{--								</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-green"><i class="fas fa-layer-group"></i></span>--}}
{{--								메뉴2-일이삼사오육칠팔--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-warning"><i class="fab fa-sellsy"></i></span>--}}
{{--								메뉴<br/>--}}
{{--								일이삼사오육칠팔--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-indigo"><i class="fas fa-sitemap"></i></span>--}}
{{--								메뉴4--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-pink"><i class="fas fa-layer-group"></i></span>--}}
{{--								메뉴5--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-yellow"><i class="fab fa-sellsy"></i></span>--}}
{{--								메뉴6--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-blue"><i class="fas fa-sitemap"></i></span>--}}
{{--								메뉴7--}}
{{--							</a>--}}
{{--							<a class="dropdown-item" href="#">--}}
{{--								<span class="icon bg-green"><i class="fas fa-layer-group"></i></span>--}}
{{--								메뉴8 - 메뉴가 추가됩니다.--}}
{{--							</a>--}}
					</div>
				</li>
				<!--// sort 메뉴 끝 -->
				<li class="nav-item">
					<button type="button" class="btn sidebar-control sidebar-right-toggle">
						<i class="fas fa-sticky-note" style="font-size:16px;"></i>
					</button>
				</li>

				<li class="mx-0 mr-md-2 mb-2 mb-md-0 w-100 w-md-auto">
					<div class="media profile position-relative">
						<a href="#" class="dropdown-toggle" id="dropdownPermMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-user-lock" style="font-size:17px;"></i>
						</a>
						<div class="dropdown-menu  dropdown-menu-right" style="min-width: 4.5rem;" aria-labelledby="dropdownPermMenuButton">
							<div class="dropdown-item d-flex align-items-start flex-column">
								<div class="{{ session('user.MenuPermission.is_list') === '1' ? '' : 'my-line-through' }}">List</div>
								<div class="{{ session('user.MenuPermission.is_read') === '1' ? '' : 'my-line-through' }}">Read</div>
								<div class="{{ session('user.MenuPermission.is_create') === '1' ? '' : 'my-line-through' }}">Create</div>
								<div class="{{ session('user.MenuPermission.is_update') === '1' ? '' : 'my-line-through' }}">Update</div>
								<div class="{{ session('user.MenuPermission.is_delete') === '1' ? '' : 'my-line-through' }}">Delete</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<!-- 서치박스 시작 -->
		<div class="m_searchbox">
			<div>
				<div>
					<input type="text" id="user-menu-search" placeholder="Member Menu Search And Move">
					<button type="button" onclick="user_menu_search_and_move($('#user-menu-search').val())"><i class="fas fa-search"></i></button>
				</div>
{{--			<div class="collapse" id="collapseExample">--}}
{{--				<a href="#">검색 결과가 나옵니다. 검색 결과가 나옵니다.</a>--}}
{{--				<a href="#">검색 결과가 나옵니다. 검색 결과가 나옵니다.</a>--}}
{{--				<a href="#">검색 결과가 나옵니다. 검색 결과가 나옵니다.</a>--}}
{{--				<a href="#">검색 결과가 나옵니다. 검색 결과가 나옵니다.</a>--}}
{{--			</div>--}}
			</div>
		</div>
		<!--// 서치박스 끝 -->

	</div>
</div>
<!-- /main navbar -->

@push('js')
    <script>
        $(document).ready(function () {
            $('#user-menu-search').on('keyup',function(key){
                if(key.keyCode === 13) {
                    user_menu_search_and_move($(this).val())
                    this.blur()
                }
            });

            $('#user-menu-search').autocomplete({
                source: menuPages
                    .filter(menu => menu['PageUri'])
                    .map(menu => {
                        return { code: menu['MenuCode'], value: menu['MenuName'] }
                    }),
                focus: function (event, ui) {
                    return false;
                },
                select: function (event, ui) {
                    user_menu_search_and_move(ui['item']['value'])
                },
                minLength: 1,
                delay: 100,
                autoFocus: false,
            });
        });

        function user_menu_search_and_move(menu_name) {
            const search_menu = menuPages.filter(menu => menu['MenuName'] === menu_name)
            if (isEmpty(search_menu)) {
                return iziToast.error({
                    title: 'Error', message: '존재하지 않는 메뉴명',
                });
            }

            const menu = search_menu[0]
            const url = menu['PageUri'] + '?bpa=' + menu['bpa']

            return window.location = url
        }
    </script>
@endpush
