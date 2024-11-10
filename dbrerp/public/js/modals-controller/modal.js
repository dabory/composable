const modal_controller = (function ($, window, document, undefined) {
    $(document).on('click', '.btn-open-modal', function() {
        $this = $(this);
        id = '#modal-' + $this.data('target');

        if (! isEmpty($this.data('class'))) {
            id = `${id}.${$this.data('class')}`
            $(id).data('class', $this.data('class'))
            // $this.data('class', '')
        }

        if (! isEmpty($this.data('variable'))) {
            moealSetFile = eval($this.data('variable'))
        }

        $(id).data('filter', '');
        if (! isEmpty($this.data('filter'))) {
            $(id).data('filter', $this.data('filter'))
        }

        // 모달 filter select box
        makeSelectBtnOptions(id, moealSetFile.SelectOptions, '.modal-filter-select');
        // 모달 orderBy select box + label
        setOrderByBtnAndLabel(id, moealSetFile.OrderByOptions);
        // 모달의 타이틀 넣어줌
        setLabel(`${id} #myModalLabel`, moealSetFile.General.Title);

        if (moealSetFile['ListVars']) {
            make_dynamic_table_css(`${id} table`, make_dynamic_table_px(moealSetFile['ListVars']['Size']))
            if ($(id).find('table').data('rowspan') > 1) {
                setThead(id, makeRowSpanThead(moealSetFile['ListVars']));
            } else {
                // 모달 테이블 th 넣어줌
                setThead(id, makeThead(moealSetFile['ListVars']));
            }

            let limit = $(id).find('.modal-line-select').find('option:selected').val();
            $(id).addClass('in');
            eval (`${$this.data('target')}_open(${limit})`);
        }

        $('.modal').draggable({ handle: ".modal-header" });
        $(id).modal('show');
    });

    // 모달의 ESC키 누를 시 모달 닫기
    shortcut.add('ESC',function () {
        $('.modal.show').modal('hide')
    })

    // 전체 모달 페이지 lines 변경 (전체)
    $(document).on('change', '.modal-line-select', function () {
        const params = make_parameter( $(this).data('target'), $(this).data('class') );
        eval ( `${$(this).data('target')}_open(${params.limit}, ${params.offset})` );
    });

    // 전체 모달 orderBy 클릭 (전체)
    $(document).on('change', '.modal-order-by-select', function () {
        const params = make_parameter( $(this).data('target'), $(this).data('class') );
        eval ( `${$(this).data('target')}_open(${params.limit}, ${$('.modal-order-by-select').data('offset')}, ${$('.modal-order-by-select').data('page')})` );
    });

    // 전체 모달 페이지네이션 클릭 (전체)
    $(document).on('click', '.pagination .page-link', function () {
        const params = make_parameter( $(this).data('target'), $(this).data('class') );
        eval ( `${$(this).data('target')}_open(${params.limit}, ${$(this).data('offset')}, ${$(this).data('page')})` );
        $('.modal-order-by-select').data('page', $(this).data('page'))
        $('.modal-order-by-select').data('offset', $(this).data('offset'))
    });

    // 아이템 모달의 검색 버튼 클릭 (전체)
    $(document).on('click', '.modal-search', function() {
        const params = make_parameter( $(this).data('target'), $(this).data('class') );
        eval ( `${$(this).data('target')}_open(${params.limit}, ${params.offset})` );
    });

    // 아이템 모달의 닫기 버튼 클릭 (전체)
    $(document).on('click', '.modal-close', function() {
        $('.search-moadal-text').val('');
    });

    $(document).on('click', '.modal .close', function() {
        $(this).closest('.modal').modal('hide')
    });

    // 아이템 모달의 검색 엔터 클릭 (전체)
    $(document).on('keydown', '.search-moadal-text', function(key) {
        if (key.keyCode == 13) {
            const params = make_parameter( $(this).data('target'), $(this).data('class') );
            eval ( `${$(this).data('target')}_open(${params.limit}, ${params.offset})` );
        }
    });

    // 전체 엔터키 검색 버튼
    $(document).keypress(function(e) {
        ['#modal-slip', '#modal-company', '#modal-item', '#modal-eyetest', '#modal-media'].forEach(id => {
            if ($(`${id}.show`).hasClass('in') && (e.keycode == 13 || e.which == 13)) {
                $(`${id}.show .modal-search`).trigger('click');
            }
        });
    });

    ['#modal-slip', '#modal-company', '#modal-item', '#modal-eyetest', '#modal-media'].forEach(id => {
        $(document).on('hide.bs.modal', id, function () {
            $(`${id}.show`).removeClass('in')
        });
    });

    setOrderByBtnAndLabel = (dom_val, OrderByOptions) => {
        if (makeSelectBtnOptions(dom_val, OrderByOptions, '.modal-order-by-select')) {
            setLabel(`${dom_val} #oderby-label`, moealSetFile.FormVars.Title.OrderBy)
        }
    }

    setLabel = (dom_val, title) => {
        $(dom_val).text(title);
    }

    makeRowSpanThead = (obj) => {
        let html = '';
        let topHtml = '<tr>';
        let bottomHtml = '<tr>';

        $.each(obj['Title'], function(k, v) {
            let format = obj['Format'][k].split('-');
            if (format[0] == 'top') {
                topHtml += `<th ${format[1]} ${obj['Hidden'][k]} style="width:${obj['Size'][k]}%;">${v}</th>`;
            } else if (format[0] == 'bottom') {
                bottomHtml += `<th ${format[1]} ${obj['Hidden'][k]} class="radius-r0 radius-l0" style="width:${obj['Size'][k]}%; border-top: 1px solid #ccc;">${v}</th>`;
            }
        });
        topHtml += '</tr>';
        bottomHtml += '</tr>';

        html = topHtml + bottomHtml;
        return html;
    }

    makeThead = (obj, checkbox_name = undefined) => {
        let html = '';

        $.each(obj['Title'], function(k, v) {
            if (obj['Title'][k] == '$Radio') {
                html += `<th class="p-0" ${obj['Hidden'][k]} style="width:${obj['Size'][k]}%;">
                </th>`;
            }
            else if (obj['Title'][k] == '$Check') {
                if (isEmpty(checkbox_name)) {
                    checkbox_name = moealSetFile['QueryVars']['QueryName'] || 'bd-cud';
                }
                html += `<th class="p-0" ${obj['Hidden'][k]} style="width:${obj['Size'][k]}%;">
                    <input type="checkbox" tabindex="-1" class="all-check" onclick="checkbox_all_checked(this, '${checkbox_name}-check')">
                </th>`;
            } else {
                html += `<th ${obj['Hidden'][k]} style="width:${obj['Size'][k]}%;">${v}</th>`;
            }
        });
        return html;
    }

    setThead = (dom_val, data) => {
        $(dom_val).find(`#table-head`).html(data);
    }

    set_thead_with_dom_value = (dom_val, data) => {
        $(dom_val).html(data);
    }

    mainModalGetsFocus = (dom_val, variable) => {
        $(dom_val).css('overflow', 'auto');
        id = dom_val;
        moealSetFile = variable;
    }

})(jQuery, window, document);
