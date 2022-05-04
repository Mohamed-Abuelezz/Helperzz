

if (isProviderAuth) {
  const parser2 = new DOMParser();

var popover = new bootstrap.Popover(document.querySelector('.profileImageProvider'), {
  content:  function () {
    return `<div class="dropdown-profile-content">
    <a href="${APP_URL+'/'+profile_id+'/profile'}">${lang == 'ar' ?  'صفحتي الشخصية' :  'My Profile'}</a>
    <a href="${APP_URL+'/'+'provider/wallet'}"> ${lang == 'ar' ?  'محفظتي' :  'My Wallet'}</a>
    <hr>
    <a href="${APP_URL+'/'+'provider/account'}"> ${lang == 'ar' ?  'حسابي' :  'My Account'}</a>
    <a href="${APP_URL+'/'+'authenticationLogout'}"> ${lang == 'ar' ?  'تسجيل الخروج' :  'Logout'}</a>

  </div>`;
  },
  
  trigger:'click',
  html:true,
  offset:[0, 2]
});
}



  var pageHeight = window.innerHeight;

  document.addEventListener('scroll', function(e){

    var nextScroll = $(this).scrollTop();

    if(nextScroll> pageHeight) {
        $("nav").css({
            backgroundColor : "var(--primary)",
            padding: "15px 100px",
            position: "fixed",
            top: "0",
            left: "0",
            width: "100%",
            zIndex: "999",
            transition :"1s",
            boxShadow : '5px 5px 80px'       
          });

      } else {
        $("nav").css({
            backgroundColor :" rgba(0, 0, 0, 0.1)",
            padding: "15px 100px",
            position: "fixed",
            top: "0",
            left: "0",
            width: "100%",
            zIndex: "999",
            transition :"1s"        ,
            boxShadow : '5px 10px 100px'       
    
          });
      }


    });
  

//Section Header

$('.slider').slick({
    autoplay: true,
    speed: 800,
    lazyLoad: 'progressive',
    arrows: true,
    dots: false,
    rtl: lang == 'ar' ? true : false,
      prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
      nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>', 

  }).slickAnimation();
  
  
  
  $('.slick-nav').on('click touch', function(e) {
  
      e.preventDefault();
  
      var arrow = $(this);
  
      if(!arrow.hasClass('animate')) {
          arrow.addClass('animate');
          setTimeout(() => {
              arrow.removeClass('animate');
          }, 1600);
      }
  
  });


  // Reviews Section
  $('.reviews .items').slick({
    infinite: true,
    slidesToShow: 3,
    autoplay:true,
    slidesToScroll: 1,
    centerMode: frameElement, 
    rtl: lang == 'ar' ? true : false,
    speed: 2000,

    responsive: [
        {
          breakpoint: 991.98,
          settings: {
            lazyLoad: 'progressive',
            arrows: true,
            dots: false,
        
            slidesToShow: 1,
    autoplay:true,
            infinite: true,        
            slidesToScroll: 1,
            centerMode: false,
            rtl: lang == 'ar' ? true : false,
          }
        },

    ]    
});

$('#prev').click(function(){

    $('.reviews .items').slick('slickPrev');

});


$('#next').click(function(){

    $('.reviews .items').slick('slickNext');

});