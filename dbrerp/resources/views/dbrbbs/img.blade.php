<div class="row">
    <div class="col12 img_gallery">
        <ul class="row">
            @forelse($postPage['Page'] ?? [] as $i => $post)
                <li class="w-100 {{ $post['PcGalleryClass'] }} {{ $post['MoGalleryClass'] }}">
                    <div class="num">{{ $i + 1 }}</div>
                    <div class="w-100">
                        <div class="conts_wrap d-flex justify-content-between">
                            <div class="conts_box">
                                <a href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}" class="blog-title">
                                    {{ $post['Title'] }}
                                </a>
                                <ul class="info">
                                    <li>{{ $post['C9'] }}</li>
                                    <li>{{ $post['C4'] }}</li>
                                </ul>
                                <div class="blog-desc" style="cursor: pointer;" onclick="location.href = '{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}'">
                                    {{ $post['C7'] }}
                                </div>
                            </div>
                            <div class="img_box">
                                <a href="{{ route('dbrbbs.details', [$postCode, $post['C10']]) }}">
                                    <img src="{{ msset($post['C1']) }}" :width="this.galleryWidth" :height="this.galleryHeight"
                                         class="w-md-50" alt="blog">
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="pricing_box1 full_width no_data">
                    데이터가 존재하지 않습니다
                </li>
            @endforelse
        </ul>
    </div>
</div>
