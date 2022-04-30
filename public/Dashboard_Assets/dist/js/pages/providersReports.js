$('#actions').change(function(){ 
    var value = $(this).val();
    var resource = $(this).attr("data-resource");
    var id = $(this).attr("data-id");

console.log('ok');

var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'status':value}});


request.done(function(response) {

 toastr.success(response['message'])

 $("tr[data-id='" + id + "']").remove();

});

request.fail(function(jqXHR, textStatus) {

  toastr.error(jqXHR.responseText)
  
});



});




// $(document).on("click", '#accept',function(){

//     var resource = $(this).attr("data-resource");
//     var order = $(this).attr("data-id");
  
//           console.log(resource );
//           console.log(order );
//           console.log(APP_URL+'/'+ resource );

//           var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'status':3}});


//             request.done(function(response) {

//              toastr.success(response['message'])

//              $("tr[data-id='" + order + "']").remove();

//             });
            
//             request.fail(function(jqXHR, textStatus) {

//               toastr.error(jqXHR.responseText)
              
//             });
//         }); 


// $(document).on("click", '#reject',function(){
//                 var resource = $(this).attr("data-resource");
//                 var order = $(this).attr("data-id");
              
//                       console.log(resource );
//                       console.log(order );
//                       console.log(APP_URL+'/'+ resource );
            
//                       var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'status':2}});
            
            
//                         request.done(function(response) {
            
//                          toastr.success(response['message'])
            
//                          $("tr[data-id='" + order + "']").remove();
            
//                          $('#orderCount').html(function(i, currentHTML){
//                           return +currentHTML - 1;
//                         });
                      


//                         });
                        
//                         request.fail(function(jqXHR, textStatus) {
            
//                           toastr.error(jqXHR.responseText)
                          
//                         });}); 



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