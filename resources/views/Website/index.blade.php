<!DOCTYPE html>

<html lang="{{ Config::get('app.locale') }}">

<head>
    <!-- Required meta tags -->
    @include('Website.globalElements.meta')
    <title>
        {{ Config::get('app.locale') == 'en'? (\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name.' helps you communicate with professionals and service providers located near you for free and with ease. Browse now.'):( \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name.' يساعدك في التواصل مع اصحاب المهن ومقدمين الخدمات الموجدين بالقرب منك مجانا وبكل سهولة تصفح الان.') }}
    </title>
    <meta name="description"
        content="{{ Config::get('app.locale') == 'en'? 'You can see the providers and professions you need, search for them and see their reviews.':
         'يمكنك رؤية مقدمي الخدمات واصحاب المهن الذين تحتاجهم والبحث عنهم ورئية تقييماتهم .' }}">



    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->

    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">


    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/slick-1.8.1/slick/slick.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/slick-1.8.1/slick/slick-theme.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/aos-master/dist/aos.css') }}" />


    <!-- project css -->

    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/index.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/626efb0fb0d10b6f3e70310c/1g20o9dlp';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')




    <!------------------------------------- NavBar Section-->

    @if (Auth::check() && Auth::user()->hasVerifiedEmail())
        @include('Website.globalElements.navbar_userAuth')
    @elseif(Auth::guard('provider')->check() &&
        Auth::guard('provider')->user()->hasVerifiedEmail())
        @include('Website.globalElements.navbar_providerAuth')
    @else
        @include('Website.globalElements.navbar_guest')
    @endif
    <!-------------------------------------End NavBar Section-->





    <!------------------------------------- Header Section-->

    <header class="header-section">


        <div class="banner__slider">
            <div class="slider stick-dots">
                <div class="slide">
                    <div class="slide__img">
                        <img src="" alt="Welcome"
                            data-lazy=" {{ asset('Website_Assets/assets/images/wallper_1.jpg') }}"
                            class="full-image animated" data-animation-in="zoomInImage" />
                    </div>
                    <div class="slide__content ">
                        <div class="slide__content--headings text-center">

                            <p class="animated title" data-animation-in="fadeInUp" data-delay-in="0.3">
                                {{ Config::get('app.locale') == 'ar' ? 'أهلا بك' : 'Welcome' }}</p>
                            <h2 class="animated top-title" data-animation-in="fadeInUp">
                                {{ Config::get('app.locale') == 'ar'? 'سجل الان لتستطيع التواصل مع مقدمي الخدمات.': 'Register now to be able to communicate with service providers.' }}
                            </h2>
<br>
                            <!-- Google Play button -->
                            <div class="buttons d-flex flex-row justify-content-center" style="">
{{-- 
                                <div class="play" style="margin: 5px">
                                    <a href="https://www.kobinet.com.tr/" target="_blank" class="market-btn google-btn" role="button">
                                        <span class="market-button-subtitle">Download on the</span>
                                        <span class="market-button-title">Google Play</span>
                                      </a>
                                      
                                </div> --}}

                                <div class="startNow" style="margin: auto 5px">
                                    <a href="{{route('home')}}" class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ابدأ الان' : 'Start Now' }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="slide__img">
                        <img src="" alt="communicate"
                            data-lazy="{{ asset('Website_Assets/assets/images/wallper_2.jpeg') }}"
                            class="full-image animated" data-animation-in="zoomOutImage" />
                    </div>
                    <div class="slide__content slide__content__right">
                        <div class="slide__content--headings text-right">
                            <p class="animated top-title" data-animation-in="fadeInLeft" data-delay-in="0.2">
                                {{ Config::get('app.locale') == 'ar'? 'اذا كنت صاحب مهنة سجل الان كمقدم خدمة حتي تستطيع التواصل مع الزبائن ايضا.': 'If you are a professional, register now as a service provider so that you can communicate with customers as well.' }}
                            </p>
                            <h2 class="animated title" data-animation-in="fadeInLeft">
                                {{ Config::get('app.locale') == 'ar' ? 'مقدم الخدمة' : 'Service Provider' }}</h2>
