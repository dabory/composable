(function($) {
    $.fn.type1 = function(options) {}

    $.fn.type1.first_date_rang = function (first_date_search = true, requery = false) {
        const dom_val = $(this).find('.type1-date-navi-div')
        let date_input = $(dom_val).find('div').find('input:checked')
        $(dom_val).data('current_date', moment(new Date()).format('YYYY-MM-DD'))

        if (first_date_search) {
            date_input = $(dom_val).find('div').first().find('input')
            date_input.prop('checked', true)
        }

        return $.fn.type1.calc_date_rang.call(this, date_input.val(), 0, true, requery)
    }

    $.fn.type1.calc_date_rang = function (date_val, mode, first = false, requery = true) {
        const dom_val = $(this).find('.type1-date-navi-div')
        if (mode === 0) {
            if (! first) {
                $(dom_val).data('current_date', $(this).find('.type1-start-date').val())
            }
        }

        const [firDay, lasDay, currDay] = $.fn.date.rangeVendingMachine(
            date_val,
            $(dom_val).data('current_date'),
            mode
        );

        $(this).find('.type1-start-date').val(date_to_sting(firDay))
        $(this).find('.type1-end-date').val(date_to_sting(lasDay))
        $(dom_val).data('current_date', date_to_sting(currDay))

        if (requery) {
            $(this).find('.type1').trigger('list.requery')
        }
    }

    $.fn.type1.html = function() {
        const id = $(this).attr('id')
        const self = this

        $(document).on('click', `#${id} input:radio[name=type1-date-navi]`, function (event) {
            $.fn.type1.calc_date_rang.call(self, $(this).val(), 0)
        });

        $(document).on('click', `#${id} .type1-date-navi-btn`, function (event) {
            $.fn.type1.first_date_rang.call(self, false, true)
        });

        $(document).on('change', `#${id} .type1-start-date`, function (event) {
            $(self).find('.type1-date-navi-div').data('current_date', $(this).val())
        });

        $(document).on('click', `#${id} .type1-date-navi-prev-btn`, function (event) {
            $.fn.type1.calc_date_rang.call(self, $(self).find('input:radio[name=type1-date-navi]:checked').val(), -1)
        });
        $(document).on('click', `#${id} .type1-date-navi-next-btn`, function (event) {
            $.fn.type1.calc_date_rang.call(self, $(self).find('input:radio[name=type1-date-navi]:checked').val(), 1)
        });

        return `<div class="dabory-type1-box">

                <div class="dabory-type1-head d-flex">
                    <div class="dabory-type1-head-item">
                        <div class="dabory-type1-head-card">
                            <div class="dabory-type1-head-card-body">
                                <div class="dabory-type1-head-card-col">
                                    <div class="type1-date-navi-btn-group">
                                        <button class="type1-date-navi-prev-btn">
                                            ≪
                                        </button>
                                        <button class="type1-date-navi-btn">
                                            일자방향(오늘)
                                        </button>

                                        <button class="type1-date-navi-next-btn">
                                            ≫
                                        </button>
                                    </div>

                                    <div class="type1-date-navi-div" style="height: 28px;">
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="day" id="type1-date-navi-1">
                                            <label for="type1-date-navi-1" class="w-100 rounded overflow-hidden mr-0 text-nowrap">일
                                            </label>
                                        </div>
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="week" id="type1-date-navi-2">
                                            <label for="type1-date-navi-2" class="w-100 rounded overflow-hidden mr-0 text-nowrap">주
                                            </label>
                                        </div>
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="month" id="type1-date-navi-3">
                                            <label for="type1-date-navi-3" class="w-100 rounded overflow-hidden mr-0 text-nowrap">월
                                            </label>
                                        </div>
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="quarterly" id="type1-date-navi-4">
                                            <label for="type1-date-navi-4" class="w-100 rounded overflow-hidden mr-0 text-nowrap">분기
                                            </label>
                                        </div>
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="year" id="type1-date-navi-5">
                                            <label for="type1-date-navi-5" class="w-100 rounded overflow-hidden mr-0 text-nowrap">년
                                            </label>
                                        </div>
                                        <div class="type1-date-navi-col">
                                            <input autocomplete="off" name="type1-date-navi" type="radio" value="all" id="type1-date-navi-6">
                                            <label for="type1-date-navi-6" class="w-100 rounded overflow-hidden mr-0 text-nowrap">전체
                                            </label>
                                       </div>
                                    </div>

                                    <div class="type1-head-col">
                                        <label>날짜</label>
                                        <div class="d-flex">
                                            <input class="type1-start-date" type="date" value="1990-01-01">
                                            <button class="btn disabled p-1 text-center">~</button>
                                            <input class="type1-end-date" type="date" value="3000-12-31">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dabory-type1-head-item">
                        <div class="dabory-type1-head-card">
                            <div class="dabory-type1-head-card-body">
                            </div>
                        </div>
                    </div>

                    <div class="dabory-type1-head-item">
                        <div class="dabory-type1-head-card">
                            <div class="dabory-type1-head-card-body">
                                <div class="dabory-type1-head-card-col">
                                    <div class="type1-head-col">
                                        <label>조회선택</label>
                                        <div class="row">
                                            <div class="filter-name-div">
                                                <select class="filter-name-select" onchange="chagne_filter_name_select(this)">
                                                                                                            <option value="" data-reverse="">
                                                            =검색 조건=
                                                        </option>
                                                                                                            <option value="mx.setup_name" data-reverse="">
                                                            설정이름
                                                        </option>
                                                                                                            <option value="mx.setup_code" data-reverse="">
                                                            설정코드
                                                        </option>
                                                                                                            <option value="mx.brand_code" data-reverse="">
                                                            브랜드코드
                                                        </option>
                                                                                                            <option value="mx.parameter" data-reverse="">
                                                            파라메터
                                                        </option>
                                                                                                    </select>
                                            </div>
                                            <div class="filter-value-div">
                                                <input class="filter-value-txt" type="text" onkeydown="override_enter_pressed_auto_search(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="simple-filter-select-div">
                                        <label>설정분류</label>
                                        <select class="simple-filter-select">
                                                                                            <option value="">
                                                    ======대분류======
                                                </option>
                                                                                            <option value="mx.setup_type='common'">
                                                    공통
                                                </option>
                                                                                            <option value="mx.setup_type='erp'">
                                                    ERP/백오피스
                                                </option>
                                                                                            <option value="mx.setup_type='shop'">
                                                    쇼핑몰
                                                </option>
                                                                                            <option value="mx.setup_type='member'">
                                                    회원/사용자
                                                </option>
                                                                                            <option value="mx.setup_type='pro'">
                                                    홈페이지/프론트오피스
                                                </option>
                                                                                            <option value="">
                                                    ======상세분류======
                                                </option>
                                                                                            <option value="mx.setup_code='slip-common'">
                                                    공통-전표입력
                                                </option>
                                                                                            <option value="mx.setup_code='media-body'">
                                                    공통-미디어라이브러리
                                                </option>
                                                                                            <option value="mx.setup_code='shipping-charge'">
                                                    쇼핑몰-배송비
                                                </option>
                                                                                            <option value="mx.setup_code='courier'">
                                                    쇼핑몰-택배회사
                                                </option>
                                                                                            <option value="mx.setup_code='remit-account'">
                                                    쇼핑몰-무통장입금계좌
                                                </option>
                                                                                            <option value="mx.setup_code='shop-address'">
                                                    쇼핑몰-관련주소
                                                </option>
                                                                                            <option value="mx.setup_code='sso-client'">
                                                    회원-SSO 클라이언트
                                                </option>
                                                                                    </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dabory-type1-body">
                    <div class="dabory-type1-responsive" style="height: 386px">
                        <table class="dabory-type1-table" style="min-width: 1024px; table-layout: fixed;">
                        <thead class="dabory-type1-table-head">
                            <th style="width:3%;"></th>
                            <th style="width:2%;">번호</th>
                            <th style="width:5%;">설정이름</th>
                            <th style="width:4%;">설정코드</th>
                            <th style="width:4%;">순서</th>
                            <th style="width:4%;">브랜드코드</th>
                            <th style="width:4%;">컴포넌트</th>
                            <th style="width:4%;">파라메터</th>
                            <th style="width:4%;">사용</th>
                            <th style="width:4%;">기본적용</th>
                            <th style="width:4%;">설정 Json</th>
                        </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="dabory-table-option-wrapper">
                        ${$.fn.table.lineSelect()}
                        ${$.fn.table.orderBySelect()}
                        <ul class="dabory-table-pagination">
                            ${$.fn.table.makePagination(10, 1, 1)}
                        </ul>
                    </div>

                </div>
            </div>`
    }

}(jQuery));
