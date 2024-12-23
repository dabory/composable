(function($) {
    $.fn.review = async function(options) {
        const opts = $.extend({}, $.fn.review.defaults, options)

        this.append(html.call(this, opts, ''))
        loadModule.call(this)

        callApi.call(this)
    };

    function callApi(limit = 10, offset = 0, page = 1) {
        const self = this

        $.fn.dataLinker.api23Js('list-type1-page', {
            "QueryVars": {
                "QueryName": "setup-input",
            },
            "PageVars": {
                "Limit": limit,
                "Offset": offset
            },
            "ListType1Vars": {
                "FilterDate": "",
                "StartDate": moment(new Date($(self).find('.type1-start-date').val())).format('YYYYMMDD'),
                "EndDate": moment(new Date($(self).find('.type1-end-date').val())).format('YYYYMMDD'),
                "OrderBy": $(self).find('.dabory-table-order-by-select').val()
            }
        }, function (response) {
            const reviewList = response.Page
            if (reviewList) {
                appendTable.call(self, reviewList)
                $(self).find('.dabory-table-pagination').html($.fn.table.makePagination(limit, response.PageVars.QueryCnt, page))
            }
        })
    }

    function appendTable(reviewList) {
        const html = reviewList.reduce((html, data) => {
            return html + `<tr>
                <td style="text-align: center !important;">
                    <input name="cursor-state" type="radio" value="1" tabindex="-1" aria-label="선택">
                </td>
                <td style="text-align: center !important;">
                    ${data['C1']}
                </td>
                <td style="text-align: left !important;">
                    ${data['C1']}
                </td>
                <td style="text-align: center !important;">
                    ${data['C2']}
                </td>
                <td style="text-align: left !important;">
                    ${data['C3']}
                </td>
                <td style="text-align: right !important;">
                    ${data['C4']}
                </td>
                <td style="text-align: right !important;">
                    ${data['C5']}
                </td>
                <td style="text-align: right !important;">
                    ${data['C6']}
                </td>
                <td style="text-align: right !important;">
                    ${data['C7']}
                </td>
                <td style="text-align: right !important;">
                    ${data['C8']}
                </td>
                 <td style="text-align: right !important;">
                    ${data['C9']}
                </td>
            </tr>`
        }, '')

        $(this).find('tbody').html(html)
    }

    // TODO: dabory-table.css 안으로 tpye1 클래스이름 전역 통합시키기
    function html(opts, langJson) {
        return `<div class="dabory-review-popup review type1" style="top: ${opts['top']}px; left: ${opts['left']}px; width: ${opts['width']}px; display: none;">
            <button type="button" class="tab-close" data-widget="review">
                <img src="/dabory/common/image/close-button.svg" alt="close-butto">
            </button>
            ${$.fn.type1.html.call(this)}
        </div>`
    }

    function getLangText(langJson, key) {
        if (! langJson) { return key }

        return langJson[key]
    }

    function loadModule() {
        $.fn.type1.first_date_rang.call(this)
        const self = this

        $(document).ready(function () {
            // $(self).find('.dabory-review-popup').css('z-index', 9999)
            // $(self).find('.dabory-review-popup').show()

            $(self).find('.dabory-review-popup').draggable()

            $(document).on('click', '.dabory-review-popup .dabory-table-pagination .page-link', function () {
                const limit = Number($(self).find('.dabory-table-line-select').val())
                const offset = Number($(this).data('offset'))
                const page = Number($(this).data('page'))
                $(self).find('.dabory-table-order-by-select').data('page', page)
                $(self).find('.dabory-table-order-by-select').data('offset', offset)

                callApi.call( self, limit, offset, page )
            });

            $(document).on('change', '.dabory-review-popup .dabory-table-order-by-select', function () {
                const limit = Number($(self).find('.dabory-table-line-select').val())
                const offset = Number($(this).data('offset') ?? 1)
                const page = Number($(this).data('page') ?? 1)

                callApi.call( self, limit, offset, page )
            });

            $(document).on('change', '.dabory-review-popup .dabory-table-line-select', function () {
                const limit = Number($(this).val())

                callApi.call( self, limit, 0 )
            });

            $(document).on('list.requery', '.dabory-review-popup', function () {
                const limit = Number($(self).find('.dabory-table-line-select').val())
                const offset = Number($(self).find('.dabory-table-order-by-select').data('offset') ?? 1)
                const page = Number($(self).find('.dabory-table-order-by-select').data('page') ?? 1)

                callApi.call( self, limit, offset, page )
            });
        });
    }

    $.fn.review.defaults = {
        top: 0,
        left: 0,
        width: 1200,
        langType: 'ko',
        basePath: '/dabory/widget/review',
    };

}(jQuery));
