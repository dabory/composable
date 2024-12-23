@extends('front.dabory.pro.shop-1.layouts.master')
@section('content')
    <!--inner Title Start -->
    <div class="sms_title_main_wrapper">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sms_inner_title_heading full_width">
                        <h2>cart</h2>

                        <ul>
                            <li><a href="#">Home</a> &nbsp;&nbsp;&nbsp;/</li>
                            <li>cart</li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- inner Title End -->
    <!-- about us wrapper start -->
    <div class="full_width sub_wrapper cart">
        <!-- container 시작 -->
        <div class="container">

            <!-- row 시작 -->
            <div class="row">
                <!-- 왼쪽 시작 -->
                <div class="left col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">

                    <div class="tb_wrap" id="modal-cart">

                        <div class="table-responsive">
                            <table class="table table-row cart-table" style="table-layout: fixed; min-width:747px;">
                                <thead>
                                <tr>
                                    <th class="info" style="width: 20%">상품</th>
                                    <th class="price text-center" style="width: 10%">가격</th>
                                    <th class="amount text-center" style="width: 7%">수량</th>
                                    <th class="sucm text-center" style="width: 10%">소계</th>
                                    <th class="del" style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody id="cart-table-body">
                                <tr>
                                    <td class="info">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('/themes/pro/eyerecord/resources/images/pic.jpg') }}">
                                            <p class="mx-0">
                                                <a href="#">상품이름이 들어갑니다.</a>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="price">₩ 0,000,000</td>
                                    <td class="amount"><input type="number" class="w-100" min="1" onchange="cart_qty_update(this, ' $cart['Id'] }}')" value="000"></td>
                                    <td class="sum">₩ 0,000,000</td>
                                    <td class="del"><i class="fas fa-trash-alt" role="button" onclick="cart_delete('$cart['Id'] }}')"></i></td>
                                </tr>

                                <tr>
                                    <td class="info">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('/themes/pro/eyerecord/resources/images/pic.jpg') }}">
                                            <p class="mx-0">
                                                <a href="#">상품이름이 들어갑니다.</a>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="price">₩ 0,000,000</td>
                                    <td class="amount"><input type="number" class="w-100" min="1" onchange="cart_qty_update(this, ' $cart['Id'] }}')" value="000"></td>
                                    <td class="sum">₩ 0,000,000</td>
                                    <td class="del"><i class="fas fa-trash-alt" role="button" onclick="cart_delete('$cart['Id'] }}')"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="btn_wrap mb-2 mb-md-0">
                            <div class="input_box">
                                <input type="text"><button type="button" class="btn">쿠폰적용</button>
                            </div>
                        </div>

                    </div>

                </div>
                <!--// 왼쪽 끝 -->

                <!-- 오른쪽 시작 -->
                <div class="right col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12" id="cart-total-box">
                    <div class="sidebar_widget full_width">
                        <strong class="accordion"><span>장바구니 합계</span></strong>
                        <dl class="info_box">
                            <dt>소계</dt>
                            <dd>₩ <span id="amt-total">0,000,000</span></dd>
                        </dl>
                        <dl class="sum_box">
                            <dt>총계</dt>
                            <dd>₩ <span id="total" style="color: #ea5520;">0,000,000</span></dd>
                        </dl>

                        <div class="btn_wrap">
                            <button type="button" class="btn btn-primary" onclick="checkout()">결제 진행하기</button>
                        </div>
                    </div>
                </div>
                <!-- 오른쪽 끝 -->
            </div>
            <!--// row 끝 -->

        </div>
        <!--// container 끝 -->
    </div>

@endsection
