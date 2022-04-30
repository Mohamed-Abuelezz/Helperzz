$(document).ready(function() {



    $(".remove").click(function(){
  
  
  
  var id=$(this).attr("data-id");
   var request = sendAjaxRequest({url:(APP_URL+'/'+id+'/api/favourites/remove'),method: 'POST',data:{}});
  
  
   request.done(function(response) {
  
  if (response['data'] == 1) {
    $(`#card_${id}`).remove();
  }
  
  
  
  
      });
    request.fail(function(jqXHR, textStatus) {
  
  
  
    });
  
  
  });
  
  
    });