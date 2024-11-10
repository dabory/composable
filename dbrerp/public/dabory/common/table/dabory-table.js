(function($) {
    $.fn.table = async function(options) {

    };

    $.fn.table.lineSelect = function() {
        return `<select class="dabory-table-line-select">
                <option value="10">10 Lines</option>
                <option value="15">15 Lines</option>
                <option value="20">20 Lines</option>
                <option value="30">30 Lines</option>
                <option value="40">40 Lines</option>
                <option value="50">50 Lines</option>
                <option value="100">100 Lines</option>
                <option value="200">200 Lines</option>
                <option value="300">300 Lines</option>
                <option value="400">400 Lines</option>
                <option value="500">500 Lines</option>
            </select>`
    }

    $.fn.table.orderBySelect = function() {
        return `<div class="dabory-table-order-by-div">
            <select class="dabory-table-order-by-select">
                <option value="setup_code asc, seq_no asc">설정코드 순서</option>
                <option value="setup_code desc, seq_no asc">설정 코드 역순</option>
            </select>
        </div>`
    }

    $.fn.table.makePagination = function(limit, total, page = 1) {
        let overFlow = false
        const totalPage = Math.ceil( total / limit ),
            pageGroup = Math.ceil( page / 5 ),
            last_ = pageGroup * 5,
            first = last_ - 4

        last = (overFlow = last_ > totalPage) ? totalPage : last_,
            links = `<li class="%active% page-item"><a data-offset="%offset%" data-page="%page%" class="page-link" href="#" onclick="return false;">%datas%</a></li>`;

        let next = last + 1,
            prev = first - 1,
            html = '';

        if (page <= 5) {
            html += `
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        `
        } else {
            html += links.co_split({active: '', offset: 0, page: 1, datas: `&laquo;`});
            html += links.co_split({active: '', offset: (prev - 1) * limit, page: prev, datas: `&lsaquo;`});
        }

        for (let i = first; i <= last; i++) {
            if ( i >= 1 && i <= totalPage ) {
                const active = (page === i) ? ` active ` : ``,
                    offset = (i - 1) * limit;
                html += links.co_split({active: active, offset: offset, page: i, datas: i});
            }
        }

        if (! overFlow && ! (first + 5 > totalPage)) {
            html += links.co_split({active: '', offset: (next - 1) * limit, page: next, datas: `&rsaquo;`});
            html += links.co_split({active: '', offset: (totalPage - 1) * limit, page: totalPage, datas: `&raquo;`});
        } else {
            html += `
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        `
        }

        return html
    };

}(jQuery));
