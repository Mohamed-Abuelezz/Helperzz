


try {
  AOS.init();

} catch (error) {
//console.log(error);  
}

if (document.querySelector('.profileImage') != null) {
  var popover = new bootstrap.Popover(document.querySelector('.profileImage'), {
  content:  function () {
  return `<div class="dropdown-profile-content">
  <a href="${APP_URL+'/'+'favourites'}">${lang == 'ar' ?  'المفضلة' : 'Favourites'}</a>
  <a href="${APP_URL+'/'+'myreservations'}">${lang == 'ar' ?  'حجوزاتي' : 'My Bookings'}</a>
  <hr>
  <a href="${APP_URL+'/'+'account'}">${lang == 'ar' ?  'حسابي' : 'My Account'}</a>
  <a href="${APP_URL+'/'+'authenticationLogout'}">${lang == 'ar' ?  'تسجيل الخروج' : 'Logout'}</a>
  
  </div>`;
  },
  
  trigger:'click',
  html:true,
  offset:[0, 2]
  });
  }




// Mobile NavBar

$( "#openNav" ).click(function() {
    $('#mySidenav').addClass('open');
   // $('body').addClass('open-bg');
  });
  $( "#closeNav" ).click(function() {
    $('#mySidenav').removeClass('open');
   // $('body').removeClass('open-bg');
  });



// Person DropDown

const parser = new DOMParser();






// top button

mybutton = document.getElementById("top");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0; 
}


// loading page


$(window).on('load', function(){ 

 // setTimeout(function() {

    //$(".bg_load").hide("slow");
    $(".bg_load").animate({
      'opacity': 0
  }, 2000, function()  {
    $(".bg_load").hide();
  });

  //}, 1000);
  

});

$(function(){

  $(".dropdown-menu li a").click(function(){

    $(".dropdown-toggle:first-child").text($(this).text());
    $(".dropdown-toggle:first-child").val($(this).text());

 });

});


function showNoteAlert({msg,color='#009DAE',confirmButtonText=(lang == 'ar' ? 'تأكيد' : 'Ok'),isSuccess = false }={},onSuccess) {



  Swal.fire({
    title: msg,
    confirmButtonColor: color,
    showCancelButton: true,
    showCloseButton: true,
    confirmButtonText:confirmButtonText,
    cancelButtonText: lang == 'ar' ? 'لا' : 'Close',
  
    icon: isSuccess == false ? 'error' : "success",
   //iconHtml: iconHtml,

    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  }).then(function(res) {
    if (!res.isDismissed) {
      if (onSuccess  != null) {
        onSuccess();

      }
    }
  });


}

$('.textarea').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
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


////////////////////////////////////////////////////////////////////////////////////////// Helpers Apis


function showLoading(eleId) {

  $('#'+eleId).css({
    'display': 'flex',
    'flex-direction': 'column',
    'width': '100%',
  
  });


  var configs = {
    'overlayBackgroundColor': '#009DAE',
    'overlayOpacity': .4,
    'spinnerIcon': 'ball-fussion',
    'spinnerColor': '#FFE652',
    'spinnerSize': '1x',
    'overlayIDName': 'overlay',
    'spinnerIDName': 'spinner',
    'offsetY': 0,
    'offsetX': 0,
    "lockScroll": true,
    'containerID': eleId,
  
  };
  
  JsLoadingOverlay.show(configs);
}

function hideLoading() {
// Hide the loading overlay.
   JsLoadingOverlay.hide();

}





function sendAjaxRequest({url, method , data,}={}) {

  var request = $.ajax({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
 }
,
    url: url,
    type:method,
    data: data,
    dataType: 'json', 

        });
      

  return request;  

}


function getCountriesOrStatesOrCountries({url,parentId, elementId,loadingElementId ,isFromHome = false}={},onSuccess){



  
  showLoading(loadingElementId);


  var request = sendAjaxRequest({url:(APP_URL+'/'+parentId+url),method: 'GET',data:null});


      request.done(function(response) {


      var selectElement = document.getElementById(elementId);
     $('#'+elementId).empty();

     if (isFromHome == true) {
      selectElement.add(new Option());
      selectElement.add(new Option(lang == 'ar' ?  'الكل' : 'All' ,'all'));
     }

     if ( response['data'].length != 0) {
      $('.'+elementId).show();

      selectElement.add(new Option());

      response['data'].forEach((item, i) => {
  //      selectElement.add(new Option(item['name'],item['id'],( i == 0 ? true : false)));

        selectElement.add(new Option(item['name'],item['id']));
      });

     }else{
      $('.'+elementId).hide();

     }


      hideLoading() ;
      if (onSuccess  != null) {
        onSuccess();

      }


        });
 
        request.fail(function(jqXHR, textStatus) {

          
        });


 return 1;

}



function getSpecializationOrMoreServices({url,parentId, elementId,loadingElementId,isFromHome = true }={},onSuccess){


 // console.log((APP_URL+'/'+$('#'+elementId).val()+url));

  showLoading(loadingElementId);

  var request = sendAjaxRequest({url:(APP_URL+'/'+parentId+url),method: 'GET',data:null});


      request.done(function(response) {


      var selectElement = document.getElementById(elementId);
      $('#'+elementId).empty();


      if ( response['data'].length != 0) {
        $('.'+elementId).show();


      selectElement.add(new Option());
      if (isFromHome == true) {
        selectElement.add(new Option(lang == 'ar' ?  'الكل' : 'All' ,'all'));

      }

      response['data'].forEach((item, i) => {
        selectElement.add(new Option(lang == 'ar' ? item['name_ar'] : item['name_en'],item['id'],( i == 0 ? true : false)));
      });

    }else{
      $('.'+elementId).hide();

     }

      hideLoading() ;



      if (onSuccess  != null) {
        
        onSuccess();

      }


        });
 
        request.fail(function(jqXHR, textStatus) {

          
        });


 return 1;

}









