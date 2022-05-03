// Person DropDown

const parser2 = new DOMParser();

var popover = new bootstrap.Popover(document.querySelector('.profileImageProvider'), {
  content:  function () {
    return `<div class="dropdown-profile-content">
    
    <a href="${APP_URL+'/'+profile_id+'/profile'}">${lang == 'ar' ?  'صفحتي الشخصية' :  'My Profile'}</a>
    <hr>
    <a href="${APP_URL+'/'+'provider/account'}"> ${lang == 'ar' ?  'حسابي' :  'My Account'}</a>
    <a href="${APP_URL+'/'+'authenticationLogout'}"> ${lang == 'ar' ?  'تسجيل الخروج' :  'Logout'}</a>

  </div>`;
  },
  
  trigger:'click',
  html:true,
  offset:[0, 2]
});
    // <a href="${APP_URL+'/'+'provider/wallet'}"> ${lang == 'ar' ?  'محفظتي' :  'My Wallet'}</a>

// var myEl = document.getElementById('wallet');

// myEl.addEventListener('click', function() {
//     $('#modal').modal('toggle')
// }, false);
// $(document).on("click", "#wallet", function() {
//     $('.modal').modal('toggle')
// });









const labels = [];
const dataChart = [];

Object.keys(views).forEach(function(key, i) {


  labels.push(key);
let count = 0;
  for (let i = 0; i <  views[key].length; i++) {
count++;
  }
  dataChart.push(count);

});

const data = {
  labels: labels,
  
  datasets: [{
    label:lang == 'ar' ? `عددالمشاهدات`  : `Views`,
    backgroundColor: '#009DAE',
    borderColor: '#FFE652',
    pointStyle: 'circle',
    pointRadius: 10,
    pointHoverRadius: 15,

    data: dataChart,
    fill: true,

  }]
};

const config = {
  type: 'line',
  data: data,
  
  options: {
    responsive: true,
    plugins: {

    }

  }
};


const myChart = new Chart(
  document.getElementById('myChart'),
  config,
  
);



// Apis Req


  $(document).on("click", "#reservationDetails_btn" , function() {

var id = $(this).attr("data-id");

  var reserv = $.map(reservations['data'], function(element) { 
    if (element['id'] == id ) {
      return element
    }
 })[0];
 
  
  $('#reservationModalTitle').html('');
  $('#reservationModalbody').html('');




  $('#reservationModalTitle').append( lang == 'ar' ?  `تفاصيل الحجز  #${$(this).attr("data-id")}` :   `Reservation Details  #${$(this).attr("data-id")}`);
  $('#reservationModalbody').append(`

  <h6 style="color:var(--primary);font-size:20px;text-align:auto">${lang == 'ar' ? 'رقم المستخدم التعريفي' : 'User Id'}</h6>
  <p style="color:black;font-weight:bold;font-size:15px">${reserv['user']['id']}</p>
  <br/>
  <hr style="width:80%;margin:auto"/>
  <br/>

  <h6 style="color:var(--primary);font-size:20px;text-align:auto">${lang == 'ar' ? 'الاسم' : 'Name'}</h6>
  <p style="color:black;font-weight:bold;font-size:15px">${reserv['user']['name']}</p>

  <br/>
  <hr style="width:80%;margin:auto"/>
  <br/>

  <h6 style="color:var(--primary);font-size:20px;text-align:auto">${lang == 'ar' ? 'البريد الاليكنروني' : 'Email'}</h6>

   <a href="mailto:${reserv['user']['email']}?subject=${
     lang == 'ar' ?
    `السلام عليكم . اتحدث معك بخصوص الحجز رقم ${reserv['id']} المرسل عن طريق Helperzz الي مقدم الخدمة  ${reserv['provider']['name']} `
     :  
   `Hello . I am talking to your reservation number ${reserv['id']} sent via Helperzz to the service provider   ${reserv['provider']['name']} ` }" target="_blank"> <p style="color:black;font-weight:bold;font-size:15px"> ${reserv['user']['email']} </p>
   </a>

  <br/>
  <hr style="width:80%;margin:auto"/>
  <br/>

  <h6 style="color:var(--primary);font-size:20px"> ${lang == 'ar' ? 'رقم الهاتف ' : 'Phone'}</h6>
 <a  href="//api.whatsapp.com/send?phone=${reserv['user']['phone']}&text=${lang == 'ar' ? `السلام عليكم . اتحدث معك بخصوص الحجز رقم ${reserv['id']} المرسل عن طريق Helperzz الي مقدم الخدمة ${reserv['provider']['name']} `
  :  `Hello . I am talking to your reservation number ${reserv['id']} sent via Helperzz to the service provider ${reserv['provider']['name']}`}" target="_blank"  > <p style="color:black;font-weight:bold;font-size:15px">${reserv['user']['phone']}</p> </a>
  
  <br/>
  <hr style="width:80%;margin:auto"/>
  <br/>

  <h6 style="color:var(--primary);font-size:20px">${lang == 'ar' ?'الموقع' :  'Location'}</h6>
  <p style="color:black;font-weight:bold;font-size:15px">${reserv['user']['country']['name']}/${reserv['user']['state']['name']}/${reserv['user']['city']['name']}</p>
  
  <br/>
  <hr style="width:80%;margin:auto"/>
  <br/>

  <h6 style="color:var(--primary);font-size:20px"> ${lang == 'ar' ? 'تفاصيل الحجز' :  'Details'}</h6>
  <p style="color:black;font-weight:bold;font-size:15px">
  ${reserv['describe']}
  </p>
  `);



});

