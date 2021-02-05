
$.ajax({
    url: 'http://laravel.remedysoftware.eu/laravel/public/api/topics',
    type: 'get',
    dataType: 'json',
    success: function(data){
        
        var counter = 0;
        const container = document.getElementById('cardAppend');
        data.forEach( topic => {
            counter++;
            var tags = topic.topic_tags;
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
          //   var card = ` <div class="col" id="${topic.id}" style="float:left">
          //   <div class="card shadow-sm">
          //     <img src="${topic.topic_image}" class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"><small>${hashTagsWithSingleLinks}</small></text></img>
          //     <div class="card-body">
          //     <h3>${topic.topic_name}</h3>
          //     <hr>
          //       <p class="card-text">${topic.topic_body}</p>
          //       <div class="d-flex justify-content-between align-items-center">
          //         <div class="btn-group">
          //         <a href="http://laravel.remedysoftware.eu/site/show-news-single.html?news=${topic.id}" id="show_news_single-${topic.id}" class="btn btn-sm btn-outline-secondary">Прочети повече</a>

          //         </div>
                  
          //       </div>
          //     </div>
          //   </div>
          // </div>`;
          var card = `<div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary"><small>${hashTagsWithSingleLinks}</small></strong>
              <h3 class="mb-0">${topic.topic_name}</h3>
              <div class="mb-1 text-muted">${topic.created_at}</div>
              <p class="card-text mb-auto">${topic.topic_body}</p>
              <a href="http://laravel.remedysoftware.eu/site/show-news-single.html?news=${topic.id}" class="">Прочети цялата статия</a>
              
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="${topic.topic_image}" class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: " preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></img>
    
            </div>
          </div>
        </div>`;
          
          $(container).append(card);
          // container.innerHTML += card;
          //   // ele.innerHTML = card;
          //   // document.body.appendChild(ele.firstChild);
          //   $('#cardAppend').html(card);
          })

    }

 });
