if (isProviderAuth) {
  const parser2 = new DOMParser();

  var popover = new bootstrap.Popover(document.querySelector('.profileImageProvider'), {
    content:  function () {
      return `<div class="dropdown-profile-content">
      <a href="${APP_URL+'/'+profile_id+'/profile'}">${lang == 'ar' ?  'صفحتي الشخصية' :  'My Profile'}</a>
      <hr>
      <a href="${APP_URL+'/'+'provider/account'}"> ${lang == 'ar' ?  'حسابي' :  'My Account'}</a>
      <a href="${APP_URL+'/'+'authenticationLogout'}"> ${lang == 'ar' ?  'تسجيل الخروج' :  'Logout'}</a>
  
    </div>`;
    },
    
    trigger:'click',
    html:true,
    offset:[0, 2]
  });
}

    //   <a href="${APP_URL+'/'+'provider/wallet'}"> ${lang == 'ar' ?  'محفظتي' :  'My Wallet'}</a>




// Share DropDown
$(function(){
  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });

  $(window).resize(function(e) {
    if($(window).width()<=768){
      $("#wrapper").removeClass("toggled");
    }else{
      $("#wrapper").addClass("toggled");
    }
  });
});
 

  var popover = new bootstrap.Popover(document.querySelector('.shareButton'), {
    content:  function () {
      return `<div class="dropdown-profile-content" id="popoverContent">

      </div>`;
    },
    
    trigger:'click',
    html:true,
    offset:[0, 2]
  });
  var popover = new bootstrap.Popover(document.querySelector('.shareButton2'), {
    content:  function () {
      return `<div class="dropdown-profile-content" id="popoverContent">

      
    </div>`;
    },
    
    trigger:'click',
    html:true,
    offset:[0, 2]
  });

  $('.shareButton').on('shown.bs.popover', function () {
    $('#popoverContent').append(`<a  data-sharer="facebook" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'فيسبوك' : 'Facebook'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="twitter" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'تويتر' : 'Twitter'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="linkedin" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'لينكد ان' : 'Linkedin'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="whatsapp" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'واتساب' : 'WhatsApp'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="telegram" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'تليجرام' : 'Telegram'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="email" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'ايميل' : 'Email'}</a>`);
    window.Sharer.init();

  });
  $('.shareButton2').on('shown.bs.popover', function () {
    $('#popoverContent').append(`<a  data-sharer="facebook" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'فيسبوك' : 'Facebook'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="twitter" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'تويتر' : 'Twitter'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="linkedin" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'لينكد ان' : 'Linkedin'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="whatsapp" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'واتساب' : 'WhatsApp'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="telegram" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'تليجرام' : 'Telegram'}</a>`);
    $('#popoverContent').append(`<a  data-sharer="email" data-title="${provider['name']}" data-hashtags="Helprz" data-url="${current_URL}">${lang == 'ar' ? 'ايميل' : 'Email'}</a>`);
    window.Sharer.init();

  });
$('.comment').readmore({
    speed: 10,
    collapsedHeight: 30,
    lessLink: `<a href="#" style='font-size:10px' class="readMoreLess"> ${lang == 'ar' ? 'قراءة اقل' : 'Read less'}</a>`,
    moreLink: `<a href="#" style='font-size:10px' class="readMoreLess">${lang == 'ar' ? 'قراءة المزيد' : 'Read more'}</a>`,
    embedCSS: true
});



var emojis = ['angry','meh','happy','smile','inlove']; 

