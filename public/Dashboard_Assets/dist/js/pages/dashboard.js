window.Echo.channel(`orders`)
    .listen('NewOrderSocket', (e) => {
       console.log(e);

       $('#orderCount').html(function(i, currentHTML){
        return +currentHTML + 1;
      });
    

    });