<br>
                                <div class="buttons d-flex flex-row justify-content-start" style="">
                                    {{-- 
                                                                    <div class="play" style="margin: 5px">
                                                                        <a href="https://www.kobinet.com.tr/" target="_blank" class="market-btn google-btn" role="button">
                                                                            <span class="market-button-subtitle">Download on the</span>
                                                                            <span class="market-button-title">Google Play</span>
                                                                          </a>
                                                                          
                                                                    </div> --}}
                                    
                                                                    <div class="startNow" style="margin: auto 5px">
                                                                        <a href="{{route('home')}}" class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ابدأ الان' : 'Start Now' }}</a>
                                                                    </div>
                                 </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="slide__img">
                        <img src="" alt="contact image"
                            data-lazy="  {{ asset('Website_Assets/assets/images/wallper_3.jpg') }}"
                            class="full-image animated" data-animation-in="zoomInImage" />
                    </div>
                    <div class="slide__content slide__content__left">
                        <div class="slide__content--headings text-left">
                            <p class="animated top-title" data-animation-in="fadeInRight" data-delay-in="0.2">
                                {{ Config::get('app.locale') == 'ar'? 'تستطيع التواصل مع مقدمي الخدمات بشكل مجاني.': 'You can contact service providers for free.' }}
                            </p>
                            <h2 class="animated title" data-animation-in="fadeInRight">
                                {{ Config::get('app.locale') == 'ar' ? 'التكلفة' : 'The Cost' }}</h2>
                                <br>
                                <div class="buttons d-flex flex-row justify-content-start" style="">
                                    {{-- 
                                                                    <div class="play" style="margin: 5px">
                                                                        <a href="https://www.kobinet.com.tr/" target="_blank" class="market-btn google-btn" role="button">
                                                                            <span class="market-button-subtitle">Download on the</span>
                                                                            <span class="market-button-title">Google Play</span>
                                                                          </a>
                                                                          
                                                                    </div> --}}
                                    
                                                                    <div class="startNow" style="margin: auto 5px">
                                                                        <a href="{{route('home')}}" class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ابدأ الان' : 'Start Now' }}</a>
                                                                    </div>
                                 </div>
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                    fill="none" stroke="currentColor">
                    <circle r="20" cy="22" cx="22" id="test">
                </symbol>
            </svg>
        </div>

    </header>

    <!------------------------------------- End Header Section-->
        <main>

    <!-------------------------------------  Our message Section-->
    <section class="ourmessage">


        <div class="message " data-aos="zoom-out-left">
            <p>

                {{ Config::get('app.locale') == 'ar'? 'موقع ' .\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name .' الهدف منه سهولة التواصل بينك وبين مقدمي الخدمات والمساعدة علي القضاء علي مشاكل كثيره مثل البطاله حيث يمكن اصحاب المهن ايضا من التسجيل والتواصل مع من حوله في كل مكان وقبول الحجوزات والتواصل معهم كما يمكن مقدم الخدمة ايضا روئية الاحصائيات الخاصه بصفحته الشخصية .': \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name .'  website aims to facilitate communication between you and service providers and to help eliminate many problems such as unemployment, where professionals can also register and communicate with those around him everywhere, accept reservations and communicate with them, and the service provider can also see the statistics on his personal page. ' }}

            </p>

                                <div class="buttons d-flex flex-row justify-content-center" style="margin-top: 10px">

                                    
                                                                    <div class="startNow" style="margin: auto 5px">
                                                                        <a href="{{route('home')}}" class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ابدأ الان' : 'Start Now' }}</a>
                                                                    </div>
                                 </div>
        </div>
        <div class="image">
            <img src="{{ asset('Website_Assets/assets/images/message.png') }}" alt="our message image">
        </div>






    </section>

    <!------------------------------------- End Our message Section-->
    <!-------------------------------------  Section Reviews-->

    <section class="reviews">

        <div class="items container" data-aos="fade-up" data-aos-duration="3000">
            
            <div class="item">
                <img src="{{ asset('Website_Assets/assets/icons/quitos.png') }}" alt="quitos image">
                <img src="{{ asset('Website_Assets/assets/images/review_1.jpg') }}" alt="Ms.Yassmin Alaa">

                <p class="p-2">

                    موقع {{ \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name }} افادني
                    كثيرا حيث جلب لي الكثير من الطلبة في منطقتي وساعدني كثيرا في التواصل معهم

                </p>

                <h6>Ms.Yassmin Alaa</h6>
            </div>

            <div class="item" data-aos="fade-up" data-aos-duration="3000">
                <img src="{{ asset('Website_Assets/assets/icons/quitos.png') }}" alt="quitos image">
                <img src="{{ asset('Website_Assets/assets/images/review_2.jpg') }}" alt="Mr.Hamze Eid">

                <p class="p-2"> ساعدني
                    {{ \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name }} البحث عن مقدمي
                    الخدمات في منطقتي والتواصل معهم بكل سهولة ويسر ومتابعة ايضا حجوزاتي
                </p>

                <h6>Mr.Hamze Eid</h6>
            </div>

            <div class="item" data-aos="fade-up" data-aos-duration="3000">
                <img src="{{ asset('Website_Assets/assets/icons/quitos.png') }}" alt="quitos image">
                <img src="{{ asset('Website_Assets/assets/images/review_3.jpg') }}" alt="Dr.Sayed Ahmed">

                <p class="p-2">
                    {{ \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name }} ساعدني في
                    التواصل مع المرضي وقبول الحجوزات وايضا ساعدني في التواصل مع الحالات الطارئة القريبة مني.
                </p>
                <h6>Dr.Sayed Ahmed</h6>
            </div>



        </div>
        {{-- <div class="controllers">
      <img src="./assets/icons/prev.png" alt="" id="prev">
      <img src="./assets/icons/next.png" alt="" id="next">
    </div> --}}

    </section>

    <!------------------------------------- End Reviews Section-->
  </main>
    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
        var isProviderAuth = false;
    </script>

    @if (Auth::guard('provider')->check())
        <script>
            var profile_id = {!! json_encode(Auth::guard('provider')->user()->id) !!};

            isProviderAuth = true;
        </script>
    @endif
    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/slick-1.8.1/slick/slick.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/slick-1.8.1/slick-animation-master/slick-animation.min.js') }}">
    </script>
    <script src="{{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>



    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>
    <script src=" {{ asset('Website_Assets/js/index.js') }}"></script>

    <!--------------------------------------------------------------------------------------->

</body>

</html>
