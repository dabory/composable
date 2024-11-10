@extends('layouts.master')
@section('content')


<div class="mms_wrap">
	<div class="mms">

        <!-- 상단 버튼 시작 -->
        <ul class="top_btn">
        	<button type="button">sms</button>
            <button type="button">lms</button>
            <button type="button">mms</button>
        </ul>
        <!--// 상단 버튼 끝 -->
        
        <!-- 핸드폰 영역 시작 -->
        <div class="input_field">
        	
            <div class="txt_byte">0/90 byte</div>
                        
            <div class="input_box">
            	<input type="text" name="" placeholder="제목을 입력하세요.">
            	<textarea name=""></textarea>
            </div>
                       
            <ul class="mid_btn">
            	<button type="button">고객명</button>
                <button type="button">방문일</button>
                <button type="button">납품일</button>
                <button type="button">생일</button>
                <button type="button">마일지</button>
                <button type="button">카드번</button>
                <button type="button">이메일</button>
                <button type="button">판매사</button>
                <button type="button">안경사</button>
            </ul>
            
            <div class="charater">
               	<button type="button">☆</button>
                <button type="button">★</button>
                <button type="button">◎</button>
                <button type="button">◇</button>
                <button type="button">◆</button>
                <button type="button">○</button>
                <button type="button">●</button>
                 
                <button type="button">□</button>
                <button type="button">■</button>
                <button type="button">♡</button>
                <button type="button">♥</button>
                <button type="button">※</button>
                <button type="button">♤</button>
                <button type="button">♠</button>
                  
                <button type="button">▒</button>
                <button type="button">◈</button>
                <button type="button">㈜</button>
                <button type="button">℡</button>
                <button type="button">♬</button>
                <button type="button">☞</button>
                <button type="button">☎</button>
            </div>
            
            <div class="tel_return">
            	<label>회신TEL</label>
            	<input type="tel" name="">
                <span><input type="checkbox" name=""> 예약설정 경우 Check!</span>
            </div>
            
            <div class="send_btn"><button type="button" class="btn_prime">문자보내기</button></div>
            
        </div>
        <!--// 핸드폰 영역 끝 -->
    
    </div>
</div>

@endsection
