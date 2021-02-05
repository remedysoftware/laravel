// Create back to the new button
var backbutton= $('<a href="http://laravel.remedysoftware.eu/site/index.html" class="btn btn-primary my-2">  <strong><<</strong>Обратно във ВСИЧКИ НОВИНИ </a> ');
$("#backbuttondiv").append(backbutton);

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


 // GET AND GENERATE ALL CATEGORIES
 $.ajax({
    url: 'http://laravel.remedysoftware.eu/laravel/public/api/categories',
    type: 'get',
    dataType: 'json',
    success: function(response){
        console.log(response);
        var counter = 0;
        // var categorieLink = `<a class="p-2 link-secondary" href="http://laravel.remedysoftware.eu/site/index.html">Всички Новини</a>`
        const categoriesList = document.getElementById('categoriesList');
        response.forEach( categories => {

          var categorieLink = `
          <a class="p-2 link-secondary" href="http://laravel.remedysoftware.eu/site/indexCategories.html?category=${categories.categories}">${categories.siteName}</a>
          `
          $(categoriesList).append(categorieLink);
  
        })
    }
  });

  $(document).ready(function() {

    // show user name logged
    var accesscookie = getCookie("access_cookie");
    if (accesscookie) {
      var username = getCookie("uname");
      $("#show_user_name").append('<small><b>Здравей:</b>'+username +'</small><br><button id="log_out"> Log out</button>')
      $("#sign_in_button").hide();

    }

      // log out user
      $("#log_out").click(function(){
        document.cookie = 'access_cookie'+'=; Max-Age=-99999999;';
        document.cookie = 'umail'+'=; Max-Age=-99999999;';
        document.cookie = 'is_admin'+'=; Max-Age=-99999999;';
        document.cookie = 'uid'+'=; Max-Age=-99999999;';
        document.cookie = 'uname'+'=; Max-Age=-99999999;';
        if(window.top==window) {
          // You're not in a frame, so you reload the site.
          window.setTimeout('location.reload()', 1000); //Reloads after three seconds
      }

    })

    // create comments access if user is logged
    if ( accesscookie ){
      console.log(1);
      $("#inputCommentForm").show();
    }else{
      // console.log(0);
      $("#inputCommentForm").hide();


    }

});


  


