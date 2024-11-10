function trim(stringToTrim) {
    return stringToTrim.toString().replace(/^\s+|\s+$/g,"");
}

function isEmpty(str) {
    if (typeof str === "undefined" || str === undefined || str === null || str === "" || trim(str) === '')
        return true;
    else
        return false ;
}

function ellipsisString(text, maxLength = 150) {
    if (text.length > maxLength) {
        const truncatedString = text.substring(0, maxLength)
        return truncatedString + "..."
    }

    return text
}

function capitalize(str) {
	return str.charAt(0).toUpperCase() + str.slice(1);
}

function textLengthOverCut(txt, len, lastTxt) {
    if (len == "" || len == null) { // 기본값
        len = 20;
    }
    if (lastTxt == "" || lastTxt == null) { // 기본값
        lastTxt = "...";
    }
    if (txt.length > len) {
        txt = txt.substr(0, len) + lastTxt;
    }
    return txt;
}

function getByte(str) {
    return str
        .split('')
        .map(s => s.charCodeAt(0))
        .reduce((prev, c) => (prev + ((c === 10) ? 2 : ((c >> 7) ? 2 : 1))), 0);
}

function str_replace_hyphen(str, search) {
    return str.replace(search, '-')
}
