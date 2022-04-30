
$('.myActiveSwitch').change(
    function(){
  
      var resource = $(this).attr("data-resource");
      var user = $(this).attr("data-id");
  
            console.log(resource );
            console.log(user );
            console.log(APP_URL+'/'+ resource );
  
             var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'isActive':$(this).is(':checked') ? 1 : 0}});
  
  
              request.done(function(response) {
  
               toastr.success(response['message'])
  
              });
              
              request.fail(function(jqXHR, textStatus) {
  
                toastr.error(jqXHR.responseText)
                
              });
  
        
        
    });




    $(".delete").click(function(){
        var resource = $(this).attr("data-resource");
        var user_id = $(this).attr("data-id");
    
              console.log(resource );
              console.log(user_id );
              console.log(APP_URL+'/'+ resource );
    
               var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'Delete',data:null});
    
    
                request.done(function(response) {
    
                 toastr.success(response['message'])
    
                 $("tr[data-id='" + user_id + "']").remove();
    
                });
                
                request.fail(function(jqXHR, textStatus) {
    
                  toastr.error(jqXHR.responseText)
                  
                });}); 





                if ($('#cities').has('option').length == 0 ) {
                    getCountriesOrStatesOrCountries({url:'/api/states',parentId:$('#country').val(),elementId:'state'}, function(){
                    
                      getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$('#state').val(),elementId:'cities',});
                     })
                    
                  }
                  //getCountriesOrStatesOrCountries({url:'/cities',parentId:$('#state').val(),elementId:'cities',})
                  
                  
                  
                  $('#serviceCatogrey').on('change', function() {
                  
                    getSpecializationOrMoreServices({url:'/api/specializations',parentId:$(this).val(),elementId:'specialization'})
                    
                    
                    }); 
                  
                         
                    
                    $('#specialization').on('change', function() {
                  
                        getSpecializationOrMoreServices({url:'/api/moreServices',parentId:$(this).val(),elementId:'moreServices'})
                        
                        
                        }); 
                    // $('#specialization').on('change', function() {
                  
                    //     getCountriesOrStatesOrCountries({url:'/serviceCatogries',parentId:$(this).val(),elementId:'state'})
                        
                        
                    //     }); 





                  $('#country').on('change', function() {
                  
                    getCountriesOrStatesOrCountries({url:'/api/states',parentId:$(this).val(),elementId:'state'})
                    
                    
                    }); 
                  
                  
                  
                  
                    $('#state').on('change', function() {
                  
                      getCountriesOrStatesOrCountries({url:'/api/cities',parentId:$(this).val(),elementId:'cities'})
                  
                  
                        
                        
                        }); 
                  
                  
                  
                  
                  
                  
                  






////////////////////////////////////////////////////////////////////////////////////////// Helpers







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
  

  function getCountriesOrStatesOrCountries({url,parentId, elementId }={},onSuccess){


    console.log((APP_URL+'/'+$('#'+elementId).val()+url));

    $('#'+elementId).removeProp("disabled");

    var request = sendAjaxRequest({url:(APP_URL+'/'+parentId+url),method: 'GET',data:null});
    $('#'+elementId).attr("disabled", "disabled");     


        request.done(function(response) {

        console.log(response);

        var selectElement = document.getElementById(elementId);
        $('#'+elementId).empty();

        response['data'].forEach((item, i) => {
          selectElement.add(new Option(item['name'],item['id'],( i == 0 ? true : false)));
        });


        $('#'+elementId).removeAttr("disabled");

        if (onSuccess  != null) {
          onSuccess();

        }


          });
   
          request.fail(function(jqXHR, textStatus) {

          console.log(jqXHR);
            
          });


   return 1;

  }



  function getSpecializationOrMoreServices({url,parentId, elementId }={},onSuccess){


    console.log((APP_URL+'/'+$('#'+elementId).val()+url));

    $('#'+elementId).removeProp("disabled");

    var request = sendAjaxRequest({url:(APP_URL+'/'+parentId+url),method: 'GET',data:null});
    $('#'+elementId).attr("disabled", "disabled");     


        request.done(function(response) {

        console.log(response);

        var selectElement = document.getElementById(elementId);
        $('#'+elementId).empty();

        response['data'].forEach((item, i) => {
          selectElement.add(new Option(item['name_ar'],item['id'],( i == 0 ? true : false)));
        });


        $('#'+elementId).removeAttr("disabled");

        if (onSuccess  != null) {
          onSuccess();

        }


          });
   
          request.fail(function(jqXHR, textStatus) {

          console.log(jqXHR);
            
          });


   return 1;

  }