var orderId;

$(".accept_btn").click(function(){


orderId = $(this).attr("data-id");
// $('#termsModal').data('id',$(this).attr("data-id")); //setter
$('#termsModal').modal('toggle')


});




$("#agreeTerm").click(function(){
  showLoading('loadingAgree');

   var request = sendAjaxRequest({url:(APP_URL+'/'+orderId+'/api/provider/acceptOrder'),method: 'POST',data:{}});



 request.done(function(response) {
  $('#termsModal').modal('toggle')


if (response['data'] == 0) {
  showNoteAlert({msg: lang == 'ar' ? 'لايوجد رصيد كافي في محفظتك لقبول الطلب.' : 'There is not enough balance in your wallet to accept the order.',confirmButtonText: lang == 'ar' ? 'اعادة الشحن' : 'Recharge' }, function(){
    window.open(
      APP_URL + "/provider/wallet",
      '_blank' // <- This is what makes it open in a new window.
    );
    
  });
} else {

  
  $(`.status[data-id=${orderId}]`).html("")

  if (response['data']['user']['image'] != null) {
  
    $(`.order_image[data-id=${orderId}]`).attr("src", `${APP_URL + '/storage/' + response['data']['user']['image'] }`);
  }
  

  $(`.order_name[data-id=${orderId}]`).append(`
  ${ response['data']['user']['name'].length >= 22 ? (response['data']['user']['name'].substring(0, 22)+'...')  :  response['data']['user']['name']  }
  `);
  $(`.order_address[data-id=${orderId}]`).append(`
  ${ response['data']['user']['country']['name']} / ${ response['data']['user']['city']['name'] }
  `);
  $(`.status[data-id=${orderId}]`).append(`
  ${ lang == 'ar'? response['data']['order_status']['descProvider_ar']: response['data']['order_status']['descProvider_en'] }`);
  
  if (response['data']['ordersStatus_id'] == 4) {
    $(`.status[data-id=${orderId}]`).append(`
    <div>
    <a data-bs-target="#reservation_Modal"  data-bs-toggle="modal" id="reservationDetails_btn"
        style="color: var(--primary);text-decoration: underline;cursor: pointer;" data-id="${response['data']['id']}">تفاصيل
        الحجز</a>
  </div>
  
    `);
  
  }



}



hideLoading() ;


});


request.fail(function(jqXHR, textStatus) {
hideLoading() ;

});

});





$(`.refused_btn`).click(function(){


  orderId = $(this).attr("data-id");

  showNoteAlert({msg: lang == 'ar' ? 'هل تريد رفض الحجز؟' : 'Do you want to decline the reservation?',color:'red'}, function(){

    var request = sendAjaxRequest({url:(APP_URL+'/'+orderId+'/api/provider/refusedOrder'),method: 'POST',data:{}});

    request.done(function(response) {


      $(`.status[data-id=${orderId}]`).html("")
      $(`.status[data-id=${orderId}]`).append(`${ lang == 'ar'? response['data']['order_status']['descProvider_ar']: response['data']['order_status']['descProvider_en'] }`);
    
      $(`.status[data-id=${orderId}]`).css('color', 'red')
  });  

  request.fail(function(jqXHR, textStatus) {




});  





});  
  
  });
  