$("#emoji-div").emoji({
    animation:'shake',
    emojis: emojis,
    value: ( user_rated == null || user_rated['rate'] == 0 ?   0  :  user_rated['rate']),
    callback: (val)=>{


var request = sendAjaxRequest({url:(APP_URL+'/'+$("#emoji-div").attr("data-id")+'/api/profile/rate'),method: 'POST',data:{'rate':$("#emoji-div").emoji("getvalue")}});

request.done(function(response) {
//  hideLoading() ;


//window.location.href=APP_URL + "/myreservations";


$.Toast( lang ?  "تم" : "Done", response['message'] ,  "success",{
  position_class:"toast-top-right",
});





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








    }, //Returns event and currentValue in the change event

}); 

$('.textarea1').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current1'),
      maximum = $('#maximum1'),
      theCount = $('#the-count1');
    
  current.text(characterCount);
 
  
  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 70) {
    current.css('color', '#666');
  }
  if (characterCount > 70 && characterCount < 90) {
    current.css('color', '#6d5555');
  }
  if (characterCount > 90 && characterCount < 100) {
    current.css('color', '#793535');
  }
  if (characterCount > 100 && characterCount < 120) {
    current.css('color', '#841c1c');
  }
  if (characterCount > 120 && characterCount < 139) {
    current.css('color', '#8f0001');
  }
  
  if (characterCount >= 140) {
    maximum.css('color', '#8f0001');
    current.css('color', '#8f0001');
    theCount.css('font-weight','bold');
  } else {
    maximum.css('color','#666');
    theCount.css('font-weight','normal');
  }
  
      
});


$('.textarea2').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current2'),
      maximum = $('#maximum2'),
      theCount = $('#the-count2');
    
  current.text(characterCount);
 
  
  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 70) {
    current.css('color', '#666');
  }
  if (characterCount > 70 && characterCount < 90) {
    current.css('color', '#6d5555');
  }
  if (characterCount > 90 && characterCount < 100) {
    current.css('color', '#793535');
  }
  if (characterCount > 100 && characterCount < 120) {
    current.css('color', '#841c1c');
  }
  if (characterCount > 120 && characterCount < 139) {
    current.css('color', '#8f0001');
  }
  
  if (characterCount >= 140) {
    maximum.css('color', '#8f0001');
    current.css('color', '#8f0001');
    theCount.css('font-weight','bold');
  } else {
    maximum.css('color','#666');
    theCount.css('font-weight','normal');
  }
  
      
});

