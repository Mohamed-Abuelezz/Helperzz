$(document).ready(function() {



    $(".remove").click(function(){
      var id=$(this).attr("data-id");

      showNoteAlert({msg: lang == 'ar' ? `هل تريد الحذف من المفضلة ؟` : `Do you want to remove from the favourites? `,
    confirmButtonText: lang == 'ar' ? 'الحذف' : 'Remove' }, function(){

  
   var request = sendAjaxRequest({url:(APP_URL+'/'+id+'/api/favourites/remove'),method: 'POST',data:{}});
  
  
   request.done(function(response) {
  
  if (response['data'] == 1) {
    $.Toast( lang ?  "تم" : "Done", response['message'] ,  "success",{
      position_class:"toast-top-right",
    });

    $(`#card_${id}`).remove();
  }
  
  
  
  
      });
    request.fail(function(jqXHR, textStatus) {
      $.Toast( lang ?  "خطأ" : "Error", jqXHR['statusText'] ,  "error",{
        position_class:"toast-top-right",
    });


  
  
    });
  });
  
  
  });
  
  
    });