@extends('views.layouts.master')
@section('content')

<div class="sub blog blog_details">
	<!-- 제목 부분 - 디자이너 삽입 -->
	<section class="inner-section single-banner">
		<div class="container">
			<h1>{{ $postType['C7'] }}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $postType['C7'] }}</li>
			</ol>
		</div>
	</section>
	<!--// 제목 부분 끝 -->

	<div class="blog-details-part container">

		<div class="blog-details">
			<div class="blog-details-content">
				<h2 class="blog-details-title">{{ $post['C5'] }}</h2>
				<ul class="blog-details-meta">
					<li>
						<i class="fa-regular fa-calendar-days"></i>
						<span>{{ $post['C7'] }}</span>
					</li>
					<li>
						<i class="fa-solid fa-user"></i>
						<span>{{ $post['C11'] }}</span>
					</li>
				</ul>

				@switch($postType['C5'])
					@case('image')
					@case('gallery')
						<div class="blog-details-thumb">
							<img src="{{ msset($post['C1']) }}" alt="blog" onerror="this.src=coming_soon_img">
						</div>
						@break
					@case('movie')
						<div class="movie-details-thumb">
							<iframe  src="{{ $post['T1'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						@break
				@endswitch

				<div class="blog_cont_wrap">
					{!! $post['C6'] !!}
				</div>
			</div>
			<div class="blog_bottom">
				<div class="blog-details-navigate">
					@if ($prePost)
						<div class="blog-details-prev">
							<a class="nav-arrow btn btn_outline_gray" href="{{ route('dbrbbs.details', [$postCode, $prePost[0]['C3']]) }}"><i class="fa-solid fa-arrow-left"></i>이전</a>
						</div>
					@endif

					@if ($nextPost)
						<div class="blog-details-next">
							<a class="nav-arrow btn btn_outline_gray" href="{{ route('dbrbbs.details', [$postCode, $nextPost[0]['C3']]) }}">다음<i class="fa-solid fa-arrow-right"></i></a>
						</div>
					@endif
				</div>
				<div class="btn_wrap">
					<button type="button" class="btn btn-primary" onclick="location.href='{{ route('dbrbbs.list', $postCode) }}'">목록</button>
				</div>
			</div>
		</div>

		<!-- 댓글 -->
		<div class="comments container">
			<div class="comment_write">
				<h3>댓글쓰기</h3>
				<form class="form-prevent-multiple-submits" action="{{ route('dbrbbs.comment.store') }}" method="POST">
					@csrf
					<input type="hidden" name="post_id" value="{{ $post['Id'] }}" aria-hidden="true">
					<textarea placeholder="댓글을 입력해 주세요." name="bd_contents" required aria-label="댓글입력"></textarea>
					<button type="submit" class="button-prevent-multiple-submits btn btn-primary btn_mid">
						<i class="spinner fa fa-spinner fa-spin"></i>
						댓글쓰기
					</button>
				</form>
			</div>

			<div class="comment_list">
				<ul>
				@forelse($comments ?? [] as $index => $comment)
					<li>
						<div class="info">
							<span class="img_box">
								<img src="/themes/composable/pro/resources/images/user.webp" alt="user">
							</span>
							<span class="name">{{ $comment['C4'] }}</span>
							<span class="time">{{ DataConverter::execute($comment['C1'], 'diffForHumans') }}</span>
							<span class="btn_report"><i class="fa-solid fa-triangle-exclamation"></i> 신고</span>
						</div>
						<div class="comment_cont">
							{{ $comment['C3'] }}
						</div>
						<div class="btn_wrap">
							<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#reply_comment_{{ $comment['Id'] }}" aria-expanded="false" aria-controls="reply_comment">답글</button>
							<span class="btn_good">
								<button type="button" class="btn"><i class="far fa-thumbs-up"></i></button>000
							</span>
							<span class="btn_bad">
								<button type="button" class="btn"><i class="far fa-thumbs-down"></i></button>000
							</span>
						</div>
						<div class="collapse reply_write" id="reply_comment_{{ $comment['Id'] }}">
							<form class="form-prevent-multiple-submits" action="{{ route('dbrbbs.comment.store') }}" method="POST">
								@csrf
								<input type="hidden" name="post_id" value="{{ $post['Id'] }}" aria-hidden="true">
								<input type="hidden" name="parent_id" value="{{ $comment['Id'] }}" aria-hidden="true">
								<textarea placeholder="답글을 입력해 주세요." name="bd_contents" required aira-label="답글 입력"></textarea>
								<button type="submit" class="button-prevent-multiple-submits btn btn-primary btn_mid">
									<i class="spinner fa fa-spinner fa-spin"></i>
									답글쓰기
								</button>
							</form>
						</div>

							<!-- 댓글의 댓글 -->
							<div class="reply_wrap">
								<div class="comment_list">
									<ul>
									@forelse($comment['ReplyPage'] ?? [] as $reply)
										<!--1줄 -->
										<li>
											<div class="info">
												<span class="img_box">
													<img src="/themes/composable/pro/resources/images/user.webp" alt="user">
												</span>
												<span class="name">{{ $reply['C4'] }}</span>
												<span class="time">{{ DataConverter::execute($reply['C1'], 'diffForHumans') }}</span>
												<span class="btn_report"><i class="fa-solid fa-triangle-exclamation"></i> 신고</span>
											</div>
											<div class="comment_cont">
												{{ $reply['C3'] }}
											</div>
											<div class="btn_wrap">
												<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#reply_comment1" aria-expanded="false" aria-controls="reply_comment1">답글</button>
												<span class="btn_good">
													<button type="button" class="btn"><i class="far fa-thumbs-up"></i></button>000
												</span>
												<span class="btn_bad">
													<button type="button" class="btn"><i class="far fa-thumbs-down"></i></button>000
												</span>
											</div>
											<div class="collapse reply_write" id="reply_comment1">
												<div>
													<textarea placeholder="답글을 입력해 주세요."></textarea>
													<button type="button" class="btn btn_basic btn_mid">답글쓰기</button>
												</div>
											</div>
										</li>
									@empty
									@endforelse
									</ul>
								</div>
							</div>
							<!--// 댓글의 댓글 끝 -->
					</li>
				@empty
				@endforelse
				</ul>
			</div>

			@if ($comments->hasPages())
				<!-- 페이지네이션 -->
				<div class="comment_btm">
					<div class="col-lg-12">
						<div class="bottom-paginate">
							{{ $comments->appends(['limit' => request('limit')])->links() }}
						</div>
					</div>
				</div>
				<!-- 페이지네이션 끝 -->
			@endif
		</div>
		<!--// 댓글 끝 -->

	</div>
</div>
@endsection
