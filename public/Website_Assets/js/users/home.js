
$('.atropos').each(function(i, obj) {
  //test
  var id = $(this).data("id");
  console.log(id);
   Atropos({
    el: `.my-atropos_${id}`,
    shadow: true,
    alwaysActive:false,
  
    shadowScale: .800,
    activeOffset: 50,
  
    highlight:true,
  
    rotateXMax:5,
    rotateYMax:5,
  
    // rest of parameters
  });
  

});


// ok meds 


var service_category = 'all';
var specialization = 'all';
var more = 'all';
var state = 'all';
var city = 'all'; 





 


 





// popover Advanced Search

$(document).ready(function() {

  $('#service-category').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ?   "اختر قسم الخدمة" :  "Choose the service department"

    }
  );

  $('#specialization').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ?   "اختر تخصص الخدمة" :  "Choose the specialization"

    }
  );

  $('#more').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ?   " المزيد  " :  "More"

    }
  );
////
$('#state').select2(
  {
    width:'resolve',
    selectionCssClass: 'select-item', // need to override the changed default
    placeholder: lang == 'ar' ?    " اختر المنطقه " :  "Choose State"

  }
);

$('#city').select2(
  {
    width:'resolve',
    selectionCssClass: 'select-item', // need to override the changed default
    placeholder: lang == 'ar' ?    " اختر المدينة " :  "Choose City"

  }
);



});




var map;

  // Google Maps

    // Initialize and add the map
    function initMap() {
      // The location of Uluru
      const uluru = { lat: Number(lat), lng: Number(lng) };
      // The map, centered at Uluru
       map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: uluru,
      });


      var styles =[
        {
          "stylers": [
            { "hue": "#009DAE" },
            { "saturation": 0 },
            { "lightness": 0 }
          ]
        }
      ];
      //    map.setOptions({styles: myStyle});
          map.setOptions({styles: styles});


  
          setMarkers(map, providers);

  





    }

    var arrMarkers = [];

    function setMarkers(map, providers) {
      for (i = 0; i < providers.length; i++) {  

        const your_img_url = APP_URL + '/storage/' + providers[i]['image'];
        console.log(your_img_url);

        var icon = {
            url: your_img_url + '#custom_marker', // url + image selector for css
            scaledSize: new google.maps.Size(35, 35), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
      // The marker, positioned at Uluru
      const marker = new google.maps.Marker({

        position: { lat: Number(providers[i]['lat']) , lng: Number(providers[i]['lng']) },
        map: map,
        icon: icon,

      });

      const contentString =
      `   <a href="${APP_URL +'/'+providers[i]['id']+'/profile' }" target="_blank"  style="text-decoration:none;">  <div class="winInfo">
      <img src="${APP_URL + '/storage/' + providers[i]['image']}" alt="">
    
    <div class="main">
      <p style="font-weight:bold;font-size:8px">${providers[i]['name'].length > 15 ? providers[i]['name'].substring(0, 15) + '...' : providers[i]['name']   }</p>

      <div class="rate">
          😍 ${providers[i]['average_rate'] == null ?'0.0' :(providers[i]['average_rate']) + '.0'}
      </div>
    </div>

      <div class="info">
          <p>${ lang == 'ar' ? providers[i]['specialization']['name_ar'] :  providers[i]['specialization']['name_en']}</p>
          <p> ${ providers[i]['country']['name'] + '/' +  (providers[i]['city'] != null ? providers[i]['city']['name'] : providers[i]['state']['name'] ) }
      </div>
  
  
  </div> </a>`;
    const infowindow = new google.maps.InfoWindow({
      content: contentString,
    });

      marker.addListener("click", () => {
        infowindow.open({
          anchor: marker,
          map,
          shouldFocus: false,
        });

      });


      arrMarkers.push(marker);





      }
    }



    function removeMarkers(){
      var i;
      for(i=0;i<arrMarkers.length;i++){
        arrMarkers[i].setMap(null);
      }
      arrMarkers = [];
  
     }
 




//// Apis


$('#service-category').on('change', function() {
          
  service_category = $(this).val();
   specialization = 'all';
 more = 'all';

  showIds();

  getSpecializationOrMoreServices({url:'/api/specializations',parentId:$(this).val(),elementId:'specialization' ,loadingElementId:'myLoadingSpecialization'}, function(){
  
  getSpecializationOrMoreServices({url:'/api/moreServices',parentId:0,elementId:'more' ,loadingElementId:'myLoadingMore'})
  })
  
  
  }); 

       
  
  $('#specialization').on('change', function() {

    specialization = $(this).val();
    more = 'all';
   
    showIds();

      getSpecializationOrMoreServices({url:'/api/moreServices',parentId:$(this).val(),elementId:'more' ,loadingElementId:'myLoadingMore'})
      
      
      }); 

      $('#more').on('change', function() {

        more = $(this).val();
        showIds();
    
          
          
          }); 

      $('#state').on('change', function() {

        state = $(this).val();
        city = 'all';

        showIds();
        getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$(this).val(),elementId:'city',loadingElementId:'myLoadingCity',isFromHome:true})
    
    
          
          
          }); 



          $('#city').on('change', function() {

            city = $(this).val();
            showIds();

          }); 

