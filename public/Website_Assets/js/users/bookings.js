$(document).ready(function() {



  $(".remove").click(function(){



var id=$(this).attr("data-id");
var request = sendAjaxRequest({url:(APP_URL+'/'+id+'/api/reservations/remove'),method: 'POST',data:{}});


request.done(function(response) {

if (response['data'] == 1) {
  $(`#card_${id}`).remove();
}




    });
    request.fail(function(jqXHR, textStatus) {



  });


});


  });







  window.Echo.private(`changeOrderStatus.${userId}`)
  .listen('ChangeOrderStatus', (e) => {
     console.log(e);

     $(`.status[data-id=${e.order.id}]`).html("")
     $(`.status[data-id=${e.order.id}]`).append(`
        ${lang == 'ar' ? e.order.order_status['descUser_ar'] :  e.order.order_status['descUser_en'] }
     `);

if (e.order.ordersStatus_id == 1 || e.order.ordersStatus_id == 3 ) {

  $(`.status[data-id=${e.order.id}]`).css('color', 'orange')

}else if (e.order.ordersStatus_id == 2 || e.order.ordersStatus_id == 5) {
  $(`.status[data-id=${e.order.id}]`).css('color', 'red')
  
}else{
  $(`.status[data-id=${e.order.id}]`).css('color', 'green')

}


if (e.order.ordersStatus_id == 4) {
  $(`.remove[data-id=${e.order.id}]`).remove();
  
}

  });
