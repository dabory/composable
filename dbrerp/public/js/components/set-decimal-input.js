$(function () {
    const regExp = /[0-9\.\,]/;
    $(document).on('keydown keyup', 'input.decimal-input', function (e) {
        const value = String.fromCharCode(e.which) || e.key;
        // Only numbers, dots and commas
        if (!regExp.test(value)
            && e.which != 188 // ,
            && e.which != 190 // .
            && e.which != 8   // backspace
            && e.which != 46  // delete
            && (e.which < 37  // arrow keys
                || e.which > 40)) {
            e.preventDefault();
            return false;
        }

        $(this).val(function (index, value) {
            value = value.replace(/,/g, '');
            return numberWithCommas(value);
        });
    });
});