function showIds() {
// console.log(' service_category / '+service_category);
// console.log(' specialization / '+specialization);
// console.log(' more / '+more);
// console.log(' state / '+state);
// console.log(' city / '+city);
// console.log(' order_by / '+order_by);
// console.log(' search_key / '+search_key);

          }

          $('body').on('click', '.addFav', function () {


            var id = $(this).attr("data-id");

            //   showLoading('load-'+id);
   
               var request = sendAjaxRequest({url:(APP_URL+'/'+$(this).attr("data-id")+'/api/userFav'),method: 'POST',data:{}});
   
               request.done(function(response) {
                console.log(response);
              //  hideLoading() ;
   
   
                if (response['data'] == 0) {
   
               $(`.addFav i[data-id="${id}"]`).removeAttr('style');
                 $(`.addFav i[data-id="${id}"]`).css({'color': 'white'});
   
                } else {
                 $(`.addFav i[data-id="${id}"]`).removeAttr('style');
                 $(`.addFav i[data-id="${id}"]`).css({'color': 'gold'});
                  
                }
   
   
   
   
           });
   
           request.fail(function(jqXHR, textStatus) {
     
   
             if (jqXHR['status'] == '401' || jqXHR['status'] == '403') {
               showNoteAlert({msg: lang == 'ar' ? 'يجب تسجيل الدخول اولا لاستخدام جميع الميزات.' : 'You must be logged in first to use all the features.'}, function(){
                 window.location.href=APP_URL + "/authentication";
   
               });
              }else{
   
               $.Toast( lang ?  "خطأ" : "Error", jqXHR['statusText'] ,  "error",{
                 position_class:"toast-top-right",
             });
         
             }
             hideLoading() ;
   
           });

          });
        


        
      var page = 1;
var order_by = 1;
var search_key = null;

      window.onscroll = function(ev) {
        console.log('start');
       // $('#loadMore').show();
if (page != 0 ) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {

    //      console.log('startGo');
          page++;

        $('#loadMore').show();
      //    showLoading('loadMore');


var request = sendAjaxRequest({url:(APP_URL+'/api/moreProveiders'),method: 'GET',data:{'page':page,    
  'service_category':service_category,
  'specialization':specialization,
  'more':more,
  'state':state,
  'city':city,
  'order-key':order_by,
  'search_key': search_key

}});


request.done(function(response) {
console.log(response);

if (response['data']['view'] != '') {

  $('#providerCards').append(response['data']['view']);
  $('.atropos').each(function(i, obj) {
    //test
    var id = $(this).data("id");
    console.log(id);
     Atropos({
      el: `.my-atropos_${id}`,
      shadow: true,
      
      shadowScale: .800,
      activeOffset: 50,
  
      highlight:false,
      // rest of parameters
    });
    
  
  });
}else{
  page = 0 ;
}
$('#loadMore').hide();

});

request.fail(function(jqXHR, textStatus) {

console.log(jqXHR);
console.log(textStatus);

});


        }  
}


