$(document).on('submit', '.form-prevent-multiple-submits', function (event) {
    $(this).find('.button-prevent-multiple-submits').attr('disabled', true)
    $(this).find('.spinner').css('display', 'inline-block')
})

$(document).on('click', '.spinner-btn', function () {
    $('#pace-progress-panel').attr('hidden', false)
})

$(document).on('click', '.modal-spinner-btn', function () {
    $('#pace-progress-modal-panel').attr('hidden', false)
})

function click_submit_btn($this, disabled = true) {
    if (disabled) {
        $($this).find('.button-prevent-multiple-submits').attr('disabled', true)
        $($this).find('.spinner').css('display', 'inline-block')
    } else {
        $($this).find('.button-prevent-multiple-submits').attr('disabled', false)
        $($this).find('.spinner').css('display', 'none')
    }
}
