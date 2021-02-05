
var url_string = window.location.href; 
var url = new URL(url_string);
var news = url.searchParams.get("news");

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

$.ajax({
    url: 'http://laravel.remedysoftware.eu/laravel/public/api/gettopiccomments/' + news,
    type: 'get',
    success: function(response){
        // console.log(response);
        // var data = JSON.parse(response);
        // console.log(response['username'][0]['name']);
        // var counter = 0;
        const container = document.getElementById('showComments');
        response['comments'].forEach( comments => {
            // console.log(response);
            // var userName = response[comments.user_id]['name'];
            // console.log(comments.body);
          var comment_card = `<div class="col-8" style="margin-bottom:10px">
          <div class="card card-white post">
              <div class="post-heading">
                  <div class="float-left image">
                      <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
                  </div>
                  <div class="float-left meta">
                      <div class="title h5">
                          <a href="#"><b>User ID: ${comments.user_id}</b></a>
                          написа коментар
                      </div>
                      <!-- <h6 class="text-muted time">1 minute ago</h6> -->
                  </div>
              </div> 
              <div class="post-description"> 
                  <p>${comments.body}</p>

              </div>
          </div>
      </div>   `;
          
          $(container).append(comment_card);

        })

    }

 });

 // post comment
 $("#postComment").click(function(){
    //  console.log('post')
//     var accesscookie = getCookie("access_cookie");
//     if (accesscookie) {
//        var comment = $("#comment").val();
//        console.log(comment);
//       $.ajax({
//           method: 'GET',
//           url: 'http://laravel.remedysoftware.eu/laravel/public/api/createnewcomment',
//           crossDomain: true,
//           xhrFields: {
//               withCredentials: true
//           },
//           headers: {
//               Authorization: 'Bearer ' + getCookie("access_cookie"),
//           },
//           data:{
//               comment: ,
//               user_id: ,
//               topic_id: ,
   
//           },
//           success: function(response){
   
//           }
   
//        });
//    }
   
 });


