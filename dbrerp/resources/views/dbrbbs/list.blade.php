@extends('views.layouts.master')
@section('content')

    <div class="sub_wrap blog movie">

        <div class="title">
            <h1>{{ $postType['C7'] }}</h1>
        </div>

        <div class="blog-grid">
            <div class="container">
                <!-- 탑 필터 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-filter">
                            <form class="filter-show" method="GET">
                                <input type="hidden" name="page" value="1">
                                <!--<label class="filter-label">Show :</label>-->
                                <select class="form-select filter-select" name="limit" onchange="$(this).closest('form').submit()">
                                    @foreach([12, 24, 36] as $limit)
                                        <option value="{{ $limit }}" {{ request('limit') == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                                    @endforeach
                                </select>
                            </form>
                            <div class="blog_search">
                                <form class="blog-widget-form" method="GET">
                                    <input type="hidden" name="page" value="1">
                                    <input type="text" placeholder="블로그 검색" name="p">
                                    <button class="icofont-search-1"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// 탑 필터 끝 -->

                <div id="post-list">
                    <!-- 리스트 -->
                    @switch($postType['C5'])
                        @case('text')
                        @include('dbrbbs.text')
                        @break
                        @case('image')
                        @include('dbrbbs.img')
                        @break
                        @case('gallery')
                        @case('movie')
                        @include('dbrbbs.gallery')
                        @break
                    @endswitch
                    <!--// 리스트 끝 -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="bottom-paginate">
                            <p class="page-info"></p>
                            {{ $postPage['Page']->appends(['limit' => request('limit')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!--// containr 끝 -->
        </div>
        <!--// blog-grid 끝 -->

    </div>

@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#post-list',

            data: function () {
                return {
                    design: @json($design),
                    galleryWidth: 0,
                    galleryHeight: 0,
                };
            },

            computed: {
            },

            mounted() {
                this.onResize()
            },

            created() {
                window.addEventListener('resize', this.onResize)
            },

            beforeDestroy() {
                window.removeEventListener('resize', this.onResize)
            },

            methods: {
                onResize() {
                    // Mobile
                    if (window.innerWidth <= 768) {
                        this.galleryWidth = this.design['MoGalleryWidth']
                        this.galleryHeight = this.design['MoGalleryHeight']
                    } else {
                        this.galleryWidth = this.design['PcGalleryWidth']
                        this.galleryHeight = this.design['PcGalleryHeight']
                    }
                }
            },

        });
    </script>
@endpush
