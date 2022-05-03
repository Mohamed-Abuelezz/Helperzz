<!DOCTYPE html>

<html lang="{{ Config::get('app.locale') }}">

<head>
    <!-- Required meta tags -->
    @include('Website.globalElements.meta')
    <title>
        {{ Config::get('app.locale') == 'en'? 'تواصل مع ادارة موقع  '.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name : 'Contact the  '.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name .' site administration' }}
    </title>
    <meta name="description"
        content="{{ Config::get('app.locale') == 'en'? 'Contact us if you have any problem, inquiry or suggestion at any time throughout the week 24/24.': 'تواصل معنا اذا كان لديك اي مشكلة او استفسار او اقتراح في اي وقت طوال ايام الاسبوع طوال اليوم 24/24.' }}">

        <meta name="googlebot" content="index,follow">


    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">


    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />


    <!-- project css -->
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/contactUs.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

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



    <!------------------------------------- Bookings Section-->

    <br>
    <br>
    <br>
    <br>

    <main>
    <div class="container">


        <div class="row order-last justify-content-between g-5">






            <div class="fields col-sm-12 col-xl-6 container d-flex flex-column justify-content-center flex-wrap border p-4">
                <form method="POST" action="{{ route('contactUs.send') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="">
                        <label for="nameFormControlInput" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'اسم المستخدم' : 'Username' }}</label>
                        <input type="text"
                            class="form-control  custome-textFiled @error('name') is-invalid @enderror"
                            id="nameFormControlInput " placeholder="medo" value="{{ old('name') }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <br>

                    <div class="">
                        <label for="emailFormControlInputUser" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}</label>
                        <input type="email"
                            class="form-control  custome-textFiled  @error('email') is-invalid @enderror"
                            style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                            id="emailFormControlInputUser" name="email" value="{{ old('email') }}"
                            placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <br>

                    <div class="">
                        <label for="exampleFormControlTextarea1 " class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'الرسالة' : 'Message' }}</label>
                        <textarea class="form-control  textarea custome-textFiled   @error('message') is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="4" maxlength="500" name="message">
                            {{ old('message') }}
                        
                        </textarea>
                        <div id="the-count">
                            <span id="current">0</span>
                            <span id="maximum">/ 500</span>
                        </div>
                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <br>
                    <div class="">
                        <label for="formFile" class="form-label ">
                            {{ Config::get('app.locale') == 'ar' ? 'ارفاق ملف [اختياري]' : 'attach file [optional] ' }}</label>
                        <input class="form-control  custome-textFiled" type="file" name="image"
                            id="formFile">
                    </div>
                    <br>


                    <button type="submit" class="button_1_style text-center" style="width: 100%">
                        {{ Config::get('app.locale') == 'ar' ? 'ارسال' : 'Send' }}</button>

                </form>
            </div>

            <div class="contctInformations  col-sm-12 col-xl-4 border p-4">

                <h6> {{Config::get('app.locale') == 'ar' ? 'رقم الهاتف' : 'Phone'}}</h6>
                <p>+201063898262</p>
                <hr style="width: 60%">
                <h6> {{Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email'}}</h6>
                <p>contact@helperzz.com</p>
                <hr style="width: 60%">
                <h6>{{Config::get('app.locale') == 'ar' ? 'العنوان' : 'Location'}}</h6>
                <p>Cairo/Giza</p>
                <hr>
                <h6><a href="https://www.facebook.com/Helperzz2022" target="_blank" style="color: black;font-size: 15px;text-decoration: none"><img src=" {{asset('Website_Assets/assets/icons/facebook-png-icon-12.jpg')}}" style="width: 35px;height: 35px;border-radius: 50%" alt="facebook icons" > {{ \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name }}</a></h6>
            </div>

        </div>
    </div>
</main>



    <br>
    <br>
    <br>
    <br>

    <!-------------------------------------End Bookings Section-->

    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
        var isProviderAuth = false;
    </script>


    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>


    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>


    @if (Auth::guard('provider')->check())
        <script>
            isProviderAuth = true;
            var profile_id = {!! json_encode(Auth::guard('provider')->user()->id) !!};

            if (isProviderAuth) {
                const parser2 = new DOMParser();

                var popover = new bootstrap.Popover(document.querySelector('.profileImageProvider'), {
                    content: function() {
                        return `<div class="dropdown-profile-content">
    <a href="${APP_URL+'/'+profile_id+'/profile'}">${lang == 'ar' ?  'صفحتي الشخصية' :  'My Profile'}</a>
    <a href="${APP_URL+'/'+'provider/wallet'}"> ${lang == 'ar' ?  'محفظتي' :  'My Wallet'}</a>
    <hr>
    <a href="${APP_URL+'/'+'provider/account'}"> ${lang == 'ar' ?  'حسابي' :  'My Account'}</a>
    <a href="${APP_URL+'/'+'authenticationLogout'}"> ${lang == 'ar' ?  'تسجيل الخروج' :  'Logout'}</a>

  </div>`;
                    },

                    trigger: 'click',
                    html: true,
                    offset: [0, 2]
                });
            }
        </script>
    @endif

    <!--------------------------------------------------------------------------------------->
    @error('msg')
        <script>
            $.Toast(lang ? "خطأ" : "Error", {!! json_encode($message) !!}, "error", {
                position_class: "toast-top-right",
            });
        </script>
    @enderror

    @if (\Session::has('msg'))
        <script>
            $.Toast(lang == 'ar' ? "تم" : "Done", {!! json_encode(\Session::get('msg')) !!}, "success", {
                position_class: "toast-top-right",
            });
        </script>
    @endif

</body>

</html>
