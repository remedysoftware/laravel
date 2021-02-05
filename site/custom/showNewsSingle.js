var url_string = window.location.href; 
var url = new URL(url_string);
var newsID = url.searchParams.get("news");

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
    url: 'http://laravel.remedysoftware.eu/laravel/public/api/topics/' + newsID,
    type: 'get',
    success: function(response){
        var data = JSON.parse(response);
        console.log(data);
        data.forEach( news => {
            var tags = news.topic_tags;
            hashtags = tags.replace(/,/g, '#');

            // create a hrefs for every tag
            var str = hashtags;
            var str_array = str.split('#');

            var hashTagsWithSingleLinks = '';
            for(var i = 0; i < str_array.length; i++) {
              // Trim the excess whitespace.
              str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
              // Add additional code here, such as:
              // alert(str_array[i]);

              hashTagsWithSingleLinks += '<a href="http://laravel.remedysoftware.eu/site/indexSearch.html?tags=' + str_array[i] + '" style="text-decoration:none;">#' + str_array[i] + '</a>';
            }

            var newsTitle = news.topic_name;
            var smallBodyText = news.topic_body;
            var date = news.created_at;
            var full_text = news.topic_full_body_text;
            $("#newsTittle").append(newsTitle);
            $("#small_body_text").append(smallBodyText);
            $("#date").append(date);
            $("#show_full_text").append(full_text);
            $("#img").append(' <img src="'+ news.topic_image+ '" widht="250px" height="250px;">');
            $("#tags").append(hashTagsWithSingleLinks); 
        });
    }
 });


    // post comment logic
    var accesscookie = getCookie("access_cookie");
    if ( accesscookie ){
        $("#postComment").click(function(e){
            e.preventDefault();
            console.log('post comment');
            var comment = $("#comment").val();
            // console.log(comment);
            var user_id = getCookie('uid');
            var topic_id = newsID;
                $.ajax({
                    method: 'POST',
                    url: 'http://laravel.remedysoftware.eu/laravel/public/api/createnewcomment',
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true
                    },
                    headers: {
                        Authorization: 'Bearer ' + getCookie("access_cookie"),
                    },
                    data:{
                        comment: comment,
                        user_id: user_id,
                        topic_id: topic_id,
            
                    },
                    success: function(response){
                        console.log('success');
                        window.setTimeout('location.reload()', 300); //Reloads after three seconds
                    }
            
                });
            });
            

        }

      