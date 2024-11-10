@extends('layouts.master')
@section('content')

<div class="prescript_detail">

	<div class="card input_info">
		<div class="card_inner">

			<div class="row m-0 mb-2 mb-lg-4">
                <button type="button" tabindex="-1" class="btn btn-sm btn-black col-2"
                onclick="$('#modal-media-library').modal('show')">
                    처방 초기화
                </button>
                <h1 class="col-6 text-center mb-0">상세처방</h1>
                <div class="col-4 p-0 d-flex">
                    <button type="button" tabindex="-1" class="btn btn-sm btn-black col-8 mr-1"
                    onclick="test()">
                        양안시 처방인쇄
                    </button>
                    <button type="button" tabindex="-1" class="btn btn-sm btn-black col">
                        닫기
                    </button>
                </div>
            </div>

            <div class="row col-6 mb-1e">
                <div class="ml-n2 col-12">
                    <div>방문이유&주요증상</div>
                    <textarea class="col" style="height: 50px;"></textarea>
                </div>
            </div>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border mb-1">구안경도수</legend>
                <div class="table-responsive eye-lens-table">
                    <table>
                        <tr>
                            <th></th>
                            <th>SPH</th>
                            <th>CYL</th>
                            <th>AXIS</th>
                            <th>원용PD</th>
                            <th>ADD</th>
                            <th>근용PD</th>
                            <th>BASE(I/O)/△</th>
                            <th>BASE(U/D)/△</th>
                            <th>나안</th>
                            <th>교정</th>
                        </tr>
                        <tr class="r-eye-lens">
                            <td style="width: 10px">OD</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex "><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                        <tr class="l-eye-lens">
                            <td style="width: 10px">OS</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start "><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border mb-1">완전교정</legend>
                <div class="table-responsive eye-lens-table">
                    <table>
                        <tr>
                            <th></th>
                            <th>SPH</th>
                            <th>CYL</th>
                            <th>AXIS</th>
                            <th>원용PD</th>
                            <th>ADD</th>
                            <th>근용PD</th>
                            <th>BASE(I/O)/△</th>
                            <th>BASE(U/D)/△</th>
                            <th>나안</th>
                            <th>교정</th>
                        </tr>
                        <tr class="r-eye-lens">
                            <td style="width: 10px">OD</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start"><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                        <tr class="l-eye-lens">
                            <td style="width: 10px">OS</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start"><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border mb-1">처방</legend>
                <div class="table-responsive eye-lens-table">
                    <table>
                        <tr>
                            <th></th>
                            <th>SPH</th>
                            <th>CYL</th>
                            <th>AXIS</th>
                            <th>원용PD</th>
                            <th>ADD</th>
                            <th>근용PD</th>
                            <th>BASE(I/O)/△</th>
                            <th>BASE(U/D)/△</th>
                            <th>나안</th>
                            <th>교정</th>
                        </tr>
                        <tr class="r-eye-lens">
                            <td style="width: 10px">OD</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start"><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                        <tr class="l-eye-lens">
                            <td style="width: 10px">OS</td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start"><input class="rounded w-100 axis-txt" type="text"> º</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                            </td>
                            <td class="base">
                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                            </td>
                            <td>
                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>

			<div class="section sec1">
				<h3>개인파라미터</h3>
				<div class="row m-0 r1">
					<fieldset class="scheduler-border col-4 ml-0">
						<legend class="scheduler-border mb-1">피팅 높이 (OH)</legend>
							<div>
								<div><span>R :</span><input type="text" class="input_line"> mm</div>
								<div><span>L :</span><input type="text" class="input_line"> mm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">단안 PD</legend>
							<div>
								<div><span>R :</span><input type="text" class="input_line"> mm</div>
								<div><span>L :</span><input type="text" class="input_line"> mm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">정점간 거리</legend>
							<div>
								<div><span>R :</span><input type="text" class="input_line"> mm</div>
								<div><span>L :</span><input type="text" class="input_line"> mm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">Inset (인셋)</legend>
							<div>
								<div><span>R :</span><input type="text" class="input_line"> mm</div>
								<div>L  : <input type="text" class="input_line"> mm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-5">
						<legend class="scheduler-border mb-1">안면각</legend>
							<div>
								<div class="d-flex align-items-start"><input type="text" class="input_line"> º</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-5">
						<legend class="scheduler-border mb-1">경사각</legend>
							<div>
								<div class="d-flex align-items-start"><input type="text" class="input_line"> º</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-5">
						<legend class="scheduler-border mb-1">누진대 길이</legend>
							<div>
								<div class="d-flex align-items-start"><input type="text" class="input_line"> mm</div>
							</div>
					</fieldset>

				</div>

				<div class="row m-0 mt-65 r2">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border mb-1 .col-2">주시안</legend>
							<div>
								<div>OD <input type="checkbox"></div>
								<div>OS <input type="checkbox"></div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border">
						<legend class="scheduler-border mb-1 .col-2">입체시 검사</legend>
							<div>
								<div>정상 <input type="checkbox"></div>
								<div>이상 <input type="checkbox"></div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border">
						<legend class="scheduler-border mb-1 .col-2">색각 검사</legend>
							<div>
								<div>정상 <input type="checkbox"></div>
								<div>이상 <input type="checkbox"></div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border">
						<legend class="scheduler-border mb-1">임슬러 그리드 검사</legend>
							<div>
								<div>OD : <span>정상 <input type="checkbox"></span> 이상 <span><input type="checkbox"></span></div>
								<div>OS : <span>정상 <input type="checkbox"></span> 이상 <span><input type="checkbox"></span></div>
							</div>
					</fieldset>

				</div>
			</div>

			<div class="section sec2">
				<h3>선별검사</h3>
				<div class="row m-0">
					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">차폐검사</legend>
							<div>
								<div>원거리 : <input type="text"  class="input_line"></div>
								<div>근거리 : <input type="text"  class="input_line"></div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">Worth Four-Dot (억제,복시)</legend>
							<div>
								<div>원거리 : <input type="text"  class="input_line"></div>
								<div>근거리 : <input type="text"  class="input_line"></div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-4">
						<legend class="scheduler-border mb-1">눈 모임 근점 검사 (폭주 근점)</legend>
							<div class="justify-content-center">
								<div>OU : <input type="text"  class="input_line"> cm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-2">
						<legend class="scheduler-border mb-1">조절 근점 검사</legend>
							<div class="justify-content-center">
								<div class="flex-1">OD : <input type="text"  class="input_line"> cm(100/cm = D)</div>
								<div class="flex-1">OS : <input type="text"  class="input_line"> cm(100/cm = D)</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-2">
						<legend class="scheduler-border mb-1">조절 용이 검사</legend>
							<div>
								<div>OU : <input type="text"  class="input_line"> cpm</div>
								<div>OD : <input type="text"  class="input_line"> cpm</div>
								<div>OS : <input type="text"  class="input_line"> cpm</div>
							</div>
					</fieldset>

					<fieldset class="scheduler-border col-1">
						<legend class="scheduler-border mb-1">브로드 H 검사</legend>
						<div class="position-relative p-0" id="canvasDiv1">
							<img src="/images/pic.jpg" alt="임시로 넣어 놓은 이미지. 추후 삭제">
							<button type="button" tabindex="-1" class="px-0 border border-right-0 border-bottom-0 border-success bg-white position-absolute right-0 bottom-0"
							onclick="clear_canvas1()">
								<i class="fas fa-eraser px-1"></i>
							</button>
						</div>
					</fieldset>

				</div>
			</div>

			<div class="section sec3">
				<h3>양안시 검사</h3>

				<div class="row m-0">
					<fieldset class="scheduler-border col-2 add_line">
						<legend class="scheduler-border mb-1">시위 검사</legend>
						<div class="flex-flow-column align-items-center  justify-content-center">
							<div class="stit_c">[원거리]</div>
							<div>수평 <input type="text"  class="input_line"> △ / 수직 : <input type="text"  class="input_line"> △</div>
						</div>

						<div class="flex-flow-column align-items-center  justify-content-center ">
							<div class="stit_c">[근거리]</div>
							<div>수평 <input type="text"  class="input_line"> △ / 수직 : <input type="text"  class="input_line"> △</div>
						</div>
					</fieldset>

					<fieldset class="scheduler-border col-2 add_line">
						<legend class="scheduler-border mb-1">상대 조절력</legend>
						<div class="flex-flow-column align-items-center  justify-content-center">
							<div class="stit_c ">[PRA - 양성]</div>
							<div><span class="in_txt"><input type="text"  class="input_line"></span></div>
						</div>

						<div class="flex-flow-column align-items-center  justify-content-center">
							<div class="stit_c">[NRA - 음성]</div>
							<div><span class="in_txt"><input type="text"  class="input_line"></span></div>
						</div>
					</fieldset>

					<fieldset class="scheduler-border col-2 justify-content-center">
						<legend class="scheduler-border mb-1">조절 래그</legend>
						<div>
							<div><input type="checkbox">정상 (+0.50 ~ +0.75) < <input type="checkbox">이상 (+1.00 ~ )</div>
						</div>
					</fieldset>

					<fieldset class="scheduler-border col-2 justify-content-center">
						<legend class="scheduler-border mb-1">AC/A 비</legend>
						<div>
							<div><input type="text" class="input_line w100"></div>
						</div>
					</fieldset>

					<fieldset class="scheduler-border d-flex flex-wrap col-1 add_line_lb">
						<legend class="scheduler-border mb-1">융합검사</legend>
						<div class="flex-column col-2  justify-content-center">
							<div class="stit_l">[원거리 수평융합 - BO(양성융합)]</div>
							<ul>
								<li>
									<input type="checkbox">흐린점 (<input type="text" class="input_line">△)
								</li>
								<li>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</li>
								<li>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</li>
							</ul>
						</div>

						<div class="flex-column col-2  justify-content-center">
							<div class="stit_l">[원거리 수평융합 - BI(음성융합)]</div>
							<ul>
								<li>
									<input type="checkbox">흐린점 (<input type="text" class="input_line">△)
								</li>
								<li>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</li>
								<li>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</li>
							</ul>
						</div>

						<div class="flex-column col-2  justify-content-center">
							<div class="stit_l">[원거리 수직융합 - OD]</div>
							<dl>
								<dt>BD -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
							<dl>
								<dt>BU -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
						</div>

						<div class="flex-column col-2  justify-content-center ">
							<div class="stit_l">[원거리 수직융합 - OS]</div>
							<dl>
								<dt>BD -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
							<dl>
								<dt>	BU -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
						</div>

						<div class="flex-column col-2  justify-content-center">
							<div class="stit_l">[근거리 수평융합 - BO (양성융합)]</div>
							<ul>
								<li><input type="checkbox">흐린점 (<input type="text" class="input_line">△)</li>
								<li><input type="checkbox">분리점 (<input type="text" class="input_line">△)</li>
								<li><input type="checkbox">회복점 (<input type="text" class="input_line">△) </li>
							</ul>
						</div>

						<div class="flex-column col-2 justify-content-center">
							<div class="stit_l">[근거리 수평융합 - BI (음성융합)]</div>
							<ul>
								<li><input type="checkbox">흐린점 (<input type="text" class="input_line">△)</li>
								<li><input type="checkbox">분리점 (<input type="text" class="input_line">△)</li>
								<li><input type="checkbox">회복점 (<input type="text" class="input_line">△) </li>
							</ul>
						</div>

						<div class="flex-column col-2 justify-content-center ">
							<div class="stit_l">[근거리 수직융합 - OD]</div>
							<dl>
								<dt>BD -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
							<dl>
								<dt>	BU -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
						</div>

						<div class="flex-column col-2 justify-content-center">
							<div class="stit_l">[근거리 수직융합 - OS]</div>
							<dl>
								<dt>BD -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
							<dl>
								<dt>	BU -</dt>
								<dd>
									<input type="checkbox">분리점 (<input type="text" class="input_line">△)
								</dd>
								<dd>
									<input type="checkbox">회복점 (<input type="text" class="input_line">△)
								</dd>
							</dl>
						</div>

					</fieldset>

				</div>
			</div>

		</div>
		<!--// card_inner 끝 -->
	</div>
	<!--// card 끝 -->
</div>

@endsection
