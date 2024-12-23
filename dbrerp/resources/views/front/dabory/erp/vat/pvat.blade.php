@extends('layouts.master')
@section('content')
<div class="mb-1 pt-2 text-right">
	<button type="button" hidden
	    class="btn btn-success btn-open-modal bodycopy-modal-btn"
        data-target="bodycopy"
        data-clicked="checked_data"
        data-variable="bodyCopy">
    </button>
    <button type="button"
        class="btn btn-success btn-open-modal"
        data-target="eyetest"
        data-clicked="Btype.fetch_slip_form_book"
        data-variable="eyetestModal">
        <i class="icon-folder-open"></i>
    </button>
    <button type="button" class="btn btn-sm btn-primary" id="eyetest-save-spinner-btn" hidden>
	    <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
		Loading...
    </button>
    <div class="btn-group position-static show" id="eyetest-btn-group">
		<button type="button" class="btn btn-sm btn-primary eyetest-act save-button" data-value="save">저장</button>
        <button type="button" class="btn btn-sm dropdown-toggle dropdown-icon btn-primary " data-toggle="dropdown" aria-expanded="true">
			<span class="sr-only" style="padding-left: 10px;">Toggle Dropdown</span>
			<ul class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(-155px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
				<li class="dropdown-item eyetest-act" data-parameter="" data-value="new" data-index="0" data-component="">새 레코드</li>
				<li class="dropdown-divider"></li>
				<li class="dropdown-item eyetest-act" data-parameter="" data-value="save-and-new" data-index="1" data-component="">저장 후 새 레코드</li>
				<li class="dropdown-divider"></li>
				<li class="dropdown-item eyetest-act" data-parameter="" data-value="delete" data-index="2" data-component="">삭제</li>
				<li class="dropdown-divider"></li>
            </ul>
		</button>
    </div>
</div>

<div class="modal taxbill taxbill_purch" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
	  <div class="modal-body">

		<div class="select_type">
			<div>
				<input type="radio">
				<label>과세</label>
			</div>
			<div>
				<input type="radio">
				<label>영세</label>
			</div>
			<div>
				<input type="radio">
				<label>면세</label>
			</div>
		</div>

		<div class="paper">
			<div class="row row1">
				<div class="col1">
					<h3>세금계산서</h3>
					<span>[ 공급자 보관용 ]</span>
				</div>
				<div class="col2">
					<dl>
						<dt>승인번호</dt>
						<dd>1234</dd>
					</dl>
					<dl>
						<dt>일련번호</dt>
						<dd>12234</dd>
					</dl>
				</div>
			</div>
			<div class="row row2">
				<div class="provider">
					<table>
						<tr>
							<th rowspan="5">공급받는자</th>
						</tr>
						<tr class="tr_reginum">
							<td class="td_head">등록번호</td>
							<td colspan="3">106-82-05411</td>
						</tr>
						<tr class="tr_name">
							<td class="td_head">상호<br/>(법인명) <span class="mark">*</span></td>
							<td>
								<span class="search_box">
									<input type="text">
									<button type="button" class="btn" data-toggle="modal" data-target=".pop_findsupplier"><i class="fas fa-search"></i></button>
								</span>
							</td>
							<td class="td_head w-s">성명</td>
							<td>
								<div>
									<span>황재연</span>
								</div>
							</td>
						</tr>
						<tr class="tr_address">
							<td class="td_head">사업장<br/>주소</td>
							<td colspan="3">
								<div>
									<span>서울특별시 도봉구 마들로11가길 6-25(창동, 월가타워) 302, 303, 304호</span>
								</div>
							</td>
						</tr>
						<tr class="tr_name">
							<td class="td_head">업태</td>
							<td>
								<div>
									<span>서비스업, 제조업 도소매</span>
								</div>
							</td>
							<td class="td_head w-s">종목</td>
							<td>
								<div>
									<span>소독업, 장갑, 운동복</span>
								</div>
							</td>
						</tr>
					</table>	
				</div>
				<div class="supplier">
					<table>
						<tr>
							<th rowspan="5">공급자</th>
						</tr>
						<tr class="tr_reginum">
							<td class="td_head">등록번호</td>
							<td colspan="3">104-88-02652</td>
						</tr>
						<tr class="tr_name">
							<td class="td_head">상호<br/>(법인명)</td>
							<td>
								<div>
									<span>주식회사 다보리</span>
								</div>
							</td>
							<td class="td_head w-s">성명</td>
							<td>
								<div>
									<span>김호익</span>
								</div>
							</td>
						</tr>
						<tr class="tr_address">
							<td class="td_head">사업장<br/>주소</td>
							<td colspan="3">
								<div>
									<span>서울특별시 서초구 남부순환로 2606(양재동) 금정빌딩 8층<span>
								</div>
							</td>
						</tr>
						<tr class="tr_name">
							<td class="td_head">업태</td>
							<td>
								<div>
									<span>정보통신업, 전문 과학 및 기술 서비스업</span>
								</div>
							</td>
							<td class="td_head w-s">종목</td>
							<td>
								<div>
									<span>소프트웨어 개발 및 공급업</span>
								</div>
							</td>
						</tr>
					</table>					
				</div>
			</div>
			<div class="row row3">
				<dl class="date">
					<dt>작성일자<span class="mark">*</span></dt>
					<dd>
						<input class="overflow-hidden text-nowrap start-date" type="date" value="">
					</dd>
				</dl>
				<dl class="price">
					<dt>공급가액<span class="mark">*</span></dt>
					<dd>000,000,000</dd>
				</dl>
				<dl class="tax">
					<dt>세액</dt>
					<dd>000,000,000</dd>
				</dl>
				<dl class="etc">
					<dt>비고</dt>
					<dd><input type="text"></dd>
				</dl>
			</div>
			<div class="row row4">
				<table>
					<tr>
						<th>월일<span class="mark">*</span></th>
						<th>품목<span class="mark">*</span></th>
						<th>규격</th>
						<th>수량<span class="mark">*</span></th>
						<th>단가<span class="mark">*</span></th>
						<th>공급가액<span class="mark">*</span></th>
						<th>세액</th>
						<th>비고</th>
					</tr>
					<tr>
						<td class="td_date"><input class="overflow-hidden text-nowrap start-date" type="date" value=""></td>
						<td class="td_subject"><input type="text"></td>
						<td class="td_size"><input type="text"></td>
						<td class="td_amount"><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td class="td_note"><input type="text"></td>
					</tr>
					<tr>
						<td class="td_date"><input class="overflow-hidden text-nowrap start-date" type="date" value=""></td>
						<td class="td_subject"><input type="text"></td>
						<td class="td_size"><input type="text"></td>
						<td class="td_amount"><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td class="td_note"><input type="text"></td>
					</tr>
					<tr>
						<td class="td_date"><input class="overflow-hidden text-nowrap start-date" type="date" value=""></td>
						<td class="td_subject"><input type="text"></td>
						<td class="td_size"><input type="text"></td>
						<td class="td_amount"><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td class="td_note"><input type="text"></td>
					</tr>
					<tr>
						<td class="td_date"><input class="overflow-hidden text-nowrap start-date" type="date" value=""></td>
						<td class="td_subject"><input type="text"></td>
						<td class="td_size"><input type="text"></td>
						<td class="td_amount"><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td><input type="text"></td>
						<td class="td_note"><input type="text"></td>
					</tr>
				</table>
			</div>
			<div class="row row5">
				<div class="sum">
					<dl>
						<dt>합계금액</dt>
						<dd>000,000,000</dd>
					</dl>
					<dl>
						<dt>현금</dt>
						<dd>000,000,000</dd>
					</dl>
					<dl>
						<dt>수표</dt>
						<dd>000,000,000</dd>
					</dl>
					<dl>
						<dt>어음</dt>
						<dd>000,000,000</dd>
					</dl>
					<dl>
						<dt>외상미수금</dt>
						<dd>000,000,000</dd>
					</dl>
				</div>
				<div class="select_request">
					이 금액을 
					<select>
						<option>청구</option>
						<option>영수</option>
					</select>
					함
				</div>
			</div>
		</div>

		<div class="trans_type">
			<strong>거래유형</strong>
			<div class="input-group">
				<input type="text" class="form-control">
				<div class="input-group-append">
					<button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"></button>
					<div class="dropdown-menu  dropdown-menu-right">
						<dl>
							<dt class="li_head">상품매출</dt>
							<dd>상품매출</dd>
						</dl>
						<dl>
							<dt>매출환입및에누리_상품매출</dt>
							<dd>매출환입및에누리_상품매출</dd>
						</dl>
						<dl>
							<dt>매출할인_상품매출</dt>
							<dd>매출할인_상품매출</dd>
						</dl>
						<dl>
							<dt>제품매출</dt>
							<dd>제품매출</dd>
						</dl>
						<dl>
							<dt>매출환입및에누리_제품매출</dt>
							<dd>매출환입및에누리_제품매출</dd>
						</dl>
						<dl>
							<dt>매출할인_제품매출</dt>
							<dd>매출할인_제품매출</dd>
						</dl>
						<dl>
							<dt>공사수입금</dt>
							<dd>공사수입금</dd>
						</dl>
						<dl>
							<dt>매출할인_공사수입금</dt>
							<dd>매출할인_공사수입금</dd>
						</dl>
						<dl>
							<dt>완성건물매출</dt>
							<dd>완성건물매출</dd>
						</dl>
						<dl>
							<dt>매출할인_완성건물매출</dt>
							<dd>매출할인_완성건물매출</dd>
						</dl>
						<dl>
							<dt>임대료수입</dt>
							<dd>임대료수입</dd>
						</dl>
						<dl>
							<dt>용역매출</dt>
							<dd>용역매출</dd>
						</dl>
						<dl>
							<dt>기타매출</dt>
							<dd>기타매출</dd>
						</dl>
						<dl>
							<dt>서비스수입</dt>
							<dd>서비스수입</dd>
						</dl>
						<dl>
							<dt>운송료수입</dt>
							<dd>운송료수입</dd>
						</dl>
						<dl>
							<dt>임대료</dt>
							<dd>임대료</dd>
						</dl>
						<dl>
							<dt>수수료수입</dt>
							<dd>수수료수입</dd>
						</dl>
						<dl>
							<dt>수수료수익</dt>
							<dd>수수료수익</dd>
						</dl>
						<dl>
							<dt>유형자산처분이익</dt>
							<dd>유형자산처분이익</dd>
						</dl>
						<dl>
							<dt>잡이익</dt>
							<dd>잡이익</dd>
						</dl>
					</div>
				</div>
			</div>		
		</div>

      </div>
      <div class="modal-footer">
        <div class="btn_wrap">
			<button type="button" class="btn btn-primary">저장</button>
			<button type="button" class="btn btn-outline-indigo">취소</button>
		</div>
      </div>
    </div>
  </div>
</div>

@endsection

<!-- 거래처조회 팝업 -->
<div class="modal fade taxbil_popup pop_findsupplier" id="popup_findsupplier" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">거래처</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="search_box">
			<select>
				<option>거래처를 입력하세요</option>
				<option>(사)한국지체장애인협회서울</option>
				<option>거래처 이름1</option>
			</select>
			<button type="button" class="btn btn-gray"><i class="fas fa-search"></i> 조회</button>
			<button type="button" class="btn btn-gray"><i class="fas fa-plus"></i></button>
		</div>
		<div class="result_list">
			<table>
				<tr>
					<th>거래처명</th>
					<th>사업자번호</th>
					<th>대표자명</th>
				</tr>
				<tr>
					<td>(사)한국지체장애인협회서울</td>
					<td>106-82-05411</td>
					<td>황재연</td>
				</tr>
				<tr>
					<td>거래처 이름1</td>
					<td>106-82-05411</td>
					<td>홍길동</td>
				</tr>
			</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">확인</button>
		<button type="button" class="btn btn-outline-indigo">취소</button>
      </div>
    </div>
  </div>
</div>
