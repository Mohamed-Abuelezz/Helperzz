// Person DropDown
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

    // <a href="${APP_URL+'/'+'provider/wallet'}"> ${lang == 'ar' ?  'محفظتي' :  'My Wallet'}</a>


// $(document).on("click", "#wallet", function() {
//     $('.modal').modal('toggle')
// });


$(document).ready(function() {


  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreviewProvider').css('background-image', 'url('+e.target.result +')');
            $('#imagePreviewProvider').hide();
            $('#imagePreviewProvider').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUploadProvider").change(function() {
    readURL(this);
});

});


    // Selects

// Selects


$(".js-example-basic-multiple ").select2({
  maximumSelectionLength: 5,
  placeholder:lang == 'ar' ? 'حدد المزيد من التخصصات' : "Select more specialties"    ,
  allowClear: true,     
  dir: lang == 'ar' ? "rtl"  :  "ltr"

});


$(document).ready(function() {
  $('.select-itemState').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار المنطقه' : "Select a state",

    }
  );


  $('.select-itemCity').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار المدينة' :"Select a City"

    }
  );
  $('.select-itemState2').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار المنطقه' : "Select a state",

    }
  );


  $('.select-itemCity2').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار المدينة' :"Select a City"

    }
  );
  
  $('.select-itemServiceDepartment').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار قسم الخدمة' :"Select Service Department"

    }
  );

  $('.select-itemSpecialization').select2(
    {
      width:'resolve',
      selectionCssClass: 'select-item', // need to override the changed default
      placeholder: lang == 'ar' ? 'اختار تخصص الخدمة' :"Select The Specialization"

    }
  );

  
  $(".js-example-basic-multiple ").select2({
    maximumSelectionLength: 5,
    placeholder:lang == 'ar' ? 'حدد المزيد من التخصصات' : "Select more specialties"    ,
    allowClear: true,     
    dir: lang == 'ar' ? "rtl"  :  "ltr"

  });
});


  // Google Maps

  // Google Maps
  var markersArray = [];

    // Initialize and add the map
function initMap() {
    // The location of Uluru
    var uluru ;
    if (lat != null) {
      uluru = { lat: Number(lat), lng: Number(lng) };

    }else{

      uluru = { lat: Number(myLat), lng: Number(myLng) };

    }


    // The map, centered at Uluru
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12,
      center: uluru,
    });


      //placeMarker({ lat: Number(myLat), lng: Number(myLng) },map);

      if (oldLng != null) {
        placeMarker({ lat: Number(oldLat), lng: Number(oldLng) },map);

      }else  if (lat != null) {
        placeMarker({ lat: Number(lat), lng: Number(lng) },map);
  
      }




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


        google.maps.event.addListener(map, 'click', function(event) {
          placeMarker(event.latLng,map);
       });


       $('#flexSwitchCheckDefault').change(function() {
        if (!$(this).is(':checked')) {
          clearOverlays();
          $('#lat').val(null);
          $('#lng').val(null);

        }else{

          if (lat != null) {
            uluru = { lat: Number(lat), lng: Number(lng) };
            $('#lat').val(lat);
            $('#lng').val(lng);
  
          }else{
      
            uluru = { lat: Number(myLat), lng: Number(myLng) };
            $('#lat').val(myLat);
            $('#lng').val(myLng);
  
          }
      
          map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: uluru,
          });

          map.setOptions({styles: styles});

          placeMarker({ lat:uluru.lat, lng: uluru.lng },map);


          google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng,map);
         });

          

        }
          });

  }


 function placeMarker(location,map) {
  clearOverlays();
  var marker = new google.maps.Marker({
      position: location, 
      map: map,
      icon: pinSymbol('#FFE652')

  });
  var lat = marker.getPosition().lat();
  var lng = marker.getPosition().lng();
  

  $('#lat').val(lat);
  $('#lng').val(lng);

  markersArray.push(marker);


}

function clearOverlays() {
  for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
  }
  markersArray.length = 0;
}


function pinSymbol(color) {
  return {
      path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
      fillColor: color,
      fillOpacity: 1,
      strokeColor: '#000',
      strokeWeight: 2,
      scale: 1
  };
}




////////////////////////////////// apis


$('.select-itemState').on('change', function() {

  getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$(this).val(),elementId:'cities',loadingElementId:'myLoadingCity'})


    
    
    }); 


    $('.select-itemState2').on('change', function() {

      getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$(this).val(),elementId:'cities2',loadingElementId:'myLoadingCity2'})
  
  
        
        
        }); 

        $('.select-itemServiceDepartment').on('change', function() {

      
      
              getSpecializationOrMoreServices({url:'/api/specializations',parentId:$(this).val(),elementId:'Specialization' ,loadingElementId:'myLoadingSpecialization',isFromHome: false}, function(){

            
            }); 



            
          }); 


          $('.select-itemServiceDepartment').on('change', function() {

      
      
            getSpecializationOrMoreServices({url:'/api/specializations',parentId:$(this).val(),elementId:'Specialization' ,loadingElementId:'myLoadingSpecialization',isFromHome: false}, function(){

              $('#moreServices').empty();

          
          }); 



          
        }); 


        $('.select-itemSpecialization').on('change', function() {

      
      
          getSpecializationOrMoreServices({url:'/api/moreServices',parentId:$(this).val(),elementId:'moreServices' ,loadingElementId:'myLoadingMoreServices',isFromHome: false}, function(){

        
        }); 



        
      }); 