$('.textarea3').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current3'),
      maximum = $('#maximum3'),
      theCount = $('#the-count3');
    
  current.text(characterCount);
 
  
  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 70) {
    current.css('color', '#666');
  }
  if (characterCount > 70 && characterCount < 90) {
    current.css('color', '#6d5555');
  }
  if (characterCount > 90 && characterCount < 100) {
    current.css('color', '#793535');
  }
  if (characterCount > 100 && characterCount < 120) {
    current.css('color', '#841c1c');
  }
  if (characterCount > 120 && characterCount < 139) {
    current.css('color', '#8f0001');
  }
  
  if (characterCount >= 140) {
    maximum.css('color', '#8f0001');
    current.css('color', '#8f0001');
    theCount.css('font-weight','bold');
  } else {
    maximum.css('color','#666');
    theCount.css('font-weight','normal');
  }
  
      
});
    // Initialize and add the map
    function initMap() {
      // The location of Uluru
      const uluru = { lat: Number(provider['lat']), lng: Number(provider['lng']) };
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


  
          const your_img_url = APP_URL + '/storage/' + provider['image'];
  
          var icon = {
              url: your_img_url + '#custom_marker', // url + image selector for css
              scaledSize: new google.maps.Size(35, 35), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(0, 0) // anchor
          };
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
  
          position: { lat: Number(provider['lat']) , lng: Number(provider['lng']) },
          map: map,
          icon: icon,
  
        });
  
        const contentString =
        `   <a href="https://www.nbe.com.eg/NBE/E/#/AR/ProductDetails?inParams=%7B%22CategoryID%22%3A%22PrepaidCardsID%22%2C%22ProductID%22%3A%226323%22%7D" target="_blank"  style="text-decoration:none;">  <div class="winInfo">
        <img src="${APP_URL + '/storage/' + provider['image']}" alt="">
      
      <div class="main">
        <p style="font-weight:bold;font-size:8px">${provider['name'].length > 15 ? provider['name'].substring(0, 15) + '...' : provider['name']   }</p>
  
        <div class="rate">
            😍 ${provider['average_rate'] == null ?'0.0' :(provider['average_rate']) + '.0'}
        </div>
      </div>
  
        <div class="infoMap">
            <p>${ lang == 'ar' ? provider['service_catogrey']['name_ar'] :  provider['service_catogrey']['name_en']}</p>
            <p> ${ provider['country']['name'] + '/' +  provider['city']['name'] }
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
  
  





    }

    $("#agreeTerm").click(function(){

      $('#termsModal').modal('toggle')

    });


// Apis Req

$('body').on('click', '.addFav', function () {


    var id = $(this).attr("data-id");

    //   showLoading('load-'+id);

       var request = sendAjaxRequest({url:(APP_URL+'/'+$(this).attr("data-id")+'/api/userFav'),method: 'POST',data:{}});

       request.done(function(response) {
      //  hideLoading() ;


        if (response['data'] == 0) {

       $(`.addFav  i[data-id="${id}"]`).removeAttr('style');
         $(`.addFav  i[data-id="${id}"]`).css({'color': 'white'});

        } else {
         $(`.addFav  i[data-id="${id}"]`).removeAttr('style');
         $(`.addFav  i[data-id="${id}"]`).css({'color': 'gold'});
          
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










$(document).ready(function (e) {
  $('#reportProfileForm').on('submit',(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      if ($('#reportInput').val() != '') {

      showLoading('loadingReport')
      $.ajax({
          type:'POST',
          url:APP_URL+'/'+profile_id+'/api/profile/report',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success:function(data){

              $.Toast( lang ?  "تم" : "Done", data['message'],  "success",{
                position_class:"toast-top-right",
            });
            hideLoading() ;
            $('#reportModal').modal('toggle')

          },
          error: function(data){

            if (data['status'] == '401' || data['status'] == '403') {
              showNoteAlert({msg: lang == 'ar' ? 'يجب تسجيل الدخول اولا لاستخدام جميع الميزات.' : 'You must be logged in first to use all the features.'}, function(){
                window.location.href=APP_URL + "/authentication";
  
              });
             }else if (data['status'] == '422') {
              $.Toast( lang ?  "خطأ" : "Error", lang == 'ar' ?  'يرجي ادخال التفاصيل اولا.' : 'Please enter the details first.' ,  "error",{
                position_class:"toast-top-right",
            });


             }else{
  
              $.Toast( lang ?  "خطأ" : "Error", data['statusText'] ,  "error",{
                position_class:"toast-top-right",
            });
        
            }
            hideLoading() ;
          
          }
      });

    }
  }));

  var commentId;
  $(`.reportCommentButton`).on('click',(function(e) {

    commentId = $(this).attr("data-id") 



   
  }));


  $('#reportComment').on('submit',(function(e) {
    
    e.preventDefault();
    var formData = new FormData(this);
    if ($('#reportCommentInput').val() != '') {

    showLoading('loadingReport')
    $.ajax({
        type:'POST',
        url:APP_URL+'/'+commentId+'/api/profile/reportComment',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){

            $.Toast( lang ?  "تم" : "Done", data['message'],  "success",{
              position_class:"toast-top-right",
          });
          hideLoading() ;
          $('#reportCommentModal').modal('toggle')

        },
        error: function(data){

          if (data['status'] == '401' || data['status'] == '403') {
            showNoteAlert({msg: lang == 'ar' ? 'يجب تسجيل الدخول اولا لاستخدام جميع الميزات.' : 'You must be logged in first to use all the features.'}, function(){
              window.location.href=APP_URL + "/authentication";

            });
           }else if (data['status'] == '422') {
            $.Toast( lang ?  "خطأ" : "Error", lang == 'ar' ?  'يرجي ادخال التفاصيل اولا.' : 'Please enter the details first.' ,  "error",{
              position_class:"toast-top-right",
          });


           }else{

            $.Toast( lang ?  "خطأ" : "Error", data['statusText'] ,  "error",{
              position_class:"toast-top-right",
          });
      
          }
          hideLoading() ;
        
        }
    });

  }
}));









});



$('body').on('click', '#sendComment', function () {




  if ($('#commentInput').val() != '') {
    
  showLoading('loadingCommentSend')
  var request = sendAjaxRequest({url:(APP_URL+'/'+$("#emoji-div").attr("data-id")+'/api/profile/comment'),method: 'POST',data:{'comment':$('#commentInput').val()}});

  request.done(function(response) {
  //  hideLoading() ;
  $('#nocomment').hide();
  $('#commentInput').val('');
  $(".peopleComments").prepend(`

  <div class="card mb-3" style="max-width: 100%;">
  <div class="row ">
      <div class="col-12 col-lg-1">
          <img src=" ${response['data']['user']['image'] == null ?  (APP_URL + '/Website_Assets/assets/images/userImageDefault.png')  : (APP_URL + '/storage/' + response['data']['user']['image'])  }"  width="80" height="80" class="rounded-circle" alt="...">
      </div>
      <div class="col-12 col-lg-10">
          <div class="card-body">
              <h6 class="card-title "> ${ response['data']['user']['name']  }</h6>
              <p class="card-text text-center text-lg-start"><small class="text-muted" style="font-size: .5rem">${response['data']['carbon']}</small></p>

      
              <p  class="card-text text-center text-lg-start comment" style="font-weight: bold"> ${response['data']['comment']}

              </p>

          </div>




      </div>
  </div>
