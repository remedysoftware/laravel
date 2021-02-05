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

// $(document).ready(function() {
//     var acookie = getCookie("access_cookie");
//     if (!acookie) {
//         // alert("Cookie not found.");
//     }else{

//     }
// });

 $("#login").click(function(){

    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        type: "POST",
        url: "http://laravel.remedysoftware.eu/laravel/public/api/loginnew",
        data: {
            email: email,
            password: password
        },
        dataType:'json',
        success: function (response) {
            console.log(response['success']['token']);
            const token = response['success']['token'];
            if ( token ){
                document.cookie = "access_cookie=" + token;
                $.ajax({
                    method: 'GET',
                    url: 'http://laravel.remedysoftware.eu/laravel/public/api/getuser',
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true
                    },
                    headers: {
                        Authorization: 'Bearer ' + getCookie("access_cookie"),
                    },
                    success: function(response){
                        console.log(response['success']);
                        var data = response['success'];
                        document.cookie = "uname=" + data['name'];
                        document.cookie = "umail=" + data['email'];
                        document.cookie = "is_admin=" + data['is_admin'];
                        document.cookie = "uid=" + data['id'];  

                        window.location.href = "http://laravel.remedysoftware.eu/site/index.html";
                    }
                });
            }
      
        },
        error: function (jqXHR) {
          var response = $.parseJSON(jqXHR.responseText);
          if(response.message) {
            alert(response.message);
          }
        }
    });
});

