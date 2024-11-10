<ul class="navbar-nav align-items-center d-flex flex-column flex-md-row">
    <li class="mx-0 mr-md-2 mb-2 mb-md-0 w-md-auto">
        <a href="/" target="_blank">{{ $form['FormVars']['Title']['Home'] }}</a>
    </li>
    <li class="mx-0 mr-md-2 mb-2 mb-md-0 w-md-auto">
		<div class="btn-group">
			<button type="button" onclick="clear_cache()">{{ $form['FormVars']['Title']['ClearCache'] }}</button>
			<button type="button" class="dropdown-toggle" data-toggle="dropdown"></button>
		    <div class="dropdown-menu">
				<a href="#" class="dropdown-item"><i class="icon-mail5"></i>디스플레이 캐시삭제</a>
				<a href="#" class="dropdown-item"><i class="icon-gear"></i>사용자메뉴 캐시삭제</a>
				<a href="#" class="dropdown-item"><i class="icon-bucket"></i>메인메뉴 캐시삭제</a>
				<div class="dropdown-divider"></div>
				<a href="#" onclick="query_turbo('item')" class="dropdown-item"><i class="icon-screen-full"></i>상품-쿼리터보 적용</a>
				<a href="#" onclick="query_turbo('post')" class="dropdown-item"><i class="icon-pen-minus"></i>게시판-쿼리터보 적용</a>
				<a href="#" onclick="query_turbo('item_review')" class="dropdown-item"><i class="icon-pen-minus"></i>상품리뷰-쿼리터보 적용</a>
				<a href="#" onclick="query_turbo('item_revsum')" class="dropdown-item"><i class="icon-pen-minus"></i>상품리뷰합계-쿼리터보 적용</a>
			</div>
		</div>
    </li>
    <li class="mx-0 mr-md-2 mb-2 mb-md-0 nav-item dropdown dropdown-user">
        <a href="{{ route('user-logout') }}"><i class="icon-switch2"></i>&nbsp;{{ $form['FormVars']['Title']['Logout'] }}</a>
    </li>
</ul>

@once
@push('js')
<script>
    function clear_cache() {
        confirm_message_shw_and_delete(function() {
            window.location.href = '{{ route('user.clear.cache') }}';
        })
    }

    function query_turbo(table_name) {
        confirm_message_shw_and_delete(function() {
            $('#spinner-processing').show()
            window.location.href = '/user-query-turbo/' + table_name;
        })
    }
</script>
@endpush
@endonce
