<div class="row">
    @forelse($postPage['Page'] ?? [] as $post)
        <div class="{{ $post['PcGalleryClass'] }} {{ $post['MoGalleryClass'] }}">
            <div class="blog-card">
                <div class="blog-media">
                    @if ($postType['C5'] === 'gallery')
                        <a class="blog-img" href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}">
                            {{--                                        <div class="mask"><i class="fa-solid fa-caret-right"></i></div>--}}
                            <img :width="this.galleryWidth" :height="this.galleryHeight" src="{{ msset($post['C1']) }}" alt="blog">
                        </a>
                    @else
                        <a class="video-img" href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}">
                            <iframe class="w-100" :width="this.galleryWidth" :height="this.galleryHeight" src="{{ $post['T1'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </a>
                    @endif
                </div>
                <div class="blog-content">
                    <ul class="blog-meta">
                        <li>
                            <i class="fas fa-user"></i>
                            <span>{{ $post['C9'] }}</span>
                        </li>
                        <li>
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $post['C4'] }}</span>
                        </li>
                    </ul>
                    <h4 class="blog-title">
                        <a href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}">{{ $post['Title'] }}</a>
                    </h4>
                    @if ($postType['C5'] === 'gallery')
                        <p class="blog-desc">
                            {{ $post['C7'] }}
                        </p>
                    @else
                        <div class="d-flex align-items-center">
                            <button class="btn-primary w-100"
                                    onclick="window.location.href = '{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}'"
                                    style="margin-right: 10px;">
                                동영상 보기
                            </button>
                            <button class="btn-danger w-100"
                                    onclick="window.open('{{ $post['T1'] }}', '_blank')">
                                유튜브 보기
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="pricing_box1 full_width">
            데이터가 존재하지 않습니다
        </div>
    @endforelse
</div>