if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
  mybutton.style.display = "block";
} else {
  mybutton.style.display = "none";
}



    };
    
      
    

     
    $('body').on('click', '#search', function () {

       page = 1;

      showIds();
          showLoading('loadingCards1');

          var request = sendAjaxRequest({url:(APP_URL+'/api/advancedSearch'),method: 'GET',
          data:{
            'service_category':service_category,
            'specialization':specialization,
            'more':more,
            'state':state,
            'city':city,
            'order-key':order_by,
            'search_key': null

          }});


          request.done(function(response) {
          console.log(response);
          $('#providerCards').empty();

          if (response['data']['view'] == '') {
            $('#providerCards').append(`<div class="col" style="margin-top: 10px;text-align:center">

            <h6> ${lang == 'ar' ? 'لاتوجد نتائج': 'No Results'} </h6> 
            </div>
            `);

          }else{
            $('#providerCards').append(response['data']['view']);
            removeMarkers();
            setMarkers(map ,response['data']['providersMaps']);
            $('.atropos').each(function(i, obj) {
              //test
              var id = $(this).data("id");
              console.log(id);
               Atropos({
                el: `.my-atropos_${id}`,
                shadow: true,
                
                shadowScale: .800,
                activeOffset: 50,
            
                highlight:false,
                // rest of parameters
              });
              
            
            });
          }

          var y = $(window).scrollTop();  //your current y position on the page
          $(window).scrollTop(y+500);
          

          hideLoading();
         //  $('#providerCards').append(response['data']);
          
          });
          
          request.fail(function(jqXHR, textStatus) {
          
          console.log(jqXHR);
          console.log(textStatus);
          hideLoading();
          });
          
    });





   $(".dropdown-menu li a").click(function(){

    order_by = $(this).attr("data-id");
    page = 1;

    showIds();
        showLoading('loadingSort');
         
        console.log($(this).attr("data-id") );

        var request = sendAjaxRequest({url:(APP_URL+'/api/orderProveiders'),method: 'GET',
        data:{
          'service_category':service_category,
          'specialization':specialization,
          'more':more,
          'state':state,
          'city':city,
          'order-key':$(this).attr("data-id"),
          'search_key': search_key

        }});


        request.done(function(response) {
          console.log(response);
          $('#providerCards').empty();

          if (response['data'] == '') {

            $('#providerCards').append(`<div class="col" style="margin-top: 10px;text-align:center">

            <h6> ${lang == 'ar' ? 'لاتوجد نتائج ': 'No results '} </h6> 
            </div>
            `);

          }else{

            $('#providerCards').append(response['data']);
            $('.atropos').each(function(i, obj) {
              //test
              var id = $(this).data("id");
              console.log(id);
               Atropos({
                el: `.my-atropos_${id}`,
                shadow: true,
                
                shadowScale: .800,
                activeOffset: 50,
            
                highlight:false,
                // rest of parameters
              });
              
            
            });
          }

          var y = $(window).scrollTop();  //your current y position on the page
          $(window).scrollTop(y+500);
          

          hideLoading();
          
          });
          
          request.fail(function(jqXHR, textStatus) {
          
          console.log(jqXHR);
          console.log(textStatus);
          hideLoading();
          });






 });

 // search section


$('#searchInput').search(function(){     
search_key =  $(this).val();

  // execute after filtering
console.log('ooooooook');
page = 1;

    showIds();

    showLoading('loadingSearchInput');
     
    console.log($(this).val() );

    var request = sendAjaxRequest({url:(APP_URL+'/api/searchProveiders'),method: 'GET',
    data:{
      'service_category':service_category,
      'specialization':specialization,
      'more':more,
      'state':state,
      'city':city,
      'order-key':order_by,
      'search_key': search_key
    }});


    request.done(function(response) {
      console.log(response);
      $('#providerCards').empty();

      if (response['data']['view'] == '') {

        $('#providerCards').append(`<div class="col" style="margin-top: 10px;text-align:center">

        <h6> ${lang == 'ar' ? 'لاتوجد نتائج ': 'No Results'} </h6> 
        </div>
        `);

      }else{

        $('#providerCards').append(response['data']['view']);
        removeMarkers();
       setMarkers(map ,response['data']['providersMaps'])
       $('.atropos').each(function(i, obj) {
        //test
        var id = $(this).data("id");
        console.log(id);
         Atropos({
          el: `.my-atropos_${id}`,
          shadow: true,
          
          shadowScale: .800,
          activeOffset: 50,
      
          highlight:false,
          // rest of parameters
        });
        
      
      });
      }

      var y = $(window).scrollTop();  //your current y position on the page
      $(window).scrollTop(y+500);
      

      hideLoading();
      
      });
      
      // request.fail(function(jqXHR, textStatus) {
      
      // console.log(jqXHR);
      // console.log(textStatus);
      // hideLoading();
      // });


}, 3000);
