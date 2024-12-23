<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center"
       style="table-layout:fixed; max-width:700px; background-color:#fff; font-size:16px; font-family:'Roboto', 'Noto Sans KR', sans-serif;">
    <tbody>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                   style="padding:20px 10px 10px 10px; border-bottom:2px solid #212222;">
                <tbody>
                <tr>
                    <td>
                        <a href="{{$data['C2']}}"><img src="{{msset($data['C1'])}}"></a>
                    </td>
                    <td align="right">
                        <a href="{{$data['C2']}}"
                           style="color:#191919; font-size:14px; text-decoration:none;">{{$data['C3']}}사이트 바로가기</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:60px 20px 140px 20px; border-bottom:1px solid #e3e3e3; background-image:url(images/bg.png); background-position:right bottom; background-repeat:no-repeat;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td style="word-break:break-word;">
                        <h1 style="margin:0; margin-left:-10px; padding:0; color:#212121; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:74px; font-weight:300; letter-spacing:-2px; line-height:1.2; word-break: break-word;">
                            <strong>구매하신 내역</strong>을<br/> 확인해 주세요!</h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:30px; color:#666; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:16px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <p style="margin:0; padding:0;">
                            <strong>{{$data['C11']}}님</strong> {{$data['C3']}}에서 주문하신 <strong>구매내역</strong>을
                            안내해드립니다.<br/>
                            <em style="display:block; margin-top:6px; font-size:14px; font-style:normal; ">(쿠폰번호 SMS 전송
                                및 배송상태 확인은 <a href="{{$data['C12']}}" style="color:inherit; font-weight:bold;">마이페이지</a>에서
                                가능합니다)</em>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:80px; border-bottom:1px dashed #ddd;">
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 0; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:16px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <h5 style="margin:0; margin-bottom: 10px; font-size:18px; color:#4a4a4a; font-weight:bold">구매
                            정보</h5>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="border-top:1px solid #333; font-size:14px;">
                            <thead>
                            <tr>
                                <th style="padding:8px 5px; background:#f6f6f6; border-bottom:1px solid #ddd;">상품명</th>
                                <th style="padding:8px 5px; background:#f6f6f6; border-bottom:1px solid #ddd;">가격</th>
                                <th style="padding:8px 5px; background:#f6f6f6; border-bottom:1px solid #ddd;">옵션</th>
                                <th style="padding:8px 5px; background:#f6f6f6; border-bottom:1px solid #ddd;">수량</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['C50'] ?? [] as $sorderBd)
                                <tr>
                                    <td style="padding:8px 5px; border-bottom:1px solid #ddd; color:#666; text-align:center;">{{ $sorderBd['C4'] }}</td>
                                    <td style="padding:8px 5px; border-bottom:1px solid #ddd; color:#666; text-align:center;">{{ number_format($sorderBd['C6']) }}
                                        원
                                    </td>
                                    <td style="padding:8px 5px; border-bottom:1px solid #ddd; color:#666; text-align:center;">{{ $sorderBd['C5'] }}</td>
                                    <td style="padding:8px 5px; border-bottom:1px solid #ddd; color:#666; text-align:center;">{{ (int)$sorderBd['C7'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:20px; border-bottom:1px dashed #ddd;">
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:60px; color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <h5 style="margin:0; margin-bottom:5px; font-size:18px; color:#4a4a4a; font-weight:bold">결제
                            정보</h5>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="border-top:1px solid #333; font-size:14px; color:#666;">
                            <tr>
                                <th style="padding:8px 5px; text-align:left; color:#525252;">주문금액</th>
                                <td style="padding:8px 5px; text-align:left; font-weight:bold; color:#b54439; font-size:18px;">{{$data['C13']}}
                                    원
                                </td>
                            </tr>
                            <tr>
                                <th style="padding:8px 5px; border-bottom:1px solid #ddd; text-align:left; color:#525252;">
                                    결제방법
                                </th>
                                <td style="padding:8px 5px; border-bottom:1px solid #ddd; text-align:left;">{{DataConverter::execute($data['C14'], "paymethod('sorder')")}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:60px; color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <h5 style="margin:0; margin-bottom:5px; font-size:18px; color:#4a4a4a; font-weight:bold">받는사람
                            정보</h5>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="border-top:1px solid #333; font-size:14px; color:#666;">
                            <tr>
                                <th style="padding:8px 5px; text-align:left; color:#525252;">받으시는 분(연락처)</th>
                                <td style="padding:8px 5px; text-align:left;">{{$data['C15']}}</td>
                            </tr>
                            <tr>
                                <th style="padding:8px 5px; border-bottom:1px solid #ddd; text-align:left; color:#525252;">
                                    주소
                                </th>
                                <td style="padding:8px 5px; border-bottom:1px solid #ddd; text-align:left;">{{$data['C16']}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding:80px 0; text-align:center;">
                        <a href="{{$data['C17']}}"
                           style="margin:0 5px; display:inline-block; width:220px; padding:15px; background-color:#0f0f3c; border-radius:50px; border:none; font-size:18px; font-family:'Roboto', 'Noto Sans KR', sans-serif; color: #ffffff; text-decoration: none; font-weight:700; text-align:center;"
                           target="_blank">{{$data['C3']}} 상품보기</a>
                        <a href="{{$data['C18']}}"
                           style="margin:0 5px; display:inline-block; width:220px; padding:15px; background-color:#0f0f3c; border-radius:50px; border:none; font-size:18px; font-family:'Roboto', 'Noto Sans KR', sans-serif; color: #ffffff; text-decoration: none; font-weight:700; text-align:center;"
                           target="_blank">구매 상세정보 확인</a>
                    </td>
                </tr>
                <tr>
                    <td style="color:#787878; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <ul style="padding-left:16px; font-size:14px; color:#787878;">
                            <li>자세한 구매내역은 <a href="#" style="color:#365e87;">마이페이지>구매내역</a>에서 확인하실 수 있습니다.</li>
                            <li>궁금하신 점은 {{$data['C3']}}고객센터(tel.000-0000-0000)로 전화주시거나 <a href="#"
                                                                                          style="color:#365e87;">마이페이지>고객센터</a>를
                                이용해 주시기 바랍니다.
                            </li>
                            <li style="color:#b38c5c;">{{$data['C3']}}고객센터 운영시간 : 365일 24시간 운영</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:20px; background-color:#f8f8f8; font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:18px; font-weight:400; line-height:1.6; word-break: break-word;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="font-size:12px; color:#666;">
                            <tr>
                                <td width="50%" style="padding:20px; vertical-align:top">
                                    <h4 style="margin: 0; margin-bottom: 10px; font-size:14px; color:#333;">채무 지급보증 서비스
                                        이용</h4>
                                    고객님께서 현금 결제한 금액에 대해 당사는 우리은행과 채무 지급보증계약을 체결하여 안전거래를 보장하고 있습니다. 채무 지급보증 서비스는 고객님께서
                                    선불로 입금하신 주문에 대해 {{$data['C3']}}이 대금 환급 의무와 상품 공급을 불이행함으로써 발생하는 피해를 우리은행이 보증하는
                                    서비스입니다.
                                    <h4 style="margin-bottom: 10px; font-size:14px; color:#333;">상품의 교환/반품 안내</h4>
                                    <h5 style="margin:3px 0; font-size:12px; color:#333;">구매 후 교환/반품 방법 안내</h5>
                                    <ul style="padding-left:16px;">
                                        <li>배송상품의 교환/반품 신청은 상품 수령 후 7일 이내 요청 가능합니다.</li>
                                        <li>구매자의 단순변심에 의한 교환/반품에 따른 배송비(교환의 경우 왕복배송비)는 구매자가 부담합니다.</li>
                                        <li>무료배송 상품인 경우 반품시, 최초 배송료를 포함한 왕복 배송비가 부과될 수 있습니다.</li>
                                        <li>도서/산간지역 및 주문제작, 설치 상품 등의 경우, 기본 배송료 외에 반품시 추가 배송료가 발생될 수 있습니다.</li>
                                        <li>상품의 불량 및 오배송의 사유가 있는 경우에는 상품 수령 후 3개월 이내 또는 그 사실을 알 수 있었던 날로부터 30일 이내에 요청하실
                                            수 있습니다.
                                        </li>
                                        <li>상품의 불량 및 오배송의 사유로 발생되는 교환/반품의 배송비용은 판매자가 부담합니다.</li>
                                    </ul>
                                    <h5 style="margin:3px 0; font-size:12px; color:#333;">교환/반품 불가 사유</h5>
                                    <ul style="padding-left:16px;">
                                        <li>아래의 사유에는 상품의 교환/반품이 불가합니다.</li>
                                        <li>단순변심으로 상품 수령 후, 교환/반품 가능기간 7일을 초과한 경우</li>
                                        <li>상품의 택(TAG) 제거/라벨 및 상품 훼손으로 상품의 가치가 현저히 감소된 경우 (예: 의류/잡화/수입명품 등)</li>
                                        <li>상품 및 구성품을 분실하였거나 취급 부주의로 인한 파손/고장/오염된 경우</li>
                                        <li>고객님의 사용, 시간경과, 일부 소비에 의하여 상품의 가치가 현저히 감소한 경우 (예: 계절상품, 식품, 화장품 등)</li>
                                        <li>가전 및 설치 상품의 경우 상품포장을 개봉하여 설치 또는 사용한 경우</li>
                                        <li>주문 확인 후 상품제작이 들어가는 주문제작상품 또는 고객님의 요청에 의해 상품사양이 변경된 경우(제작이 시작된 이후에는 취소 및
                                            교환/반품이 불가합니다.)
                                        </li>
                                        <li>제품을 개봉하여 장착한 이후 단순변심의 경우 (예: 자동차용품 등)</li>
                                        <li>복제가 가능한 상품의 포장 등을 훼손한 경우 (예: CD/DVD/GAME/BOOK 등)</li>
                                        <li>상품의 시리얼 넘버 유출로 내장된 소프트웨어의 가치가 감소한 경우 (예: 네비게이션, CS시리얼이 적힌 PMP, 노트북, 데스크탑PC
                                            등)
                                        </li>
                                    </ul>
                                </td>
                                <td width="50%" style="padding:20px; vertical-align:top">
                                    <h5 style="margin:3px 0; font-size:12px; color:#333;">교환/반품 참고사항</h5>
                                    <ul style="padding-left:16px;">
                                        <li>모니터 해상도의 차이로 인해 색상이나 이미지가 실제와 다를 수 있으며, 이로 인한 교환/반품은 제한 될 수 있습니다.</li>
                                        <li>일부 상품의 경우, 제조사의 사정(신모델 출시 등) 및 부품 가격변동 등에 의해 가격이 변동될 수 있으며, 이로 인한 반품 및 가격보상은
                                            불가합니다.
                                        </li>
                                        <li>교환/반품시 고객님의 귀책사유로 인해 수거가 지연될 경우에는 반품이 제한 될 수 있습니다.</li>
                                        <li>명품은 택(TAG) 제거 후에는 반품이 불가합니다.</li>
                                        <li>일부 세트 상품의 부분 교환 및 반품이 불가합니다.</li>
                                        <li>홀로그램 등을 분리, 분실, 훼손하여 상품의 가치가 현저히 감소하여 재판매가 불가할 경우, 교환/반품이 제한될 수 있습니다.</li>
                                        <li>수입 제품의 경우 A/S가 불가합니다.</li>
                                        <li>일부상품은 트러블(알러지, 붉은 반점, 가려움, 따가움) 발생시 진료확인서 및 소견서를 증빙하셔야 환불이 가능합니다. 이 경우, 기타
                                            제반비용은 고객님께서 부담하셔야 합니다.
                                        </li>
                                    </ul>
                                    <h5 style="margin:3px 0; font-size:12px; color:#333;">청약철회의 효력</h5>
                                    <ul style="padding-left:16px;">
                                        <li>고객님으로부터 쿠폰 취소 또는 상품 등을 반환받은 경우, 영업일 3일 이내에 이미 지급받은 대금을 환급합니다.</li>
                                        <li>이 경우, 당사가 고객님께 재화 등의 환급을 지연할 때에는 그 지연기간에 대하여 공정거래위원회가 정하여 고시하는 지연 이자율을 곱하여
                                            산정한 지연이자를 지급합니다.
                                        </li>
                                        <li>고객님께서 취소/교환/반품을 요청하는 경우, 회사는 그 처리 결과를 전자우편주소나 SMS를 통해 통지합니다.</li>
                                        <li>기타 당사의 약관이나 이용안내에 규정되지 않은 취소 및 환불에 대한 사항에 대해서는 소비자 피해보상규정에서 정한 바에 따릅니다.</li>
                                    </ul>
                                    <h5 style="margin:3px 0; font-size:12px; color:#333;">소비자피해보상의 처리, 재화등에 대한 불만 처리 및
                                        소비자와 사업자 사이의 분쟁 처리에 관한 사항</h5>
                                    <ul style="padding-left:16px;">
                                        <li>소비자 피해보상 및 불만 신청: {{$data['C3']}} 고객센터 1577-7011, 1:1 문의</li>
                                        <li>고객님께서 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위해서 피해 보상처리 기구를 설치, 운영합니다.</li>
                                        <li>당사는 고객님으로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만 신속한 처리가 곤란한 경우에는 고객님께 그
                                            사유와 처리 일정을 즉시 통보합니다.
                                        </li>
                                        <li>소비자 피해 분쟁 조정: 공정거래위원회 및 공정거래 위원회가 지정한 분쟁 조정기구</li>
                                    </ul>
                                    <p style="padding:10px; background-color:#ebeaea;">
                                        - 거래약관 : 이용약관 참조<br/>
                                        - 취소/교환/반품 문의:{{$data['C3']}} 고객센터 (000-0000-0000)
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" style="padding:30px 10px;">
                <tbody>
                <tr>
                    <td style="font-family:'Roboto', 'Noto Sans KR', sans-serif; font-size:13px; font-weight:300; color:#939393; word-break:break-all; ">
                        {!!$data['C4']!!}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
