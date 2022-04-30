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
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />

    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />



    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/users/editAccount.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">



    @include('Website.globalElements.loading')


    <!------------------------------------- NavBar Section-->

    @if (Auth::check() && Auth::user()->hasVerifiedEmail())
        @include('Website.globalElements.navbar_userAuth')
    @else
        @include('Website.globalElements.navbar_guest')
    @endif


    <!-------------------------------------End NavBar Section-->



    <!------------------------------------- Bookings Section-->

    <br>
    <br>
    <br>
    <br>

    <section>
        <div class="editAccount container">
            <form method="POST" action="{{ route('account.edit') }}" enctype="multipart/form-data">

                @csrf
                <div class="fields">


                    
                    <div class="container">
                        <div class="avatar-upload">
                            <div class="avatar-edit  ">
                                <input type='file' id="imageUpload" class="@error('image') is-invalid @enderror" name="image" />
                                <label for="imageUpload"> <i class="fas fa-cloud-upload-alt"></i></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                    style="background-image: url({{ Auth::user()->image != null? asset('storage/' . Auth::user()->image): asset('Website_Assets/assets/images/userImageDefault.png') }});">
                                </div>
                            </div>

                            <label class="form-label"
                                style="text-align: center;">{{ Config::get('app.locale') == 'ar'
                                    ? 'الصورة الشخصية [اختياري]
                                                                                                            '
                                    : 'User Image [Optional]' }}
                            </label>

                        </div>

                    </div>



            


                    <div class="">
                        <label for="nameFormControlInput" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'اسم المستخدم' : 'Username' }}</label>
                        <input type="text"
                            class="form-control shadow custome-textFiled @error('name') is-invalid @enderror"
                            id="nameFormControlInput " placeholder="medo"
                            value="{{ old('name') == null ? Auth::user()->name : old('name') }}" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="">
                        <label for="emailFormControlInputUser" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}</label>
                        <input type="email"
                            class="form-control shadow custome-textFiled  @error('email') is-invalid @enderror"
                            style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                            id="emailFormControlInputUser" name="email"
                            value="{{ old('email') == null ? Auth::user()->email : old('email') }}"
                            placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="">
                        <label for="phoneFormControlInput" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'رقم الهاتف' : 'Phone' }}</label>
                        <input type="number"
                            style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                            class="form-control shadow custome-textFiled  @error('phone') is-invalid @enderror"
                            id="phoneFormControlInput" placeholder="+2010569....." name="phone"
                            value="{{ old('phone') == null ? Auth::user()->phone : old('phone') }}"
                            value="{{ old('phone') }}">
                        <div id="emailHelp" class="form-text" style="font-size: 12px">
                            {{ Config::get('app.locale') == 'ar'? 'سوف يتم استخدام ذلك الرقم في التواصل مع مقدمي الخدمات عند انشاء حجز .': 'This number will be used to communicate with service providers when creating a reservation .' }}
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>





                    <fieldset class="">
                        <legend class="col-form-label col-sm-2 pt-0 ">
                            {{ Config::get('app.locale') == 'ar' ? 'النوع' : 'Gender' }}</legend>
                        <div class="col-sm-10">
                            <div class="form-check ">
                                <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                    id="gridRadiosGender1" value="1"
                                    {{ old('gender') == null ? (Auth::user()->gender == 1 ? 'checked' : '') : (old('gender') == 1 ? 'checked' : '') }}>
                                <label class="form-check-label" for="gridRadiosGender1">
                                    {{ Config::get('app.locale') == 'ar' ? 'ذكر' : 'Male' }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                    id="gridRadiosGender2" value="0"
                                    {{ old('gender') == null ? (Auth::user()->gender == 0 ? 'checked' : '') : (old('gender') == 0 ? 'checked' : '') }}>
                                <label class="form-check-label" for="gridRadiosGender2">
                                    {{ Config::get('app.locale') == 'ar' ? 'انثي' : 'Female' }}

                                </label>
                            </div>

                        </div>
                    </fieldset>




                    <button href="#" class="button_1_style text-center" type="submit">
                        {{ Config::get('app.locale') == 'ar' ? 'تعديل الحساب' : 'Edit Account' }} </button>
                 
                        {{-- <a href="{{route('password.request')}}" class="text-center" style="color: var(--primary);">
                        {{ Config::get('app.locale') == 'ar' ? 'تغير الرقم السري' : 'Change Password' }}</a> --}}




                    <br>
                    <br>
                </div>
            </form>

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
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
    </script>
    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>


    <!-- project js -->

    <script src=" {{ asset('Website_Assets/js/Global.js ') }}"></script>
    <script src=" {{ asset('Website_Assets/js/users/editAccount.js ') }}"></script>

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

    @error('image')
    <script>
        $.Toast(lang ? "خطأ" : "Error", {!! json_encode($message) !!}, "error", {
            position_class: "toast-top-right",
        });
    </script>
    @enderror
</body>

</html>
