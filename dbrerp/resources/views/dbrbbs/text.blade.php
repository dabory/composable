<div class="row">
    <div class="col12 txt_gallery">
        <!-- 리스트 헤드 -->
        <ul class="list_top">
            <li>
                <div class="list_colgroup">
                    <div class="num"></div>
                    <div class="subject">제목</div>
                    <div class="name">닉네임</div>
                    <div class="date">등록일</div>
                    <div class="hit">조회</div>
                </div>
            </li>
        </ul>

        <!-- 리스트 -->
        <ul class="list_cont">
            <li>
                <div class="list_colgroup">
                    <div class="num li_notice"><span class="tag tag_notice">공지</span></div>
                    <div class="subject"><a href="#">블로그 이용 규칙</a></div>
                    <div class="name">admin</div>
                    <div class="date">2003.06.23</div>
                    <div class="hit">1000</div>
                </div>
            </li>
            @forelse($postPage['Page'] ?? [] as $post)
                <li>
                    <div class="list_colgroup">
                        <div class="num">1</div>
                        <div class="subject">
                            <a href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}">
                                <div class="txt_box">
                                    {{ $post['Title'] }}
                                </div>
                            </a>
                        </div>
                        <div class="name">{{ $post['C9'] }}</div>
                        <div class="date">{{ $post['C4'] }}</div>
                        <div class="hit">0000</div>
                    </div>
                </li>
            @empty
                <div class="pricing_box1 full_width">
                    데이터가 존재하지 않습니다
                </div>
            @endforelse
        </ul>
    </div>
</div>
