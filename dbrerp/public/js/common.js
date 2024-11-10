const yearValidation = (year) => {
    const text = /^[0-9]+$/;

    if (!text.test(year) || year.length != 4) {
        iziToast.error({
            title: 'Error',
            message: 'Year is invalid',
        });
        return false;
    }
}

const numberWithCommas = (x) => {
    const parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

ajax_from = async (data, url, async = false, callback = null) => {
    return $.ajax({
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        async: async,
        success : function(response){
            if (callback) {
                callback(response)
            }
        },
        error : function(request,status,error){
            console.log('code:'+request.status+'\n'+'message:'+request.responseText+'\n'+'error:'+error);
        }
    })
}

get_table_no = (total, page, limit = 10) => {
    return total - ( page - 1 ) * limit;
},

// 검색 및 페이징, 라인 변경시 파라미터 생성 (전체)
make_parameter = (_id, class_name = undefined) => {
    let id = `#modal-${_id}`;
    if (! isEmpty(class_name)) { id = `#modal-${_id}.${class_name}`; }

    const limit = $(id).find(`.modal-line-select`).val(),
        offset = 0;

    return {limit: limit, offset: offset}
        // filtername = $(`${id}`).find(`.modal-input`).val()?$(`${id}`).find(`.modal-select`).val():``,
        // filtervalue = $(`${id}`).find(`.modal-input`).val()?$(`${id}`).find(`.modal-input`).val():``;
},

make_pagination = (_id, total, page = 1, class_name = '') => {
    let id = `#modal-${_id}`;
    if (! isEmpty(class_name)) { id = `#modal-${_id}.${class_name}`; }

    let overFlow = false
    const limit = $(id).find(`.modal-line-select`).val(),
        totalPage = Math.ceil( total / limit ),
        pageGroup = Math.ceil( page / 5 ),
        last_ = pageGroup * 5,
        first = last_ - 4
        last = (overFlow = last_ > totalPage) ? totalPage : last_,
        links = `<li class="%active% page-item"><a data-offset="%offset%" data-page="%page%" class="page-link" data-target="%target%" data-class="%class%" href="#" onclick="return false;">%datas%</a></li>`;

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
        html += links.co_split({active: '', offset: 0, page: 1, datas: `&laquo;`, target: _id, class: class_name});
        html += links.co_split({active: '', offset: (prev - 1) * limit, page: prev, datas: `&lsaquo;`, target: _id, class: class_name});
    }

    for (let i = first; i <= last; i++) {
        if ( i >= 1 && i <= totalPage ) {
            const active = (page == i) ? ` active ` : ``,
                  offset = (i - 1) * limit;
            html += links.co_split({active: active, offset: offset, page: i, datas: i, target: _id, class: class_name});
        }
    }

    if (! overFlow && ! (first + 5 > totalPage)) {
        html += links.co_split({active: '', offset: (next - 1) * limit, page: next, datas: `&rsaquo;`, target: _id, class: class_name});
        html += links.co_split({active: '', offset: (totalPage - 1) * limit, page: totalPage, datas: `&raquo;`, target: _id, class: class_name});
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
    $(id).find(`.pagination`).html(html);
};

String.prototype.co_split = String.prototype.co_split || function () {
    "use strict";
    let str = this.toString();
    if (arguments.length) {
        let t = typeof arguments[0],
            key,
            args = ("string" === t || "number" === t) ? Array.prototype.slice.call(arguments) : arguments[0];
        for (key in args) {
            str = str.replace(new RegExp("\\%" + key + "\\%", "gi"), args[key]);
        }
    }
    return str;
};
String.prototype.co_trim = String.prototype.co_trim || function () {
    "use strict";
    return this.replace(/ /gi, '');
};

function search_text_box_reset(id) {
    $(id).find('input[type="text"]:enabled').each(function(){
        $(this).val('');
    })
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function $ComTimer(){
    //prototype extend
}


$ComTimer.prototype = {
    comSecond : ""
    , fnCallback : function(){}
    , timer : ""
    , domId : ""
    , fnTimer : function(){
        var m = Math.floor(this.comSecond / 60) + "분 " + (this.comSecond % 60) + "초";	// 남은 시간 계산
        this.comSecond--;					// 1초씩 감소
        this.domId.innerText = m;
        if (this.comSecond < 0) {			// 시간이 종료 되었으면..
            clearInterval(this.timer);		// 타이머 해제
            this.fnCallback()
        }
    }
    ,fnStop : function(){
        clearInterval(this.timer);
    }
}
