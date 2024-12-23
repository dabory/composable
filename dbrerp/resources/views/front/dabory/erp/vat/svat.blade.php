@extends('layouts.master')
@section('content')
<div class="mb-1 pt-2 text-right">
    <button type="button" hidden
            class="btn btn-success btn-open-modal window item-modal-btn"
            data-target="item"
            data-clicked="Btype.get_item_id"
            data-variable="itemModal">
    </button>
    <button type="button"
            class="btn btn-success btn-open-modal"
            data-target="slip"
            data-clicked="Btype.fetch_slip_form_book"
            data-variable="svatModal">
        <i class="icon-folder-open"></i>
    </button>

    <button type="button" class="btn btn-sm btn-primary save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary svat-act save-button" data-value="save" {{ $formB['FormVars']['Hidden']['SaveButton'] }}>
            {{ $formB['FormVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formB['HeadSelectOptions'],
            'eventClassName' => 'svat-act',
        ])
    </div>
</div>

<div id="svat-form">
    <div class="taxbill taxbill_sales" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="select_type">
                        <div>
                            <input type="radio" name="TaxType" id="TaxType1" value="1" checked
                                   @change="taxTypeChange($event)">
                            <label for="TaxType1">과세(10%)</label>
                        </div>
                        <div>
                            <input type="radio" name="TaxType" id="TaxType2" value="2"
                                   @change="taxTypeChange($event)">
                            <label for="TaxType2">영세(0%)</label>
                        </div>
                        <div>
                            <input type="radio" name="TaxType" id="TaxType3" value="3"
                                   @change="taxTypeChange($event)">
                            <label for="TaxType3">면세(세액없음)</label>
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
                                    <dd><input type="text"></dd>
                                </dl>
                                <dl>
                                    <dt>일련번호</dt>
                                    <dd><div class="col-12 d-flex p-0">
                                            <button id="auto-slip-no-btn" class="btn-dark border-white overflow-hidden col-3 text-center text-white text-nowrap radius-r0"
                                                    @click="getLastSlipNo(this)">
                                                <span class="icon-cogs"></span>
                                            </button>
                                            <input type="text" id="auto-slip-no-txt" class="w-100 radius-l0" autocomplete="off" disabled>
                                        </div></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row row2">
                            <div class="provider">
                                <table>
                                    <tr>
                                        <th rowspan="7">공급자</th>
                                    </tr>
                                    <tr class="tr_reginum">
                                        <td class="td_head">등록번호</td>
                                        <td colspan="3"><input type="text" v-model="invoicerParty['InvoicerCorpNum']"></td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">상호<br/>(법인명)</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerCorpName']">
                                        </td>
                                        <td class="td_head w-s">성명</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerCEOName']">
                                        </td>
                                    </tr>
                                    <tr class="tr_address">
                                        <td class="td_head">사업장<br/>주소</td>
                                        <td colspan="3">
                                            <input type="text" v-model="invoicerParty['InvoicerAddr']">
                                        </td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">업태</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerBizType']">
                                        </td>
                                        <td class="td_head w-s">종목</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerBizClass']">
                                        </td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">담당자</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerContactName1']">
                                        </td>
                                        <td class="td_head w-s">연락처</td>
                                        <td>
                                            <input type="text" v-model="invoicerParty['InvoicerTEL1']">
                                        </td>
                                    </tr>
                                    <tr class="tr_address">
                                        <td class="td_head">이메일</td>
                                        <td colspan="3">
                                            <input type="text" v-model="invoicerParty['InvoicerEmail1']">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="supplier">
                                <table>
                                    <tr>
                                        <th rowspan="7">공급받는자</th>
                                    </tr>
                                    <tr class="tr_reginum">
                                        <td class="td_head">등록번호</td>
                                        <td colspan="3"><input type="text" v-model="invoiceeParty['InvoicerCorpNum']"></td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">상호<br/>(법인명) <span class="mark">*</span></td>
                                        <td>
                                            <span class="search_box">
                                                <input type="text" v-model="invoiceeParty['InvoicerCorpName']">
                                                <button type="button" class="btn window company-modal-btn btn-open-modal"
                                                        data-target="company"
                                                        data-clicked="get_override_supplier_id"
                                                        data-variable="companyModal">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </span>
                                        </td>
                                        <td class="td_head w-s">성명</td>
                                        <td>
                                            <input type="text" v-model="invoiceeParty['InvoicerCEOName']">
                                        </td>
                                    </tr>
                                    <tr class="tr_address">
                                        <td class="td_head">사업장<br/>주소</td>
                                        <td colspan="3">
                                            <input type="text" v-model="invoiceeParty['InvoicerAddr']">
                                        </td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">업태</td>
                                        <td>
                                            <input type="text" v-model="invoiceeParty['InvoicerBizType']">
                                        </td>
                                        <td class="td_head w-s">종목</td>
                                        <td>
                                            <input type="text" v-model="invoiceeParty['InvoicerBizClass']">
                                        </td>
                                    </tr>
                                    <tr class="tr_name">
                                        <td class="td_head">담당자</td>
                                        <td>
                                            <input type="text" v-model="invoiceeParty['InvoicerContactName1']">
                                        </td>
                                        <td class="td_head w-s">연락처</td>
                                        <td>
                                            <input type="text" v-model="invoiceeParty['InvoicerTEL1']">
                                        </td>
                                    </tr>
                                    <tr class="tr_address">
                                        <td class="td_head">이메일</td>
                                        <td colspan="3">
                                            <input type="text" v-model="invoiceeParty['InvoicerEmail1']">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row row3">
                            <dl class="date">
                                <dt>작성일자<span class="mark">*</span></dt>
                                <dd>
                                    <input class="overflow-hidden text-nowrap start-date" type="date" v-model="writeDT">
                                </dd>
                            </dl>
                            <dl class="price">
                                <dt>공급가액<span class="mark">*</span></dt>
                                <dd><input type="text" :value="format_decimal(amountTotal, 0)" disabled></dd>
                            </dl>
                            <dl class="tax">
                                <dt>세액</dt>
                                <dd><input type="text" :value="format_decimal(taxTotal, 0)" disabled></dd>
                            </dl>
                            <dl class="etc">
                                <dt>합계금액</dt>
                                <dd>
                                    <input type="text" :value="format_decimal(amountTotal + taxTotal, 0)" disabled>
                                </dd>
                            </dl>
                        </div>
                        <div class="row row4 w-100">
                            <table id="items-table" class="w-100">
                                <thead class="w-100">
                                    <tr class="w-100">
                                        <th>
                                        </th>
                                        <th>월일<span class="mark">*</span></th>
                                        <th>품목<span class="mark">*</span></th>
                                        <th>규격</th>
                                        <th>수량<span class="mark">*</span></th>
                                        <th>단가<span class="mark">*</span></th>
                                        <th>공급가액<span class="mark">*</span></th>
                                        <th :class="taxType1 === '3'  ? 'd-none': ''">세액</th>
                                        <th>
                                            <button @click="addItem"><i class="fas fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="w-100">
                                    <tr v-for="(item, index) in taxInvoiceTradeLineItems" class="w-100">
                                        <td class="td_note" style="width: 64px;">
                                            <button class="mr-1" id="down-btn" :disabled="upDownDisabled"
                                                    @click="seqNoUpDown('down', index)">
                                                ▼
                                            </button>
                                            <button id="up-btn" :disabled="upDownDisabled"
                                                    @click="seqNoUpDown('up', index)">
                                                ▲
                                            </button>
                                        </td>
                                        <td class="td_date">
                                            <input class="overflow-hidden text-nowrap start-date" type="date"
                                                   v-model="item['PurchaseExpiry']">
                                        </td>
                                        <td @keydown="showItemModal(event, index)" class="td_subject">
                                            <input type="text" v-model="item['Name']">
                                        </td>
                                        <td class="td_size" @keydown="handleEnterPressedinTabCell">
                                            <input type="text" v-model="item['Information']">
                                        </td>
                                        <td class="td_amount" @keydown="handleEnterPressedinTabCell">
                                            <input type="text" v-model="item['ChargeableUnit']"
                                                @change="changeField(index, 'ChargeableUnit')">
                                        </td>
                                        <td @keydown="handleEnterPressedinTabCell">
                                            <input type="text"
                                                   :value="format_decimal(item['UnitPrice'], 0)"
                                                   @change="setFieldData(index, 'UnitPrice')">
                                        </td>
                                        <td @keydown="handleEnterPressedinTabCell">
                                            <input type="text"
                                                   :value="format_decimal(item['Amount'], 0)"
                                                   @change="setFieldData(index, 'Amount')">
                                        </td>
                                        <td @keydown="handleEnterPressedinTabCell" :class="taxType1 === '3'  ? 'd-none': ''">
                                            <input type="text"
                                                   :value="format_decimal(item['Tax'], 0)"
                                                   @change="setFieldData(index, 'Tax')"
                                                   :disabled="taxType1 === '2'">
                                        </td>
                                        <td class="td_note">
                                            <button @click="removeItem(index)"><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="row row5">
                            <div class="sum">
{{--                                <dl>--}}
{{--                                    <dt>합계금액</dt>--}}
{{--                                    <dd><input type="text" :value="amountTotal + taxTotal" disabled></dd>--}}
{{--                                </dl>--}}
                                <dl>
                                    <dt>현금</dt>
                                    <dd></dd>
                                </dl>
                                <dl>
                                    <dt>수표</dt>
                                    <dd></dd>
                                </dl>
                                <dl>
                                    <dt>어음</dt>
                                    <dd></dd>
                                </dl>
                                <dl>
                                    <dt>외상미수금</dt>
                                    <dd></dd>
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
                        <strong>영업부서</strong>
                        <div class="input-group mr-2">
                            <select id="sgroup-id-select">
                            </select>
                        </div>

                        <strong>거래유형</strong>
                        <div class="input-group">
                            <select name="" id="">
                                <option value="0">상품매출</option>
                                <option value="1">매출환입및에누리_상품매출</option>
                            </select>
{{--                            <input type="text" class="form-control">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"></button>--}}
{{--                                <div class="dropdown-menu  dropdown-menu-right">--}}
{{--                                    <dl>--}}
{{--                                        <dt class="li_head">상품매출</dt>--}}
{{--                                        <dd>상품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출환입및에누리_상품매출</dt>--}}
{{--                                        <dd>매출환입및에누리_상품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출할인_상품매출</dt>--}}
{{--                                        <dd>매출할인_상품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>제품매출</dt>--}}
{{--                                        <dd>제품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출환입및에누리_제품매출</dt>--}}
{{--                                        <dd>매출환입및에누리_제품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출할인_제품매출</dt>--}}
{{--                                        <dd>매출할인_제품매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>공사수입금</dt>--}}
{{--                                        <dd>공사수입금</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출할인_공사수입금</dt>--}}
{{--                                        <dd>매출할인_공사수입금</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>완성건물매출</dt>--}}
{{--                                        <dd>완성건물매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>매출할인_완성건물매출</dt>--}}
{{--                                        <dd>매출할인_완성건물매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>임대료수입</dt>--}}
{{--                                        <dd>임대료수입</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>용역매출</dt>--}}
{{--                                        <dd>용역매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>기타매출</dt>--}}
{{--                                        <dd>기타매출</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>서비스수입</dt>--}}
{{--                                        <dd>서비스수입</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>운송료수입</dt>--}}
{{--                                        <dd>운송료수입</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>임대료</dt>--}}
{{--                                        <dd>임대료</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>수수료수입</dt>--}}
{{--                                        <dd>수수료수입</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>수수료수익</dt>--}}
{{--                                        <dd>수수료수익</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>유형자산처분이익</dt>--}}
{{--                                        <dd>유형자산처분이익</dd>--}}
{{--                                    </dl>--}}
{{--                                    <dl>--}}
{{--                                        <dt>잡이익</dt>--}}
{{--                                        <dd>잡이익</dd>--}}
{{--                                    </dl>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                </div>
{{--                <div class="modal-footer">--}}
{{--                    <dl>--}}
{{--                        <dt>공급받는자 담당자<span class="mark">*</span></dt>--}}
{{--                        <dd>--}}
{{--                            <select>--}}
{{--                                <option>담당자이름abcdefg@hijklmn.com</option>--}}
{{--                            </select>--}}
{{--                            <button type="button" class="btn btn-gray" data-toggle="modal" data-target=".pop_addpic"><i class="fas fa-plus"></i></button>--}}
{{--                        </dd>--}}
{{--                    </dl>--}}
{{--                    <dl>--}}
{{--                        <dt>전송유형<span class="mark">*</span></dt>--}}
{{--                        <dd>--}}
{{--                            <select>--}}
{{--                                <option>즉시전송</option>--}}
{{--                                <option>익일전송</option>--}}
{{--                            </select>--}}
{{--                        </dd>--}}
{{--                    </dl>--}}
{{--                    <div class="btn_wrap">--}}
{{--                        <button type="button" class="btn btn-primary">저장</button>--}}
{{--                        <button type="button" class="btn btn-outline-indigo">취소</button>--}}
{{--                        <button type="button" class="btn btn-outline-indigo">발행</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
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


    <!-- 담당자추가 팝업 -->
    <div class="modal fade taxbil_popup pop_addpic" id="popup_addpic" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">담당자 추가</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="result_list">
                        <h3>등록된 담당자</h3>
                        <table>
                            <tr>
                                <th>담당자명</th>
                                <th>부서</th>
                                <th>이메일</th>
                            </tr>
                            <tr>
                                <td>세금계산서</td>
                                <td>부서이름</td>
                                <td>abcdefg@hijklm.com</td>
                            </tr>
                        </table>
                    </div>
                    <div class="add_form">
                        <ul>
                            <li>
                                <label>담당자명<span class="mark">*</span></label>
                                <input type="text">
                            </li>
                            <li>
                                <label>직위</label>
                                <input type="text">
                            </li>
                            <li>
                                <label>부서</label>
                                <input type="text">
                            </li>
                            <li>
                                <label>전화번호</label>
                                <input type="text">
                            </li>
                            <li>
                                <label>이메일<span class="mark">*</span></label>
                                <input type="text">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">저장</button>
                    <button type="button" class="btn btn-outline-indigo">취소</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $svatModal])
    @include('front.outline.static.company', ['moealSetFile' => $companyModal])
    @include('front.outline.static.item', ['moealSetFile' => $itemModal])
@endsection

@once
@push('js')
<script src="{{ csset('/js/modals-controller/b-type/common.js') }}"></script>
    <script>
        const svat = new Vue({
            el: '#svat-form',

            data: function () {
                return {
                    id: 0,
                    taxType1: '1',
                    formB: @json($formB),
                    selectedTdIndex: null,
                    upDownDisabled: false,
                    writeDT: moment().format('YYYY-MM-DD'),
                    taxInvoiceTradeLineItems: [
                        {
                            Id: 0,
                            ItemId: 0,
                            PurchaseExpiry: moment().format('YYYY-MM-DD'),
                            Name: '',
                            Information: '',
                            ChargeableUnit: '',
                            UnitPrice: '',
                            Amount: '',
                            Tax: '',
                            Description: '',
                        }
                    ],
                    invoicerParty: {
                        InvoicerCorpNum: '',
                        InvoicerCorpName: '',
                        InvoicerCEOName: '',
                        InvoicerAddr: '',
                        InvoicerBizType: '',
                        InvoicerBizClass: '',
                        InvoicerContactName1: '',
                        InvoicerTEL1: '',
                        InvoicerEmail1: '',
                    },
                    invoiceeParty: {
                        BuyerId: 0,
                        InvoicerCorpNum: '',
                        InvoicerCorpName: '',
                        InvoicerCEOName: '',
                        InvoicerAddr: '',
                        InvoicerBizType: '',
                        InvoicerBizClass: '',
                        InvoicerContactName1: '',
                        InvoicerTEL1: '',
                        InvoicerEmail1: '',
                    }
                };
            },

            computed: {
                amountTotal: function() {
                    return this.taxInvoiceTradeLineItems.reduce(function (previousValue, item) {
                        return previousValue + Number(item['Amount'])
                    }, 0)
                },

                taxTotal: function() {
                    return this.taxInvoiceTradeLineItems.reduce(function (previousValue, item) {
                        return previousValue + Number(item['Tax'])
                    }, 0)
                }
            },

            async mounted () {
                $('.svat-act').on('click', (event) => {
                    switch( $(event.target).data('value') ) {
                        case 'save': this.actSave(); break;
                        case 'save-and-new': this.actSaveAndNew(); break;
                        case 'new': this.actNew(); break;
                        case 'delete': this.actDelete(); break;
                    }
                });


                this.setupGet()

                const data = await Btype.get_slip_form_init('vat/svat')
                await Btype.create_sgroup_select_box_options(data.SgroupPage)

                activate_button_group()
            },

            methods: {
                seqNoUpDown: async function (move, fromIndex) {
                    if (this.taxInvoiceTradeLineItems[0]['Id'] === 0 && this.taxInvoiceTradeLineItems.length === 1) {
                        return
                    }
                    this.taxInvoiceTradeLineItems = this.taxInvoiceTradeLineItems.filter(item => item['Id'] !== 0)

                    if (isEmpty(this.taxInvoiceTradeLineItems) || this.id === 0) {
                        return iziToast.error({
                            title: 'Error',
                            message: @json(_e('Can NOT move UP or DOWN in the status'))
                        })
                    }

                    const data = {
                        BdTableName: 'dbr_svat_bd',
                        HdIdName: 'svat_id',
                        HdId: Number(this.id),
                        CurrId: Number(this.taxInvoiceTradeLineItems[fromIndex]['Id']),
                        Move: move,
                    }

                    this.upDownDisabled = true
                    const response = await get_api_data('seq-no-up-down', data)
                    console.log(response)
                    this.upDownDisabled = false
                    if (! isEmpty(response.data['apiStatus'])) {
                        return iziToast.error({
                            title: 'Error',
                            message: $('#action-failed').text(),
                        })
                    }

                    const toIndex = (move === 'up' ? -1 : 1);

                    const item = this.taxInvoiceTradeLineItems.splice(fromIndex, 1)[0];
                    this.taxInvoiceTradeLineItems.splice(fromIndex + toIndex, 0, item);
                },

                setupGet: async function () {
                    const response = await get_api_data('setup-get', {
                        'SetupCode': 'office-info'
                    })
                    const officeInfo = response.data

                    this.invoicerParty['InvoicerCorpNum'] = officeInfo['OfcTaxNo']
                    this.invoicerParty['InvoicerCorpName'] = officeInfo['OfcName']
                    this.invoicerParty['InvoicerAddr'] = officeInfo['OfcAddress']
                    this.invoicerParty['InvoicerTEL1'] = officeInfo['OfcTelNo']
                    this.invoicerParty['InvoicerEmail1'] = officeInfo['OfcEmail']
                    this.invoicerParty['InvoicerCEOName'] = officeInfo['OfcPresident']
                    this.invoicerParty['InvoicerContactName1'] = officeInfo['OfcPresident']
                    this.invoicerParty['InvoicerBizType'] = officeInfo['OfcBizType']
                    this.invoicerParty['InvoicerBizClass'] = officeInfo['OfcDealItem']
                },

                taxTypeChange: function(event){
                    this.taxType1 = event.target.value
                    switch (this.taxType1) {
                        case '1':
                            this.setTaxRate()
                            break;
                        case '2':
                            this.setZeroTaxRate()
                            break;
                        case '3':
                            this.setZeroTaxRate()
                            break;
                    }
                },

                actNew: function() {
                    Btype.set_slip_no_btn_abled()
                    $('#auto-slip-no-txt').val('')

                    this.id = 0
                    this.taxType1 = '1'
                    this.selectedTdIndex = null
                    this.writeDT = moment().format('YYYY-MM-DD')
                    this.taxInvoiceTradeLineItems = [
                        {
                            Id: 0,
                            ItemId: 0,
                            PurchaseExpiry: moment().format('YYYY-MM-DD'),
                            Name: '',
                            Information: '',
                            ChargeableUnit: '',
                            UnitPrice: '',
                            Amount: '',
                            Tax: '',
                            Description: '',
                        }
                    ]
                    // this.invoicerParty = {
                    //     InvoicerCorpNum: '',
                    //     InvoicerCorpName: '',
                    //     InvoicerCEOName: '',
                    //     InvoicerAddr: '',
                    //     InvoicerBizType: '',
                    //     InvoicerBizClass: '',
                    //     InvoicerContactName1: '',
                    //     InvoicerTEL1: '',
                    //     InvoicerEmail1: '',
                    // }
                    this.invoiceeParty = {
                        BuyerId: 0,
                        InvoicerCorpNum: '',
                        InvoicerCorpName: '',
                        InvoicerCEOName: '',
                        InvoicerAddr: '',
                        InvoicerBizType: '',
                        InvoicerBizClass: '',
                        InvoicerContactName1: '',
                        InvoicerTEL1: '',
                        InvoicerEmail1: '',
                    }


                    // this.setupGet()
                },

                actBdDelete: function (id) {
                    console.log(id)
                },

                actSaveAndNew: async function() {
                    await this.actSave()
                    this.actNew()
                },

                actSave: async function () {
                    if (isEmpty($('#auto-slip-no-txt').val())) {
                        return iziToast.error({
                            title: 'Error',
                            message: '일련번호가 존재하지 않습니다',
                        });
                    }

                    $('.save-button').prop('disabled', true);
                    await this.svatAct()
                    await this.svatBdAct()
                    $('.save-button').prop('disabled', false);
                },

                setAsResponseId: function (id, value) {
                    if (value !== 0) {
                        return value;
                    }
                    return id
                },

                setTaxRate: function () {
                    this.taxInvoiceTradeLineItems = this.taxInvoiceTradeLineItems.map(item => {
                        return {...item, Tax: this.getVat(item['Amount'])}
                    })
                },

                setZeroTaxRate: function () {
                    this.taxInvoiceTradeLineItems = this.taxInvoiceTradeLineItems.map(item => {
                        return {...item, Tax: 0}
                    })
                },

                svatAct: async function () {
                    const response = await get_api_data(this.formB['General']['ActApi'], {
                        Page: [
                            {
                                Id: this.id,
                                BuyerId: Number(this.invoiceeParty['BuyerId']),
                                SvatNo: $('#auto-slip-no-txt').val(),
                                SgroupId: Number($('#sgroup-id-select').val()),
                                SvatDate: moment(new Date(this.writeDT)).format('YYYYMMDD'),
                                RecipientEmail: this.invoiceeParty['InvoicerEmail1']
                            }
                        ]
                    })

                    const page = response.data.Page

                    if (page) {
                        this.id = this.setAsResponseId(this.id, page[0]['Id'])
                    }
                },

                svatBdAct: async function () {
                    const seqNo = await Btype.get_last_seq_no('svat', $('#auto-slip-no-txt').val())

                    const data = this.taxInvoiceTradeLineItems.map((item, index) => {
                        return this.svatBdParameter(item, seqNo + index)
                    })

                    const response = await get_api_data('svat-bd-act', {
                        Page: data
                    })

                    const self = this
                    const page = response.data.Page
                    show_iziToast_msg(page, function () {
                        console.log(self.taxInvoiceTradeLineItems)
                        self.taxInvoiceTradeLineItems = self.taxInvoiceTradeLineItems.map((item, index) => {
                            return {...item, Id: self.setAsResponseId(self.setAsResponseId, page[index]['Id'])}
                        })
                    })
                },

                svatBdParameter: function (item, seqNo) {
                    return {
                        Id: item['Id'],
                        SvatId: this.id,
                        SeqNo: seqNo,
                        ItemId: Number(item['ItemId']),
                        AddItemName: item['Name'],
                        SvatQty: String(item['ChargeableUnit']),
                        SvatPrc: String(item['UnitPrice']),
                        SvatSupply: String(item['Amount']),
                        SvatVat: String(item['Tax']),
                        SvatSum: String( Number(item['Amount']) + Number(item['Tax']) ),
                    }
                },

                addItem: function () {
                    if (this.taxInvoiceTradeLineItems.length < 4) {
                        this.taxInvoiceTradeLineItems.push({
                            Id: 0,
                            ItemId: 0,
                            PurchaseExpiry: moment().format('YYYY-MM-DD'),
                            Name: '',
                            Information: '',
                            ChargeableUnit: '',
                            UnitPrice: '',
                            Amount: '',
                            Tax: '',
                            Description: '',
                        })
                    }
                },

                removeItem: function (index) {
                    if (this.taxInvoiceTradeLineItems[index]['Id'] === 0) {
                        if (this.taxInvoiceTradeLineItems.length <= 1) {
                            this.addItem()
                        }

                        return this.taxInvoiceTradeLineItems.splice(index, 1)
                    }

                    const self = this

                    confirm_message_shw_and_delete(async function() {
                        const response = await get_api_data('svat-bd-act', {
                            Page: [
                                { Id: Number(`-${self.taxInvoiceTradeLineItems[index]['Id']}`) }
                            ]
                        })

                        show_iziToast_msg(response.data, function () {
                            self.taxInvoiceTradeLineItems.splice(index, 1)
                            if (self.taxInvoiceTradeLineItems.length <= 1) {
                                self.addItem()
                            }
                        })
                    })
                },

                getLastSlipNo: async function () {
                    Btype.set_slip_no_btn_disabled()
                    const response = await Btype.get_last_slip_no('svat');
                    $('#auto-slip-no-txt').val(moment(new Date()).format('YYMMDD') + '-' + response.data.LastSlipNo)
                },

                setSupplier: function (company) {
                    this.invoiceeParty['BuyerId'] = company['Id']
                    this.invoiceeParty['InvoicerCorpNum'] = company['TaxNo']
                    this.invoiceeParty['InvoicerCorpName'] = company['CompanyName']
                    this.invoiceeParty['InvoicerCEOName'] = company['President']
                    this.invoiceeParty['InvoicerAddr'] = company['Addr1'] + ' ' + company['Addr2']
                    this.invoiceeParty['InvoicerBizType'] = company['BizType']
                    this.invoiceeParty['InvoicerBizClass'] = company['DealItem']
                    this.invoiceeParty['InvoicerContactName1'] = company['MainContact']
                    this.invoiceeParty['InvoicerTEL1'] = company['MobileNo']
                    this.invoiceeParty['InvoicerEmail1'] = company['Email']
                },

                updateVariable: function (val) {
                    console.log(val)
                },

                getVat: function (amount) {
                    return amount * 0.1;
                },

                changeField: function (index, field) {
                    if (field === 'Amount') {
                        this.taxInvoiceTradeLineItems[index]['Tax'] = this.getVat(this.taxInvoiceTradeLineItems[index]['Amount'])
                    } else if (field === 'ChargeableUnit' || field === 'UnitPrice') {
                        this.taxInvoiceTradeLineItems[index]['Amount'] = this.taxInvoiceTradeLineItems[index]['UnitPrice'] * this.taxInvoiceTradeLineItems[index]['ChargeableUnit']
                        this.taxInvoiceTradeLineItems[index]['Tax'] = this.getVat(this.taxInvoiceTradeLineItems[index]['Amount'])
                    }
                },

                setItem: function (item) {
                    const index = this.selectedTdIndex
                    this.taxInvoiceTradeLineItems[index]['ItemId'] = item['Id']
                    this.taxInvoiceTradeLineItems[index]['Name'] = item['ItemName']
                    this.taxInvoiceTradeLineItems[index]['Information'] = item['SubName']
                    this.taxInvoiceTradeLineItems[index]['ChargeableUnit'] = 1
                    this.taxInvoiceTradeLineItems[index]['UnitPrice'] = item['PurchPrc']
                    this.taxInvoiceTradeLineItems[index]['Amount'] = item['PurchPrc']
                    this.taxInvoiceTradeLineItems[index]['Tax'] = this.getVat(item['PurchPrc'])
                },

                showItemModal: function (event, index) {
                    this.selectedTdIndex = index
                    Btype.enterPressedinCell(event)
                },

                setFieldData: function (index, field) {
                    this.taxInvoiceTradeLineItems[index][field] = event.target.value

                    this.changeField(index, field)
                },

                handleEnterPressedinTabCell: function (event) {
                    if ((event.which && event.which == 13) || event.keyCode && event.keyCode == 13) {
                        const tr = $(event.target).closest('tr');
                        const index = $(event.target).closest('td').prevAll().length;

                        if (index === 6) {
                            $(tr).children(`td:eq(${index})`).find('input').blur();
                        }

                        $(tr).children(`td:eq(${index + 1})`).find('input').focus();
                        $(tr).children(`td:eq(${index + 1})`).find('input').select();
                    }
                },

                setUi: function (data) {
                    this.actNew()

                    const hdPpage = data.HdPage[0]
                    const bdPage = data.BdPage ?? []

                    const company = { ...hdPpage, Id: hdPpage['BuyerId'] }
                    this.setSupplier(company)

                    Btype.set_slip_no_btn_disabled()
                    $('#auto-slip-no-txt').val(hdPpage['SvatNo'])
                    $('#sgroup-id-select').val(hdPpage['SgroupId'])
                    this.writeDT = moment(to_date(hdPpage['SvatDate'])).format('YYYY-MM-DD')
                    this.invoiceeParty['InvoicerEmail1'] = hdPpage['RecipientEmail']
                    this.id = hdPpage['Id']

                    this.taxInvoiceTradeLineItems = bdPage.map(item => {
                        return {
                            Id: item['Id'],
                            ItemId: item['ItemId'],
                            PurchaseExpiry: '',
                            Name: item['AddItemName'],
                            Information: '',
                            ChargeableUnit: item['SvatQty'],
                            UnitPrice: item['SvatPrc'],
                            Amount: item['SvatSupply'],
                            Tax: item['SvatVat'],
                            Description: '',
                        }
                    })

                    $('#modal-slip').modal('hide')
                }
            }
        });

        function set_item_data_to_textbox(item) {
            svat.setItem(item)
            const tr = $(`#items-table tbody tr:eq(${svat.selectedTdIndex})`);
            return $(tr).children('td:eq(4)').find('input')
        }

        async function get_override_supplier_id(supplier_id) {
            const company = await get_supplier_id(supplier_id);
            svat.setSupplier(company);
        }

        function update_hd_ui(response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-slip').modal('hide');
                return;
            }

            svat.setUi(response.data)
        }


        const companyModal = {!! json_encode($companyModal) !!};
        const itemModal = {!! json_encode($itemModal) !!};
        const svatModal = {!! json_encode($svatModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
        var formB = {!! json_encode($formB) !!};
    </script>
@endpush
@endonce
