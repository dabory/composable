const media = (function ($, window, document, undefined) {
    $(document).on('click', 'input:radio[name=media-date-range]', function() {
        let firDay, lasDay;
        [firDay, lasDay] = date_range_vending_machine($(this).val());

        $('#modal-media.show').find('#media-start-date').val(date_to_sting(firDay))
        $('#modal-media.show').find('#media-end-date').val(date_to_sting(lasDay))
    })

    change_media_query_speed = () => {
        $('#modal-media.show').find('.modal-search').trigger('click')
    }

    $('.media-search-act').on('click', function () {
        switch( $(this).data('value') ){
            case 'save' :
            case 'thumbnail' :
            case 'a-tag':
            case 'popup':
                media_search_act($(this).data('value'));
                break;
            case 'del':
                iziToast.info({
                    title: 'Info', message: '미디어 삭제는 미디어 라이브러리 메뉴에서 가능합니다',
                });
                break;
        }
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
        $('#modal-media.show').find('.modal-search').trigger('click');
    });

    media_search_act = async function(value) {
        let html = '';
        let file_url_list = [];
        let id_list = [];
        const media_url = window.env['MEDIA_URL']

        const name = `${moealSetFile['QueryVars']['QueryName']}-check`
        $('#modal-media table').find(`input[name='${name}']`).each(function () {
            if ($(this).is(':checked')) {
                switch (value) {
                    case 'save':
                        html += `<img src="${media_url + $(this).data('file_url')}">`
                        file_url_list.push($(this).data('file_url'))
                        break;
                    case 'thumbnail':
                        html += `<img src="${media_url + $(this).data('thumbnail-url')}">`
                        file_url_list.push($(this).data('thumbnail-url'))
                        break;
                    case 'a-tag':
                        html += `<a href="${media_url + $(this).data('file_url')}">${$(this).data('media_name')}</a>`
                        break;
                    case 'popup':
                        html += `<a href="${media_url + $(this).data('file_url')}" target="_blank">${$(this).data('media_name')}</a>`
                        break;
                    default:
                        break;
                }
                id_list.push($(this).data('id'))
            }
        })

        if (isEmpty(html)) {
            iziToast.error({
                title: 'Error', message: $('#can-not-paste-in-the-status').text(),
            });
            return;
        }

        console.log(file_url_list)

        const target_id = $('#modal-media').data('target-id')
        if (target_id) {
            $(target_id).find('.fr-view').append(html)
        } else {
            const unique_key = $('#modal-media').data('unique-key')
            $('#modal-media').trigger('file.paste', [file_url_list, id_list, unique_key]);
        }
        $('#modal-media.show').modal('hide')
    }

    media_parameter = function(limit, offset) {
        return  {
            QueryVars: {
                QueryName: moealSetFile['QueryVars']['QueryName'],
                FilterName: moealSetFile['QueryVars']['FilterName'],
                FilterValue: moealSetFile['QueryVars']['FilterValue'],
            },
            MediaSearchVars: {
                StartDate: date_to_sting(new Date($(id).find('#media-start-date').val()), 2),
                EndDate: date_to_sting(new Date($(id).find('#media-end-date').val()), 2),
                SlipNo: $(id).find('#slip-no-txt').val(),
                MediaName: $(id).find('#media-name-txt').val(),
                FileName: $(id).find('#file-name-txt').val(),
                LinkLocation: $(id).find('#link-location-txt').val(),
                Linked: $(id).find('#linked-txt').val(),
                UserName: $(id).find('#user-name-txt').val(),
                BranchName: $(id).find('#branch-name-txt').val(),
                OrderBy: $(id).find('.modal-order-by-select').val(),
            },
            PageVars: {
                Limit: parseInt(limit),
                Offset: parseInt(offset),
            }
        }
    }

    media_checked_data = function ($this) {
        $($this).closest('tr').find('td:eq(0) input').trigger('click');
    }

    media_open = (limit, offset, page = 1) => {
        let html = ``;
        let modal_class_name = $(id).data('class') || '';

        $(id).find('.media-save-spinner-btn').show()
        $(id).find('.media-search-btn').hide()

        $.when(get_api_data(moealSetFile['General']['PageApi'], media_parameter(limit, offset))).done(function(response) {
            let d = response.data
            console.log(d)
            if( d.Page ) {
                make_pagination('media', d.PageVars.QueryCnt, page, modal_class_name);
                let no = get_table_no(d.PageVars.QueryCnt, page, limit);
                for (let i in d.Page) {
                    html +=
                    `<tr>
                        <td class="text-${moealSetFile.ListVars['Align'].$Check} px-import-0">
                            <input name="${moealSetFile['QueryVars']['QueryName']}-check" type="checkbox" value="1" tabindex="-1"
                            class="text-${moealSetFile.ListVars['Align'].$Check}"
                            data-id="${d.Page[i].Id}" data-file_url="${d.Page[i].FileName}" data-thumbnail-url="${d.Page[i].ThumbNail}" data-media_name="${d.Page[i].MediaName}">
                        </td>
                        <td class="text-${moealSetFile.ListVars['Align'].No}" ${moealSetFile.ListVars['Hidden'].No}>${no--}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].SlipNo}" ${moealSetFile.ListVars['Hidden'].SlipNo}><a onclick="media_checked_data(this)" href="#.">${d.Page[i].SlipNo}</a></td>
                        <td class="text-${moealSetFile.ListVars['Align'].ThumbNail}" ${moealSetFile.ListVars['Hidden'].ThumbNail}>${format_conver_for(d.Page[i].ThumbNail, moealSetFile.ListVars['Format'].ThumbNail, moealSetFile['ThumbContainerVars'])}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].MediaName}" ${moealSetFile.ListVars['Hidden'].MediaName}>${d.Page[i].MediaName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].FileName}" ${moealSetFile.ListVars['Hidden'].FileName}>${format_conver_for(d.Page[i].FileName, moealSetFile.ListVars['Format'].FileName, moealSetFile['ThumbContainerVars'])}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].UserName}" ${moealSetFile.ListVars['Hidden'].UserName}>${d.Page[i].NickName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].BranchName}" ${moealSetFile.ListVars['Hidden'].BranchName}>${d.Page[i].BranchName}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].LinkLocation}" ${moealSetFile.ListVars['Hidden'].LinkLocation}>${d.Page[i].LinkLocation}</td>
                        <td class="text-${moealSetFile.ListVars['Align'].Linked}" ${moealSetFile.ListVars['Hidden'].Linked}>${d.Page[i].Linked}</td>
                    </tr>`;
                    $( ".riverroad" ).tooltip({ content: `<img src="${d.Page[i].FileName}" />` });
                }
            } else {
                html = `<tr><td class="text-center" colspan="${moealSetFile.ListVars['Count']}">${$('#no-data-found').text()}</td></tr>`;
                make_pagination('media', 1, 1, modal_class_name );
            }
            $(id).find(`#table-body`).html(html);

            $(id).find('.media-save-spinner-btn').hide()
            $(id).find('.media-search-btn').show()
        })
        $(id).modal('show');
    }
})(jQuery, window, document);
