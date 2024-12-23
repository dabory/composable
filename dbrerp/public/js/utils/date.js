// date function
function date_range_calculator(n, d = new Date(), last = false) {
    const firDay = days_left_in_range(n, d)
    let lasDay

    firDay.setMonth(firDay.getMonth() - (n - 1))

    firDay.setDate(1)

    if (last) {
        firDay.setMonth(firDay.getMonth() - n)
        lasDay = days_left_in_range(n, firDay)
    } else {
        lasDay = days_left_in_range(n, d)
    }

    return [firDay, lasDay]
}

function date_to_sting(d, type = 1) {
    var date = new Date(d);

    switch (type) {
        case 1:
            return moment(date).format('YYYY-MM-DD');
        case 2:
            return moment(date).format('YYYYMMDD');
        default:
            break;
    }
}

function get_now_time_stamp() {
    return Math.round(new Date().getTime() / 1000);
}

function get_time_stamp_for(date) {
    return date.getTime() / 1000;
}

function days_left_in_range(n, d) {
    d = d || new Date();
    var qEnd = new Date(d);
    qEnd.setMonth(qEnd.getMonth() + n - qEnd.getMonth() % n, 0);
    return qEnd;
}

function last_date(_today) {
    let day = new Date(_today.getFullYear(), _today.getMonth()+1,0);

    day = _today.getFullYear()+"-"+("0"+(day.getMonth()+1)).slice(-2)+"-"
        +("0"+(day.getDate())).slice(-2);
    return day;
}

function to_date(date_str) {
    var yyyyMMdd = String(date_str);
    var sYear = yyyyMMdd.substring(0,4);
    var sMonth = yyyyMMdd.substring(4,6);
    var sDate = yyyyMMdd.substring(6,8);

    return new Date(Number(sYear), Number(sMonth)-1, Number(sDate));
}

function date_range_vending_machine(date_range, current_date = moment(new Date()).format('YYYY-MM-DD'), mode = 0) {
    let firDay = '1990-01-01', lasDay = '2100-12-31';
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
        case 'yesterday':
            firDay = new Date()
            lasDay = new Date()
            firDay.setDate(firDay.getDate() - 1)
            lasDay.setDate(lasDay.getDate() - 1)
            break;
        case 'week':
            currDay = new Date(current_date)
            currDay.setDate( currDay.getDate() + (7 * mode) )

            firDay = moment(currDay).startOf('isoWeek').format('YYYY-MM-DD')
            lasDay = moment(firDay).day(+7)
            break;
        case 'last-week':
            firDay = moment(new Date()).startOf('isoWeek').format('YYYY-MM-DD')
            firDay = moment(firDay).day(-6)
            lasDay = moment(firDay).day(+7)
            break;
        case 'month':
            currDay = new Date(current_date);
            currDay.setMonth( currDay.getMonth() + mode );
            [firDay, lasDay] = date_range_calculator(1, currDay)
            break;
        case 'last-month':
            [firDay, lasDay] = date_range_calculator(1, true)
            break;
        case 'quarterly':
            currDay = new Date(current_date);
            currDay.setMonth( currDay.getMonth() + (3 * mode) );
            [firDay, lasDay] = date_range_calculator(3, currDay)
            break;
        case 'last-quarterly':
            [firDay, lasDay] = date_range_calculator(3, true)
            break;
        case 'semiannual':
            currDay = new Date(current_date);
            currDay.setMonth( currDay.getMonth() + (6 * mode) );
            [firDay, lasDay] = date_range_calculator(6, currDay)
            break;
        case 'last-semiannual':
            [firDay, lasDay] = date_range_calculator(6, true)
            break;
        case 'year':
            currDay = new Date(current_date);
            currDay.setMonth( currDay.getMonth() + (12 * mode) );
            [firDay, lasDay] = date_range_calculator(12, currDay)
            break;
        case 'last-year':
            [firDay, lasDay] = date_range_calculator(12, true)
            break;
        default:
            break;
    }

    return [firDay, lasDay, currDay]
}

function timeForToday(value) {
    value.time
    const today = new Date();
    const timeValue = new Date(Number(value + '000'));

    const betweenTime = Math.floor((today.getTime() - timeValue.getTime()) / 1000 / 60);
    if (betweenTime < 1) return '방금전';
    if (betweenTime < 60) {
        return `${betweenTime}분전`;
    }

    const betweenTimeHour = Math.floor(betweenTime / 60);
    if (betweenTimeHour < 24) {
        return `${betweenTimeHour}시간전`;
    }

    const betweenTimeDay = Math.floor(betweenTime / 60 / 24);
    if (betweenTimeDay < 365) {
        return `${betweenTimeDay}일전`;
    }

    return `${Math.floor(betweenTimeDay / 365)}년전`;
}
