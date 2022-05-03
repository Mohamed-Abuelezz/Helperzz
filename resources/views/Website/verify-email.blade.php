<!DOCTYPE html>

<html lang="{{ Config::get('app.locale') }}">


<head>
  <!-- Required meta tags -->
  @include('Website.globalElements.meta')

  <title>
    {{ Config::get('app.locale') == 'en'? 'verify email':'تأكيد البريد الاليكنروني'}}
</title>

  <meta name='robots' content="noindex,nofollow">



    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />
        <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />


    <!-- project css -->
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/verify-email.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')


    <!------------------------------------- NavBar Section-->

    @include('Website.globalElements.navbar_guest')

    <!-------------------------------------End NavBar Section-->


    <!------------------------------------- Bookings Section-->

    <br>
    <br>
    <br>
    <br>

    <section>
        <div class="verify container" style="height: 100vh">

            <form method="POST" action="{{ route('verification.send') }}" >

                @csrf


            <div class="fields" >

                <h6  class=" text-center">   {{ Config::get('app.locale') == 'ar' ? '  تفعيل البريد الاليكتروني'  : ' Verification '}}</h6>
                <br>

                {{-- <div class="">
                    <label for="exampleFormControlInput1" class="form-label">  {{ Config::get('app.locale') == 'ar' ? ' البريد الاليكتروني'  : ' Email '}}</label>
                    <input type="email" class="form-control shadow-none custome-textFiled   @error('email') is-invalid  @enderror" style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                        id="exampleFormControlInput1" placeholder="example@example.com" name='email'>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                        <div id="emailHelp" class="form-text">
                            {{ Config::get('app.locale') == 'ar' ? 'اذا لم يتم ارسال رسالة التأكيد يرجي ادخال بريدك الاليكتروني والارسال مجددا' : 'If the confirmation message has not been sent, please enter your email address and send again. ' }}
                        </div>

                </div> --}}
              
                <br>

<div style="margin: auto;text-align: center">                            {{ Config::get('app.locale') == 'ar' ? 'اذا لم يتم ارسال رسالة التأكيد يرجي الضغط علي اعادة الارسال.' : 'If the confirmation message is not sent, please press resend.' }}
</div>
                <button type="submit"  class="button_1_style text-center"> {{ Config::get('app.locale') == 'ar' ? 'اعادة الارسال' : 'Resend' }}</button>

                <br>
                <br>
            </div>

           </form >

        </div>
    </section>




    <br>
    <br>
    <br>
    <br>

    <!-------------------------------------End Bookings Section-->

    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages js -->
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
        
    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}"></script>



    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>
    <script src=" {{ asset('Website_Assets/js/verify-email.js') }}"></script>

    <!--------------------------------------------------------------------------------------->

@error('msg')
<script>
    $.Toast( lang ?  "خطأ" : "Error", {!! json_encode($message) !!} ,  "error",{
        position_class:"toast-top-right",
    });

</script>
@enderror

@if(\Session::has('msg'))
<script>
    $.Toast( lang == 'ar' ?  "تم" : "Done", {!! json_encode(\Session::get('msg')) !!} ,  "success",{
        position_class:"toast-top-right",
    });

</script>
@endif

    <!--------------------------------------------------------------------------------------->

</body>

</html>