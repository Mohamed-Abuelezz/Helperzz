$(document).ready(function() {

// image picker
      function readURL(input,isUser=true) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              if (isUser) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

              } else {

                $('#imagePreviewProvider').css('background-image', 'url('+e.target.result +')');
                $('#imagePreviewProvider').hide();
                $('#imagePreviewProvider').fadeIn(650);

              }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
  
    $("#imageUploadProvider").change(function() {
      readURL(this,false);
  });



  $(".js-example-basic-multiple ").select2({
    maximumSelectionLength: 5,
    placeholder:lang == 'ar' ? 'حدد المزيد من التخصصات' : "Select more specialties"    ,
    allowClear: true,     
    dir: lang == 'ar' ? "rtl"  :  "ltr"

  });
  



});

  // Google Maps
  var markersArray = [];

    // Initialize and add the map
function initMap() {
    // The location of Uluru
    const uluru = { lat: Number(lat), lng: Number(lng) };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
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

        if (oldLng != null) {
          placeMarker({ lat: Number(oldLat), lng: Number(oldLng) },map);

        }

        google.maps.event.addListener(map, 'click', function(event) {
          placeMarker(event.latLng,map);
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




// Selects
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
        placeholder: lang == 'ar' ? 'المدينة [اختياري]' :"City ​​[optional]"

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
        placeholder: lang == 'ar' ? 'المدينة [اختياري]' :"City ​​[optional]"

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

  });


// Apis Mthods


// $('#country').on('change', function() {

//   getCountriesOrStatesOrCountries({url:'/api/states',parentId:$(this).val(),elementId:'state',loadingElementId:'myLoadingState'}, function(){
  
//     getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$('#state').val(),elementId:'cities',loadingElementId:'myLoadingCity'})
//   })

  
//   }); 




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
