$(".delete").click(function(){
    var resource = $(this).attr("data-resource");
    var id = $(this).attr("data-id");

          console.log(resource );
          console.log(id );
          console.log(APP_URL+'/'+ resource );

           var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:null});


            request.done(function(response) {

             toastr.success(response['message'])

             $("tr[data-id='" + id + "']").remove();

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