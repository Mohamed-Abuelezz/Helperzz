// import Echo from 'laravel-echo';

// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: '{{env("PUSHER_KEY")}}',
//   cluster: 'eu',
//   encrypted: true,
//   authEndpoint: '{{env("APP_URL")}}/broadcasting/auth'
// });


// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: process.env.MIX_PUSHER_APP_KEY,
//   cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//   forceTLS: true
// });



window.Echo.channel(`orders`)
    .listen('NewOrderSocket', (e) => {
       console.log(e);


       $('#myTable > tbody').append(
         `
         <tr  data-id="${e.order.id}">

         <td>${e.order.id}</td>
         <td>${e.order.user['name']}</td>
         <td> ${e.order.user['country']['name']} . ' / ' . ${ e.order.user['state']['name']} . ' / ' . ${e.order.user['city']['name']} </td>
         <td>${e.order.provider['name']} </td>
         <td> ${ e.order.provider['country']['name']}. ' / ' . ${ e.order.provider['state']['name']}  . ' / ' . ${ e.order.provider['city']['name']} </td>

         <td> ${e.order.describe}  </td>

         <td class="d-flex flex-row justify-content-between g-5"  style="gap: 10px">

           <a href="#" id="accept" class="accept" style="color: green;" data-id="${e.order.id}" data-resource="orders/${e.order.id}"><i class="fas fa-thumbs-up"></i></a>
           <a href="#" id="reject" class="reject" style="color: red;" data-id="${e.order.id}" data-resource="orders/${e.order.id}"> <i class="fas fa-thumbs-down"></i></a>
          
         </td>
         <td> ${e.order.created_at} </td>


     </tr>
         
         `
       );


       $('#orderCount').html(function(i, currentHTML){
        return +currentHTML + 1;
      });
    

    });

// Echo.private(`orders.1`)
//     .listen('NewOrderSocket', (e) => {
//         console.log(e.order);
//     });

$(document).on("click", '#accept',function(){
        var resource = $(this).attr("data-resource");
        var order = $(this).attr("data-id");
      
              console.log(resource );
              console.log(order );
              console.log(APP_URL+'/'+ resource );
    
              var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'status':3}});
    
    
                request.done(function(response) {
    
                 toastr.success(response['message'])
    
                 $("tr[data-id='" + order + "']").remove();
    
                });
                
                request.fail(function(jqXHR, textStatus) {
    
                  toastr.error(jqXHR.responseText)
                  
                });}); 


 $(document).on("click", '#reject',function(){
                    var resource = $(this).attr("data-resource");
                    var order = $(this).attr("data-id");
                  
                          console.log(resource );
                          console.log(order );
                          console.log(APP_URL+'/'+ resource );
                
                          var request = sendAjaxRequest({url:(APP_URL+'/'+ resource),method: 'PUT',data:{'status':2}});
                
                
                            request.done(function(response) {
                
                             toastr.success(response['message'])
                
                             $("tr[data-id='" + order + "']").remove();
                
                             $('#orderCount').html(function(i, currentHTML){
                              return +currentHTML - 1;
                            });
                          


                            });
                            
                            request.fail(function(jqXHR, textStatus) {
                
                              toastr.error(jqXHR.responseText)
                              
                            });}); 
  
  
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////Helper
  







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