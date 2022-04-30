<!DOCTYPE html>

<html>

<head>
    <!-- Required meta tags -->

    @include('Website.globalElements.meta')



    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->

    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css') }}" />
        <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />

    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/service provider/wallet.csss') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')

    <!------------------------------------- NavBar Section-->

    @include('Website.globalElements.navbar_providerAuth')


    <!-------------------------------------End NavBar Section-->


    <!------------------------------------- Bookings Section-->

    <br>
    <br>
    <br>
    <br>

<div class="items d-flex   flex-column  container text-center" style="height:50vh;margin-top: 10%">
    <h5> {{ Config::get('app.locale') == 'ar' ? 'رصيدك الحالي' : 'Your Current Balance' }}</h6>
    <h6 style="color:{{ Auth::guard('provider')->user()->wallet == null ||  Auth::guard('provider')->user()->wallet < 5 ?  'red' :'var(--primary)'}} ;font-weight:bold ">
        {{Auth::guard('provider')->user()->wallet == null ?  0.00 : Auth::guard('provider')->user()->wallet . ' '. $currency}}</h3>
    <br>
    <br>


    <a  class="button_1_style text-center" data-bs-toggle="modal" href="#chargeModal" style="width: 200px;margin: 0 auto;padding:10px 15px">{{ Config::get('app.locale') == 'ar' ? 'اعادة الشحن': 'Recharge'}} </a>


</div>




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

    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>


    <!-- packages js -->

    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>

    <script>    
     var profile_id = {!! json_encode(Auth::guard('provider')->user()->id) !!};

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
   
   </script>
    <!--------------------------------------------------------------------------------------->
    <!-- Modal -->
    <div class="modal fade" id="chargeModal" tabindex="-1" aria-labelledby="chargeModalLabel"
        aria-hidden="true">
        <form action="{{ route('provider.charge') }}" id="chargeModalForm" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chargeModalLabel">
                            {{ Config::get('app.locale') == 'ar' ? 'حجز' : 'Reservation' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> {{ Config::get('app.locale') == 'ar' ? 'ادخل تكلفة شحن محفظتك.' : 'Enter the cost of shipping your wallet.' }}</label>
                            <input type="number" name="cost" class="form-control   @error('cost') is-invalid @enderror" id="exampleFormControlInput1" placeholder="0.00 {{$currency}}">
                        
                            @error('cost')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror


                        </div>
                          
                        <br>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button_1_style" data-bs-dismiss="modal"
                            style="background-color: red;">
                            {{ Config::get('app.locale') == 'ar' ? 'اغلاق' : 'Close' }}</button>
                        <div id="loadingreservation" style="max-width: 100px">

                            <button type="submit" id="sendreservation"
                                class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ارسال' : 'Send' }}</button>

                        </div>

                    </div>
                </div>
            </div>


        </form>
    </div>

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