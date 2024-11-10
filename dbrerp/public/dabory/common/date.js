(function($) {
    $.fn.date = async function(options) {
    };

    $.fn.date.days_left_in_range = function (n, d) {
        d = d || new Date();
        var qEnd = new Date(d);
        qEnd.setMonth(qEnd.getMonth() + n - qEnd.getMonth() % n, 0);
        return qEnd;
    }

    $.fn.date.range_calculator = function (n, d = new Date(), last = false) {
        const firDay = $.fn.date.days_left_in_range(n, d)
        let lasDay

        firDay.setMonth(firDay.getMonth() - (n - 1))

        firDay.setDate(1)

        if (last) {
            firDay.setMonth(firDay.getMonth() - n)
            lasDay = $.fn.date.days_left_in_range(n, firDay)
        } else {
            lasDay = $.fn.date.days_left_in_range(n, d)
        }

        return [firDay, lasDay]
    }

    $.fn.date.rangeVendingMachine = function (date_range, current_date = moment(new Date()).format('YYYY-MM-DD'), mode = 0) {
        let firDay = '1990-01-01', lasDay = '3000-12-31';
        let currDay = ''

        switch (date_range) {
            case 'day':
                currDay = new Date(current_date)
                currDay.setDate(currDay.getDate() + mode)

                firDay = currDay
                lasDay = currDay
                firDay.setDate(firDay.getDate())
                lasDay.setDate(lasDay.getDate())

                break;
            case 'week':
                currDay = new Date(current_date)
                currDay.setDate( currDay.getDate() + (7 * mode) )

                firDay = moment(currDay).startOf('isoWeek').format('YYYY-MM-DD')
                lasDay = moment(firDay).day(+7)
                break;
            case 'month':
                currDay = new Date(current_date);
                currDay.setMonth( currDay.getMonth() + mode );
                [firDay, lasDay] = $.fn.date.range_calculator(1, currDay)
                break;
            case 'quarterly':
                currDay = new Date(current_date);
                currDay.setMonth( currDay.getMonth() + (3 * mode) );
                [firDay, lasDay] = $.fn.date.range_calculator(3, currDay)
                break;
            case 'semiannual':
                currDay = new Date(current_date);
                currDay.setMonth( currDay.getMonth() + (6 * mode) );
                [firDay, lasDay] = $.fn.date.range_calculator(6, currDay)
                break;
            case 'year':
                currDay = new Date(current_date);
                currDay.setMonth( currDay.getMonth() + (12 * mode) );
                [firDay, lasDay] = $.fn.date.range_calculator(12, currDay)
                break;
            default:
                break;
        }

        return [firDay, lasDay, currDay]
    }

}(jQuery));