</div>
  
  `);

  $('.comment').readmore({
    speed: 10,
    collapsedHeight: 80,
    lessLink: `<a href="#" class="readMoreLess"> ${lang == 'ar' ? 'قراءة اقل' : 'Read less'}</a>`,
    moreLink: `<a href="#" class="readMoreLess">${lang == 'ar' ? 'قراءة المزيد' : 'Read more'}</a>`,
    embedCSS: true
});


  $.Toast( lang ?  "تم" : "Done", response['message'] ,  "success",{
    position_class:"toast-top-right",
  });
  
  
  
  hideLoading();
  
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
    hideLoading();

  });





  }




});







$(document).ready(function (e) {
  $('#reservationModalForm').on('submit',(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      if ( $('#reservationInput').val() != '') {

      showLoading('loadingreservation')
      $.ajax({
          type:'POST',
          url:APP_URL+'/'+profile_id+'/api/profile/reservation',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success:function(data){
//console.log(data);
            //   $.Toast( lang ?  "تم" : "Done", data['message'],  "success",{
            //     position_class:"toast-top-right",
            // });
            hideLoading() ;
            $('#reservationModal').modal('toggle');
            $('#reservationInput').val('');

         //   window.location.href=APP_URL + "/myreservations";


         showNoteAlert({msg:  data['message'],confirmButtonText:lang == 'ar' ? 'حجوزاتي' : 'My Reservations',isSuccess: true}, function(){
          window.location.href=APP_URL + "/myreservations";
    
        });

          },
          error: function(data){

            if (data['status'] == '401' || data['status'] == '403') {
              showNoteAlert({msg: lang == 'ar' ? 'يجب تسجيل الدخول اولا لاستخدام جميع الميزات.' : 'You must be logged in first to use all the features.'}, function(){
                window.location.href=APP_URL + "/authentication";
  
              });
             }else if (data['status'] == '422') {
              $.Toast( lang ?  "خطأ" : "Error", lang == 'ar' ?  'يرجي ادخال التفاصيل اولا.' : 'Please enter the details first.' ,  "error",{
                position_class:"toast-top-right",
            });


             }else{
  
              $.Toast( lang ?  "خطأ" : "Error", data['statusText'] ,  "error",{
                position_class:"toast-top-right",
            });
        
            }
            hideLoading() ;
            $('#reservationModal').modal('toggle');
          
          }
      });


    }
  }));


});







