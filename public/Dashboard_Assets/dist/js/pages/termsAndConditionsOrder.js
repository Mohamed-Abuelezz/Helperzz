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










            //////////////////////////////////////////////////////////////////////
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