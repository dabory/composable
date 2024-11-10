@extends('layouts.master')
@section('content')

    <div class="d-flex">
        <div class="mr-2">
            <h2>원본이미지A (width: 250px, height: 250px)</h2>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual13_250x250.jpg" alt="">
        </div>
        <hr>
        <div class="mr-2">
            <h2>원본이미지B (width: 600px, height: 200px)</h2>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual12_600x200.jpg" alt="">
        </div>
        <hr>
        <div class="mr-2">
            <h2>원본이미지C (width: 200px, height: 600px)</h2>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual1_200x600.jpg" alt="">
        </div>
    </div>

    <hr>
    <h2>A. 반드시 정사각형안에 전체를 보여주는 고전적인 썸네일 (현재 테두리 격자크기: 150x150)
        <span class="text-danger">(현재 완료)</span>
    </h2>
    <div class="mb-2 d-flex">
        <div class="mr-3">
            <h1>이미지A</h1>
            <div style="text-align:center; width:150px; height: 150px; display:table; border:1px solid #cecece;">
                <div style="display:table-cell; vertical-align:middle;">
                    <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual13_250x250.jpg"
                         style="max-width:150px; max-height:150px;">
                </div>
            </div>
        </div>

        <div class="mr-3">
            <h1>이미지B</h1>
            <div style="text-align:center; width:150px; height: 150px; display:table; border:1px solid #cecece;">
                <div style="display:table-cell; vertical-align:middle;">
                    <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual12_600x200.jpg"
                         style="max-width:150px; max-height:150px;">
                </div>
            </div>
        </div>

        <div class="mr-3">
            <h1>이미지C</h1>
            <div style="text-align:center; width:150px; height: 150px; display:table; border:1px solid #cecece;">
                <div style="display:table-cell; vertical-align:middle;">
                    <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual1_200x600.jpg"
                         style="max-width:150px; max-height:150px;">
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h2>B. 중앙을 강조하는 썸네일
        <span class="text-primary">(요청)</span>
    </h2>
    <div class="mb-2 d-flex">
        <div class="mr-3">
            <h1>이미지A</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual13_250x250.jpg">
        </div>

        <div class="mr-3">
            <h1>이미지B</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual12_600x200.jpg">
        </div>

        <div class="mr-3">
            <h1>이미지C</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual1_200x600.jpg">
        </div>
    </div>

    <hr>
    <h2>C. 인스타 그램 방식 썸네일
        <span class="text-primary">(요청)</span>
    </h2>
    <div class="mb-2 d-flex">
        <div class="mr-3">
            <h1>이미지A</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual13_250x250.jpg">
        </div>

        <div class="mr-3">
            <h1>이미지B</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual12_600x200.jpg">
        </div>

        <div class="mr-3">
            <h1>이미지C</h1>
            <img src="https://msqxp.daboryhost.com/uploads/2023/02/13/post/main_visual1_200x600.jpg">
        </div>
    </div>
@endsection
