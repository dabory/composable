$('.select').select2({
    minimumResultsForSearch: Infinity,
});

$('.toggle-full-screen').click(function () {
    $(this).children().toggleClass('fa-expand-arrows-alt fa-compress-arrows-alt')
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();

    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
});

$('[data-toggle="tooltip"]').tooltip()

$(document).on('show.bs.modal', '.modal', function (event) {
    $('.modal').draggable({ handle: ".modal-header" });
})

$(document).on('keydown','.decimal', function (event) {
    handleEnterPressedinNormalCell(event, function() {})
}).on('focusout','.decimal', function () {
    $(this).val(format_conver_for(minusComma($(this).val()), $(this).data('point')))
});

// 전체 input 텍스트박스 더블클릭 시 초기화
$(document).on('dblclick', 'input[type="text"]:enabled.filter', function () {
    $(this).val('')
})

$(document).on('mouseenter', '.table-row > tbody > tr > td, .table-row > thead th', function () {
    let $this = $(this);
    if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
        $this.tooltip({
            title: $this.text(),
            animated: 'fade',
            placement: 'right',
            container: 'body',
            // trigger: 'click'
        });
        $this.tooltip('show');
    }
}).on('mouseleave', '.table-row > tbody > tr > td, .table-row > thead th', function() {
    $('.tooltip').hide();
    $('.tooltip').tooltip('dispose');
    // $('.tooltip').tooltip('hide');
});

$(document).on('mouseenter', ".table-row > tbody > tr > td img", function () {
    $(this).tooltip({
        html: true,
        title: `<img src="${$(this).attr('src')}" onerror="this.src='/images/folder.jpg'"/>`,
        animated: 'fade',
        placement: 'right',
        container: 'body',
        // trigger: 'click'
    });
    $(this).tooltip('show');
}).on('mouseleave', '.table-row > tbody > tr > td img', function() {
    $('.tooltip').hide();
    $('.tooltip').tooltip('dispose');
});

$(document).on('mouseenter', ".tooltip-show-img", function () {
    if ($(this).val()) {
        $(this).tooltip('dispose')
        $(this).tooltip({
            html: true,
            title: `<img src="${window.env['MEDIA_URL'] + $(this).val()}" onerror="this.src='/images/folder.jpg'"/>`,
            animated: 'fade',
            placement: 'bottom',
            container: 'body',
            // trigger: 'click'
        });
        $(this).tooltip('show');
    }
}).on('mouseleave', '.tooltip-show-img', function() {
    $('.tooltip').hide();
    $('.tooltip').tooltip('dispose');
});


$(document).on('mouseenter', 'table .txt_box', function () {
    let $this = $(this);
    if (! $this.data('title')) { return; }
    $this.tooltip({
        title: $this.data('title'),
        animated: 'fade',
        placement: 'top',
        container: 'body',
    });
    $this.tooltip('show');
}).on('mouseleave', '.table .txt_box', function() {
    $('.tooltip').hide();
    $('.tooltip').tooltip('dispose');
});
