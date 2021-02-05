function getCookie(c_name) {
    var c_value = document.cookie,
        c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}

$(document).ready(function() {
    var pageURL = $(location).attr("href");
    // alert(pageURL);
    var accesscookie = getCookie("access_cookie");
    if (accesscookie) {
        // avoid login page if user is logged
        if (pageURL.indexOf('login') > -1){
            window.location.href = "http://laravel.remedysoftware.eu/site/index.html";
        }
    }
});

