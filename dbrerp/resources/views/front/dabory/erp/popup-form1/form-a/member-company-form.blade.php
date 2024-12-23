{{-- @extends('layouts.master')
@section('content') --}}

<div class="mb-1 pt-2 text-right btn-groups">
    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
            Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary member-company-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'member-company-act',
        ])
    </div>
</div>
<div class="card p-2 mb-2" id="member-company-form">
	<button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <ul class="nav nav-tabs nav-tabs-solid rounded my-2">
        <li class="nav-item"><a href="#mem-info" class="nav-link active" data-toggle="tab">회원</a></li>
        <li class="nav-item"><a href="#com-info" class="nav-link" data-toggle="tab">사업자</a></li>
        <li class="nav-item"><a href="#delivery" class="nav-link" data-toggle="tab">배송</a></li>
        <li class="nav-item"><a href="#calculate" class="nav-link" data-toggle="tab">정산</a></li>
        <li class="nav-item"><a href="#contact" class="nav-link" data-toggle="tab">연락처(예정)</a></li>
        <li class="nav-item"><a href="#custom" class="nav-link" data-toggle="tab">고객센터(예정)</a></li>
    </ul>

	<div class="tab-content">
		<input type="hidden" id="Id" name="Id" value="0">
		<input type="hidden" id="BuyerId" name="BuyerId" value="0">

		<!-- 회원정보 -->
		<div class="tab-pane fade active show" id="mem-info">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<input type="hidden" id="sso-sub-id">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['Name'] }}</label>
									<input type="text" id="first-name-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Name'] }}"
										{{ $formA['FormVars']['Required']['Name'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">닉네임</label>
									<input type="text" id="nick-name-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['Email'] }}</label>
									<input type="text" id="email-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Email'] }}"
										{{ $formA['FormVars']['Required']['Email'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['MobileNo'] }}</label>
									<input type="text" id="mobile-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['MobileNo'] }}"
										{{ $formA['FormVars']['Required']['MobileNo'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['Status'] }}</label>
									<select class="rounded w-100" id="status-select"
										{{ $formA['FormVars']['Required']['Status'] }}>
										@foreach ($formA['StatusOptions'] as $option)
											<option value="{{  $option['Value']  }}">{{ DataConverter::execute(null, $option['Caption']) }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 회원정보 끝 -->

		<!-- 사업장정보 -->
		<div class="tab-pane fade" id="com-info">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">사업자 위치</label>
									<div class="d-flex">
										<div class="d-flex align-items-center line-height-1 mr-2">
											<input type="radio" name="shop_abroad" value="0" id="shop-abroad-0">
											<label for="shop-abroad-0">국내</label>
										</div>
										<div class="d-flex align-items-center line-height-1">
											<input type="radio" name="shop_abroad" value="1" id="shop-abroad-1">
											<label for="shop-abroad-1">해외</label>
										</div>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['TaxNo'] }}</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['TaxNo'] }}"
										{{ $formA['FormVars']['Required']['TaxNo'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['CompanyName'] }}(법인명)</label>
									<input type="text" id="company-name-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['CompanyName'] }}"
										{{ $formA['FormVars']['Required']['CompanyName'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['President'] }}</label>
									<input type="text" id="president-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['President'] }}"
										{{ $formA['FormVars']['Required']['President'] }}>
								</div>
                                <div class="form-group d-flex flex-column mb-1">
									<label class="m-0">{{ $formA['FormVars']['Title']['ZipCode'] }}</label>
									<input type="text" id="zip-code-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['ZipCode'] }}"
										{{ $formA['FormVars']['Required']['ZipCode'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-1">
									<input type="text" id="addr1-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Addr1'] }}"
										{{ $formA['FormVars']['Required']['Addr1'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<input type="text" id="addr2-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['Addr2'] }}"
										{{ $formA['FormVars']['Required']['Addr2'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['BizType'] }}</label>
									<input type="text" id="biz-type-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['BizType'] }}"
										{{ $formA['FormVars']['Required']['BizType'] }}>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['DealItem'] }}</label>
									<input type="text" id="deal-item-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['DealItem'] }}"
										{{ $formA['FormVars']['Required']['DealItem'] }}>
								</div>
								<!-- 사업자 등록증 이전 소스
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['CertImg'] }}</label>
									<a id="cert-img-link" href="" target="_blank">
										<img src="" class="w-100" id="cert-img">
									</a>
								</div>
								-->
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">{{ $formA['FormVars']['Title']['TelNo'] }}</label>
									<input type="text" id="tel-no-txt" class="rounded w-100" autocomplete="off" maxlength="{{ $formA['FormVars']['MaxLength']['TelNo'] }}"
										{{ $formA['FormVars']['Required']['TelNo'] }}>
								</div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">상점명</label>
                                    <input type="text" id="shop-name-txt" class="rounded w-100" autocomplete="off">
                                </div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">사업장 대표 메일</label>
									<input type="text" id="email-txt" class="rounded w-100" autocomplete="off">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">사업자등록증</label>
									<input type="text" id="cert-img-txt" class="w-100 rounded mb-1 tooltip-show-img" disabled>
									<div class="d-flex justify-content-center">
										<button class="btn col text-white bg-grey-700 border-grey-700 bg-grey-700-hover" id="file-upload-btn" onclick="PopupForm1FormAMemberCompanyForm.upload_file(this, '#cert-img-txt')">
											미디어 업로드
										</button>
										<button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMemberCompanyForm.delete_media_id('#cert-img-txt')">삭제</button>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">세금계산서 메일</label>
									<input type="text" id="tax-mail-txt" class="rounded w-100" autocomplete="off">
								</div>
								<div class="form-group d-flex flex-column mb-2 mt_space">
									<label class="m-0">통신판매업신고번호</label>
									<input type="text" id="online-cert-no-txt" class="rounded w-100" autocomplete="off">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">통신판매업 신고증</label>
									<input type="text" id="online-cert-img-txt" class="w-100 rounded mb-1 tooltip-show-img" disabled>
									<div class="d-flex justify-content-center">
										<button class="btn col text-white bg-grey-700 border-grey-700 bg-grey-700-hover" id="file-upload-btn" onclick="PopupForm1FormAMemberCompanyForm.upload_file(this, '#online-cert-img-txt')">
											미디어 업로드
										</button>
										<button class="btn text-white btn-danger col-4 ml-1" onclick="PopupForm1FormAMemberCompanyForm.delete_media_id('#online-cert-img-txt')">삭제</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 사업장정보 끝 -->
		<!-- 배송정보 -->
		<div class="tab-pane fade" id="delivery">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">배송 유형</label>
									<div class="d-flex">
										<div class="d-flex align-items-center line-height-1 mr-2">
											<input type="radio" value="0" name="ship_type" id="ship-type-0">
											<label for="">국내</label>
										</div>
										<div class="d-flex align-items-center line-height-1">
											<input type="radio" value="1" name="ship_type" id="ship-type-1">
											<label for="">해외</label>
										</div>
									</div>
								</div>
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">기본 택배사)</label>
									<select class="rounded w-100" id="courier-code-select">
                                        <option value="">=배송정보 선택=</option>
									</select>
								</div>
                                <div class="form-group d-flex flex-column mb-2  mt_space">
									<label class="m-0">기본배송비 유형</label>
									<select class="rounded w-100" id="ship-fee-brand-select">
                                        <option value="">=기본배송비 유형 선택=</option>
									</select>
								</div>

								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">반품배송비(원)</label>
									<input type="text" id="return-fee-txt" class="rounded w-100 decimal"
                                           data-point="decimal('sales_prc')"
                                           autocomplete="off">
								</div>
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">교환배송비(원)</label>
									<input type="text" id="exchange-fee-txt" class="rounded w-100 decimal"
                                           data-point="decimal('sales_prc')"
                                           autocomplete="off" >
								</div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">평균배송기간(일)</label>
                                    <input type="text" id="avg-deli-days-txt" class="rounded w-100"
                                           autocomplete="off" >
                                </div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
                                <div class="d-flex flex-column mb-2 mt_space">
									<label class="m-0">출고지주소</label>
									<div class="d-flex">
										<input type="text" id="ship-zip-txt" class="rounded radius-r0 w-100" autocomplete="off">
										<button type="button" onclick="PopupForm1FormAMemberCompanyForm.get_zip_code(0)" tabindex="-1"
												class="btn-dark rounded border-0 radius-l0 col-2">
											<i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
										</button>
									</div>
								</div>
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">주소</label>
									<input type="text" id="ship-addr1-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">주소상세</label>
									<input type="text" id="ship-addr2-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="d-flex flex-column mb-2 mt_space">
									<label class="m-0">반품지주소</label>
									<div class="d-flex">
										<input type="text" id="return-zip-txt" class="rounded radius-r0 w-100" autocomplete="off">
										<button type="button" onclick="PopupForm1FormAMemberCompanyForm.get_zip_code(1)" tabindex="-1"
												class="btn-dark rounded border-0 radius-l0 col-2">
											<i class="fas fa-map-marker-alt fa-lg" style="line-height: 24px;"></i>
										</button>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">주소</label>
									<input type="text" id="return-addr1-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">주소상세</label>
									<input type="text" id="return-addr2-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 배송정보 끝 -->

		<!-- 정산정보 -->
		<div class="tab-pane fade" id="calculate">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">정산유형</label>
									<select class="rounded w-100" id="status-select">
										<option value="">매주 수요일</option>
										<option value="">정산유형2</option>
										<option value="">정산유형3</option>
										<option value=""> 정산유형4</option>
										<option value=""> 정산유형5</option>
									</select>
								</div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">기본 수수료율</label>
                                    <input type="text" id="commission-rate-txt" class="rounded w-100 decimal"
                                           data-point="decimal('sales_prc')"
                                           autocomplete="off">
                                </div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">입점사 국가 코드</label>
									<input type="text" id="nation-code-txt" class="rounded w-100" autocomplete="off">
								</div>
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">입점사 화폐단위</label>
									<input type="text" id="currency-code-txt" class="rounded w-100" autocomplete="off" >
								</div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
                                <div class="form-group d-flex flex-column mb-2">
									<label class="m-0">임금은행</label>
									<input type="text" id="bank-name-txt" class="rounded w-100" autocomplete="off">
								</div>
                                <div class="form-group d-flex flex-column mb-2">
                                    <label class="m-0">임금계좌</label>
                                    <input type="text" id="account-no-txt" class="rounded w-100" autocomplete="off">
                                </div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">예금주</label>
									<input type="text" id="holder-name-txt" class="rounded w-100" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 정산정보 끝 -->

		<!-- 연락처정보 -->
		<div class="tab-pane fade" id="contact">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">담당자위치</label>
									<div class="d-flex">
										<div class="d-flex align-items-center line-height-1 mr-2">
											<input type="radio" id="">
											<label for="">국내</label>
										</div>
										<div class="d-flex align-items-center line-height-1">
											<input type="radio" id="">
											<label for="">해외</label>
										</div>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">영업담당자명</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">이메일</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">연락처</label>
									<div class="d-flex">
										<input type="text" class="rounded radius-r0 w-100" autocomplete="off">
										<button type="button" class="btn-dark rounded border-0 radius-l0 col-3">
											인증번호 받기
										</button>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">연락처 인증</label>
									<div class="d-flex">
										<div class="form-group-feedback form-group-feedback-right w-100">
											<input type="text" class="form-control w-100 adius-r0">
											<div class="form-control-feedback text-success">
												<i class="icon-checkmark3"></i>
											</div>
										</div>
										<button type="button" 	class="btn-dark rounded border-0 radius-l0 col-3">
											인증하기
										</button>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">배송담당자명</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">이메일</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">연락처</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2 mt_space">
									<label class="m-0">정산담당자명</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">이메일</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">연락처</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">CS담당자명</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">이메일</label>
									<input type="text" id="tax-no-txt" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">연락처</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 연락처정보 끝 -->

		<!-- 고객센터정보 -->
		<div class="tab-pane fade" id="custom">
			<div class="card-header">
				<div class="row">
					<!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">고객센터 연락처</label>
									<div class="d-flex w-100">
										<select class="col-4 custom-select mr-1">
											<option disabled="disabled" value="">지역번호</option>
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
											<option value="02">02</option>
											<option value="031">031</option>
											<option value="032">032</option>
											<option value="033">033</option>
											<option value="041">041</option>
											<option value="042">042</option>
											<option value="043">043</option>
											<option value="044">044</option>
											<option value="050">050</option>
											<option value="051">051</option>
											<option value="052">052</option>
											<option value="053">053</option>
											<option value="054">054</option>
											<option value="055">055</option>
											<option value="060">060</option>
											<option value="061">061</option>
											<option value="062">062</option>
											<option value="063">063</option>
											<option value="064">064</option>
											<option value="070">070</option>
											<option value="080">080</option>
											<option value="090">090</option>
											<option value="0130">0130</option>
											<option value="0502">0502</option>
											<option value="0503">0503</option>
											<option value="0504">0504</option>
											<option value="0505">0505</option>
											<option value="0506">0506</option>
											<option value="0507">0507</option>
											<option value="0508">0508</option>
											<option value="000">기타</option>
										</select>
										<input type="text" id="" class="rounded flex-1" autocomplete="off" maxlength="">
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">고객센터 이메일</label>
									<input type="text" id="" class="rounded w-100" autocomplete="off" maxlength="">
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">운영시간</label>
									<div class="d-flex w-100">
										<input type="time" class="form-control flex-1">
										<div class="px-1 text-center">~</div>
										<input type="time" class="form-control flex-1">
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--//왼쪽 컬럼 끝 -->

					<!-- 오른쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
						<div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
							<div class="card-body">
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">상담제외시간</label>
									<div class="d-flex w-100" style="height:28px;">
										<div class="d-flex d-flex align-items-center line-height-1 mr-2">
											<input type="checkbox" id="">
											<label for="">점심시간</label>
										</div>
										<div class="d-flex d-flex align-items-center line-height-1 mr-2">
											<input type="checkbox" id="">
											<label for="">토요일</label>
										</div>
										<div class="d-flex d-flex align-items-center line-height-1 mr-2">
											<input type="checkbox" id="">
											<label for="">일요일</label>
										</div>
										<div class="d-flex d-flex align-items-center line-height-1 mr-2">
											<input type="checkbox" id="">
											<label for="">공휴일</label>
										</div>
									</div>
								</div>
								<div class="form-group d-flex flex-column mb-2">
									<label class="m-0">점심시간</label>
									<div class="d-flex w-100">
										<input type="time" class="form-control flex-1">
										<div class="px-1 text-center">~</div>
										<input type="time" class="form-control flex-1">
									</div>
									<div data-v-260a5d00="" class="col-form-label custom-control custom-switch"><input type="checkbox" name="check-button" class="custom-control-input" value="true" id="__BVID__337"><label class="custom-control-label" for="__BVID__337">
                점심시간 없음
              </label></div>
								</div>
							</div>
						</div>
					</div>
					<!--// 오른쪽 컬럼 끝 -->
				</div>
				<!--// row 끝 -->
			</div>
			<!-- card-header 끝 -->
		</div>
		<!--// 고객센터정보 끝 -->
	</div>

</div>

{{-- @endsection --}}

@once
@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        $(document).ready(async function() {
            PopupForm1FormAMemberCompanyForm.mediaModal = await include_media_library('media-body', 'item')

            const response = await get_api_data('etc-page', {
                PageVars: {
                    Query: "etc_type = 'smart-courier' and select_name = 'korean'",
                    Asc: 'sort_no',
                    Limit: 9999
                }
            })
            $('#member-company-form').find('#courier-code-select').append(create_options(response.data.Page))

            const setup_response = await get_api_data('setup-page', {
                PageVars: {
                    Query: "setup_code = 'ship-fee'",
                    Limit: 9999
                }
            })
            $('#member-company-form').find('#ship-fee-brand-select').append(window.custom_create_options('BrandCode', 'SetupName', setup_response.data.Page))

            $('.member-company-act').on('click', function () {
                // console.log($(this).data('value'))

                switch( $(this).data('value') ) {
                    case 'save': PopupForm1FormAMemberCompanyForm.btn_act_save(); break;
                    case 'del': PopupForm1FormAMemberCompanyForm.btn_act_del(); break;
                }

            });

            $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list, unique_key) {
                $(unique_key).val(file_url_list[0])
            });

            activate_button_group()
        });

        (function( PopupForm1FormAMemberCompanyForm, $, undefined ) {
            PopupForm1FormAMemberCompanyForm.formA = {!! json_encode($formA) !!};
            PopupForm1FormAMemberCompanyForm.mediaModal

            PopupForm1FormAMemberCompanyForm.btn_act_for = async function (format) {
                Atype.btn_act_for(format, '#member-company-form', 'PopupForm1FormAMemberCompanyForm')
            }

            PopupForm1FormAMemberCompanyForm.delete_media_id = function (media_dom_id) {
                $('#member-company-form').find(media_dom_id).val('')
            }

            PopupForm1FormAMemberCompanyForm.multi_block = async function (ids, status, callback) {
                const data = ids.map(function (id) {
                    return { Id:id, UpdatedOn: get_now_time_stamp(), Status: status }
                })
                let response = await get_api_data(PopupForm1FormAMemberCompanyForm.formA['General']['ActApi'], { Page: data });
                if (response.data.Page) {
                    callback()
                } else {
                    let message = response.data.body ?? $('#api-request-failed-please-check').text();
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                }
            }

            PopupForm1FormAMemberCompanyForm.get_zip_code = function (index) {
                new daum.Postcode({
                    oncomplete: function(data) {
                        if (index === 0) {
                            $('#member-company-form').find('#ship-zip-txt').val(data.zonecode)
                            $('#member-company-form').find('#ship-addr1-txt').val(data.roadAddress)
                        } else {
                            $('#member-company-form').find('#return-zip-txt').val(data.zonecode)
                            $('#member-company-form').find('#return-addr1-txt').val(data.roadAddress)
                        }
                    }
                }).open();
            }

            PopupForm1FormAMemberCompanyForm.btn_act_new = function () {
                $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                $('#modal-select-popup.popup-form1-form-a-member-company-form .modal-dialog').css('maxWidth', '1200px');

                $('#modal-select-popup .modal-header').addClass('bg-original-purple')
                $('#modal-select-popup .modal-body button').addClass('btn-primary')

                Atype.btn_act_new('#member-company-form #frm');
            }

            PopupForm1FormAMemberCompanyForm.parameter = function () {
                let id = Number($('#member-company-form').find('#Id').val());
                let parameter = {
                    Id: id,
                    UpdatedOn: get_now_time_stamp(),
                    Status: $('#member-company-form').find('#status-select').val(),
                    NickName: $('#member-company-form').find('#nick-name-txt').val(),
                }
                if (id < 0) {
                    parameter = { Id: id }
                } else if (id > 0) {
                    delete parameter.CreatedOn;
                } else {
                    delete parameter.UpdatedOn;
                }

                // console.log(parameter)
                return parameter;
            }

            PopupForm1FormAMemberCompanyForm.companyParameter = function () {
                const member_company_form = $('#member-company-form')
                let id = Number($(member_company_form).find('#BuyerId').val());
                let parameter = {
                    Id: id,
                    ShopAbroad: $(member_company_form).find('input:radio[name=shop_abroad]:checked').val(),
                    CompanyName: $(member_company_form).find('#company-name-txt').val(),
                    TaxNo: $(member_company_form).find('#tax-no-txt').val(),
                    President: $(member_company_form).find('#president-txt').val(),
                    TelNo: $(member_company_form).find('#tel-no-txt').val(),
                    BizType: $(member_company_form).find('#biz-type-txt').val(),
                    DealItem: $(member_company_form).find('#deal-item-txt').val(),
                    ZipCode: $(member_company_form).find('#zip-code-txt').val(),
                    Addr1: $(member_company_form).find('#addr1-txt').val(),
                    Addr2: $(member_company_form).find('#addr2-txt').val(),
                    Email: $(member_company_form).find('#email-txt').val(),
                    TaxMail: $(member_company_form).find('#tax-mail-txt').val(),
                    OnlineCertNo: $(member_company_form).find('#online-cert-no-txt').val(),
                    CertImg: $(member_company_form).find('#cert-img-txt').val(),
                    OnlineCertImg: $(member_company_form).find('#online-cert-img-txt').val(),

                    ShipType: $(member_company_form).find('input:radio[name=ship_type]:checked').val(),
                    CourierCode: $(member_company_form).find('#courier-code-select').val(),
                    ShipFeeBrand: $(member_company_form).find('#ship-fee-brand-select').val(),
                    ReturnFee: minusComma($(member_company_form).find('#return-fee-txt').val()) || '0',
                    ExchangeFee: minusComma($(member_company_form).find('#exchange-fee-txt').val()) || '0',
                    AvgDeliDays: $(member_company_form).find('#avg-deli-days-txt').val(),

                    ShipZip: $(member_company_form).find('#ship-zip-txt').val(),
                    ShipAddr1: $(member_company_form).find('#ship-addr1-txt').val(),
                    ShipAddr2: $(member_company_form).find('#ship-addr2-txt').val(),
                    ReturnZip: $(member_company_form).find('#return-zip-txt').val(),
                    ReturnAddr1: $(member_company_form).find('#return-addr1-txt').val(),
                    ReturnAddr2: $(member_company_form).find('#return-addr2-txt').val(),

                    CommissionRate: minusComma($(member_company_form).find('#commission-rate-txt').val()) || '0',
                    NationCode: $(member_company_form).find('#nation-code-txt').val(),
                    CurrencyCode: $(member_company_form).find('#currency-code-txt').val(),
                    BankName: $(member_company_form).find('#bank-name-txt').val(),
                    AccountNo: $(member_company_form).find('#account-no-txt').val(),
                    HolderName: $(member_company_form).find('#holder-name-txt').val(),
                }

                console.log(parameter)
                return parameter;
            }

            PopupForm1FormAMemberCompanyForm.btn_act_save = function () {
                Atype.set_parameter_callback(PopupForm1FormAMemberCompanyForm.parameter);

                Atype.btn_act_save('#member-company-form #frm', async function () {
                    const response = await get_api_data('company-act', {
                        Page: [ PopupForm1FormAMemberCompanyForm.companyParameter() ]
                    })

                    $('#modal-select-popup.show').trigger('list.requery');
                    $('#modal-select-popup.show').modal('hide');
                }, 'PopupForm1FormAMemberCompanyForm');
            }


            PopupForm1FormAMemberCompanyForm.show_popup_callback = async function (id, c1) {
                PopupForm1FormAMemberCompanyForm.btn_act_new()

                await PopupForm1FormAMemberCompanyForm.fetch_member(Number(id));
            }

            PopupForm1FormAMemberCompanyForm.fetch_member = async function (id) {
                const response = await get_api_data(PopupForm1FormAMemberCompanyForm.formA['General']['PickApi'], {
                    Page: [ { Id: id } ]
                })

                const member_ext = await get_api_data('member-ext-pick', {
                    Page: [ { Id: id } ]
                })

                PopupForm1FormAMemberCompanyForm.set_member_ui(response, member_ext)
            }

            PopupForm1FormAMemberCompanyForm.upload_file = function ($this, id) {
                if (! PopupForm1FormBMediaForm.btn_act_new('item')) {
                    return
                }

                $('#modal-media').data('target-id', '')
                $('#modal-media').data('unique-key', id)
                $('#member-company-form').find('#modal-media-btn').data('target', 'media')
                $('#member-company-form').find('#modal-media-btn').data('variable', PopupForm1FormAMemberCompanyForm.mediaModal)
                $('#member-company-form').find('#modal-media-btn').trigger('click')
            }

            PopupForm1FormAMemberCompanyForm.set_member_ui = async function (response, member_ext) {
                if (isEmpty(response.data) || response.data.apiStatus) return;
                const member_company_form = $('#member-company-form')
                const member = response.data.Page[0]
                // console.log(member)

                const company_pick = await get_api_data('company-pick', {
                    Page: [ { Id: member.BuyerId } ]
                })

                const buyer = company_pick.data.Page[0]
                if (! isEmpty(buyer.CompanyJson)) {
                    const company_json = JSON.parse(buyer.CompanyJson)
                    $(member_company_form).find('#van-txt').val(company_json.Van)
                    $(member_company_form).find('#van-id-txt').val(company_json.VanId)
                    $(member_company_form).find('#van-pw-txt').val(company_json.VanPw)
                }

                $(member_company_form).find('#Id').val(member.Id)
                $(member_company_form).find('#BuyerId').val(member.BuyerId)
                $(member_company_form).find('#sso-sub-id').val(member.SsoSubId)
                $(member_company_form).find('#first-name-txt').val(member.FirstName)
                $(member_company_form).find('#nick-name-txt').val(member.NickName)
                $(member_company_form).find('#email-txt').val(member.Email)
                $(member_company_form).find('#mobile-no-txt').val(member_ext.data.Page[0].MobileNo)
                $(member_company_form).find('#status-select').val(member.Status)


                $(member_company_form).find(`input:radio[name=shop_abroad]:input[value='${buyer['ShopAbroad']}']`).prop('checked', true)
                $(member_company_form).find('#company-name-txt').val(buyer.CompanyName)
                $(member_company_form).find('#tax-no-txt').val(buyer.TaxNo)
                $(member_company_form).find('#president-txt').val(buyer.President)
                $(member_company_form).find('#tel-no-txt').val(buyer.TelNo)
                $(member_company_form).find('#biz-type-txt').val(buyer.BizType)
                $(member_company_form).find('#deal-item-txt').val(buyer.DealItem)
                $(member_company_form).find('#zip-code-txt').val(buyer.ZipCode)
                $(member_company_form).find('#addr1-txt').val(buyer.Addr1)
                $(member_company_form).find('#addr2-txt').val(buyer.Addr2)
                $(member_company_form).find('#email-txt').val(buyer.Email)
                $(member_company_form).find('#tax-mail-txt').val(buyer.TaxMail)
                $(member_company_form).find('#online-cert-no-txt').val(buyer.OnlineCertNo)
                $(member_company_form).find('#cert-img-txt').val(buyer.CertImg)
                $(member_company_form).find('#online-cert-img-txt').val(buyer.OnlineCertImg)

                $(member_company_form).find(`input:radio[name=ship_type]:input[value='${buyer['ShipType']}']`).prop('checked', true)
                $(member_company_form).find('#courier-code-select').val(buyer.CourierCode)
                $(member_company_form).find('#ship-fee-brand-select').val(buyer.ShipFeeBrand)
                $(member_company_form).find('#return-fee-txt').val(format_conver_for(buyer.ReturnFee, "decimal('sales_prc')"))
                $(member_company_form).find('#exchange-fee-txt').val(format_conver_for(buyer.ExchangeFee, "decimal('sales_prc')"))
                $(member_company_form).find('#avg-deli-days-txt').val(buyer.AvgDeliDays)

                $(member_company_form).find('#ship-zip-txt').val(buyer.ShipZip)
                $(member_company_form).find('#ship-addr1-txt').val(buyer.ShipAddr1)
                $(member_company_form).find('#ship-addr2-txt').val(buyer.ShipAddr2)
                $(member_company_form).find('#return-zip-txt').val(buyer.ReturnZip)
                $(member_company_form).find('#return-addr1-txt').val(buyer.ReturnAddr1)
                $(member_company_form).find('#return-addr2-txt').val(buyer.ReturnAddr2)

                $(member_company_form).find('#commission-rate-txt').val(format_conver_for(buyer.CommissionRate, "decimal('sales_prc')"))
                $(member_company_form).find('#nation-code-txt').val(buyer.NationCode)
                $(member_company_form).find('#currency-code-txt').val(buyer.CurrencyCode)
                $(member_company_form).find('#bank-name-txt').val(buyer.BankName)
                $(member_company_form).find('#account-no-txt').val(buyer.AccountNo)
                $(member_company_form).find('#holder-name-txt').val(buyer.HolderName)
            }


        }( window.PopupForm1FormAMemberCompanyForm = window.PopupForm1FormAMemberCompanyForm || {}, jQuery ));
    </script>
@endpush
@endonce
