<!DOCTYPE html>

<html lang="{{ Config::get('app.locale') }}">

<head>
    <!-- Required meta tags -->

    @include('Website.globalElements.meta')
    <title>
        {{ Config::get('app.locale') == 'en'? 'Register now to use all the features in '.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name.'.': 'سجل الان لاستخدام جميع الميزات في Helperzz.' }}
    </title>
    <meta name="description"
        content="{{ Config::get('app.locale') == 'en'? 'Register now. You can search for service providers. If you are a professional or service provider, you can register as a service provider also for free.': 'سجل الان تستطيع البحث عن مقدمي الخدمات واذا كنت صاحب مهنة او مقدم خدمات يمكنك التسجيل كمقدم خدمة ايضا مجانا.' }}">


        <meta name="googlebot" content="index,follow">


    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/css/select2.min.css') }}" />
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Website_Assets/packages/aos-master/dist/aos.css') }}" />


    <!-- project css -->
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/auth.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/626efb0fb0d10b6f3e70310c/1g20rcqg0';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')


    <!------------------------------------- NavBar Section-->

    @include('Website.globalElements.navbar_guest')

    <!-------------------------------------End NavBar Section-->


    <!------------------------------------- Auth Section-->
    <main>
        <section style="height: 100vh;">

            <div class="auth container-lg ">

                <div class="taps ">

                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="" role="presentation">
                            <a class="btn {{ empty($errors->user->all()) == true && empty($errors->provider->all()) == true ? 'active' : '' }} "
                                id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button"
                                role="tab" aria-controls="pills-login"
                                aria-selected="true">{{ Config::get('app.locale') == 'ar' ? 'تسجيل الدخول' : 'Login' }}</a>
                        </li>
                        <li class="" role="presentation">
                            <a class="btn {{ empty($errors->user->all()) ? '' : 'active' }}" id="pills-user-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-user" type="button" role="tab"
                                aria-controls="pills-user" aria-selected="false">
                                {{ Config::get('app.locale') == 'ar' ? 'انشاء حساب مستخدم' : 'Registration As User' }}
                            </a>
                        </li>
                        <li class="" role="presentation">
                            <a class="btn {{ empty($errors->provider->all()) ? '' : 'active' }}"
                                id="pills-provider-tab" data-bs-toggle="pill" data-bs-target="#pills-provider"
                                type="button" role="tab" aria-controls="pills-provider" aria-selected="false">
                                {{ Config::get('app.locale') == 'ar'
                                    ? 'انشاء حساب مقدم خدمة'
                                    : '                            Registration
                                                                                                                                                                                                            As Service Provider' }}
                            </a>
                        </li>
                    </ul>

                </div>



                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade {{ empty($errors->user->all()) == true && empty($errors->provider->all()) == true ? 'active show' : '' }}"
                        id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">

                        <form method="POST" action="{{ route('auth.login') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="fields">

                                <div class="">
                                    <label for="emailFormControlInputLogin" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}</label>
                                    <input type="email"
                                        class="form-control  custome-textFiled  @error('email', 'login') is-invalid @enderror"
                                        style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                                        id="emailFormControlInputLogin" name="email" value="{{ old('email') }}"
                                        placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">

                                    @error('email', 'login')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="">
                                    <label for="passworddFormControlInputLogin" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'الرقم السري' : 'Password' }}</label>
                                    <input type="password"
                                        class="form-control  custome-textFiled   @error('password', 'login') is-invalid @enderror"
                                        id="passworddFormControlInputLogin" placeholder="pas/#****" name="password">


                                    @error('password', 'login')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>



                                <div class="form-check">
                                    <input class="form-check-input custome-CheckBox" type="checkbox" name="remember"
                                        id="flexCheckCheckedLogin" checked>
                                    <label class="form-check-label" for="flexCheckCheckedLogin">
                                        {{ Config::get('app.locale') == 'ar' ? 'تذكرني' : 'Remember Me' }}
                                    </label>
                                </div>

                                <button type="submit" class="button_1_style text-center" style="width: 100%">
                                    {{ Config::get('app.locale') == 'ar' ? 'تسجيل الدخول' : 'Login' }}</button>

                                <a href="{{ route('password.request') }}" class="text-center"
                                    style="color: var(--primary);">
                                    {{ Config::get('app.locale') == 'ar' ? 'نسيت كلمة المرور' : 'Forgot Password' }}</a>

                            </div>

                        </form>


                    </div>

                    <div class="tab-pane fade {{ empty($errors->user->all()) == false ? 'active show' : '' }}"
                        id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">

                        <form method="POST" action="{{ route('auth.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="fields">

                                <div class="">
                                    <input type="hidden" class="form-control  custome-textFiled"
                                        id="typeFormControlInputType" placeholder="John Doe" value='user' name='type'>
                                </div>
                                <div class="">
                                    <input type="hidden" class="form-control  custome-textFiled"
                                        id="nameFormControlInputCountryUser" placeholder="John Doe"
                                        value='{{ $countrey->id }}' name='country'>
                                </div>

                                <div class="container">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit  ">
                                            <input type='file' id="imageUpload"
                                                class="@error('image') is-invalid @enderror" name="image" />
                                            <label for="imageUpload"> <i class="fas fa-cloud-upload-alt"></i></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url({{ asset('Website_Assets/assets/images/userImageDefault_Male.png') }});">
                                            </div>
                                        </div>
                                        <label class="form-label"
                                            style="text-align: center;padding-top: 10px">{{ Config::get('app.locale') == 'ar'
                                                ? 'الصورة الشخصية [اختياري]
                                                                                                                                                                                                                                                                                            '
                                                : 'User Image [Optional]' }}
                                        </label>

                                    </div>
                                </div>



                                <div class="">
                                    <label for="nameFormControlInputNameUser" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'اسم المستخدم *' : 'Username *' }}</label>
                                    <input type="text"
                                        class="form-control  custome-textFiled @error('name', 'user') is-invalid @enderror"
                                        id="nameFormControlInputNameUser " placeholder="John Doe"
                                        value="{{ old('name') }}" name="name">
                                    @error('name', 'user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>



                                <div class="">
                                    <label for="emailFormControlInputUser" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني *' : 'Email address *' }}</label>
                                    <input type="email"
                                        class="form-control  custome-textFiled  @error('email', 'user') is-invalid @enderror"
                                        style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                                        id="emailFormControlInputUser" name="email" value="{{ old('email') }}"
                                        placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">

                                    @error('email', 'user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                {{-- @foreach ($errors->all() as $error)
                            <div>{{ $error->user }}</div>
                        @endforeach --}}
                                <div class="">
                                    <label for="phoneFormControlInput" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'رقم الهاتف *' : 'Phone *' }}</label>
                                    <input type="number"
                                        style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                                        class="form-control  custome-textFiled  @error('phone', 'user') is-invalid @enderror"
                                        id="phoneFormControlInput" placeholder="+2010569....." name="phone"
                                        value="{{ old('phone') }}">
                                    <div id="emailHelp" class="form-text" style="font-size: 12px">
                                        {{ Config::get('app.locale') == 'ar'? 'سوف يتم استخدام ذلك الرقم في التواصل مع مقدمي الخدمات عند انشاء حجز .': 'This number will be used to communicate with service providers when creating a reservation .' }}
                                    </div>
                                    @error('phone', 'user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>



                                <div class="">
                                    <label for="passworddFormControlInputUser" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'الرقم السري *' : 'Password *' }}</label>
                                    <input type="password"
                                        class="form-control  custome-textFiled   @error('password', 'user') is-invalid @enderror"
                                        id="passworddFormControlInputUser" placeholder="pas/#****" name="password">


                                    @error('password', 'user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <div class="d-flex flex-column ">


                                    {{-- <div class="col-lg d-none" >
                                    <div class="item ">

                                        <label for="id_label_single">
                                            <label for="floatingSelectGridCountry">
                                                {{ Config::get('app.locale') == 'ar' ? 'الدولة' : 'Country' }}</label>
                                        </label>
                                        <div class="loadDiv" id="myLoadingCountry">

                                            <select class="select-item" name="country"  id="country">


                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}
                                                    </option>
                                                @endforeach



                                            </select>
                                        </div>





                                    </div>
                                </div> --}}
                                    <div class="col-lg">
                                        <div class="item">

                                            <label for="id_label_single">
                                                <label for="floatingSelectGridState">
                                                    {{ Config::get('app.locale') == 'ar' ? 'المنطقه *' : 'State *' }}</label>
                                            </label>

                                            <div class="loadDiv" id="myLoadingState">

                                                <select
                                                    class="select-itemState   @error('state', 'user') is-invalid @enderror"
                                                    name="state" id="state">
                                                    <option value=""></option>

                                                    @foreach ($countrey->states as $state)
                                                        <option value="{{ $state->id }}"
                                                            {{ old('state') != null && old('state') == $state->id ? 'selected' : '' }}>
                                                            {{ $state->name }}</option>
                                                    @endforeach


                                                </select>
                                                @error('state', 'user')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>




                                        </div>
                                    </div>

                                    <div class="col-lg  cities "
                                        style="display: {{ old('state') != null &&\App\Models\State::where('id', old('state'))->with(['cities'])->first()->cities->isEmpty() == false? 'block': 'none' }}  ">
                                        <div class="item">

                                            <label for="id_label_single">
                                                <label
                                                    for="floatingSelectGridCity">{{ Config::get('app.locale') == 'ar' ? 'المدينة [اختياري]' : 'City ​​[optional] ' }}</label>
                                            </label>
                                            <div class="loadDiv" id="myLoadingCity">
                                                <select
                                                    class="select-itemCity   @error('city', 'user') is-invalid @enderror"
                                                    name="city" id="cities">

                                                    @if (old('state') != null)
                                                        <option value=""></option>

                                                        @foreach (\App\Models\State::where('id', old('state'))->with(['cities'])->first()->cities
    as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ old('city') != null && old('city') == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}</option>
                                                        @endforeach

                                                    @endif



                                                </select>

                                                @error('city', 'user')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror


                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <fieldset class="">
                                    <legend class="col-form-label col-sm-2 pt-0 ">
                                        {{ Config::get('app.locale') == 'ar' ? 'النوع' : 'Gender' }}</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check ">
                                            <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                                id="gridRadiosGenderUser1" value="1"
                                                {{ old('gender') == null || old('gender') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadiosGenderUser1">
                                                {{ Config::get('app.locale') == 'ar' ? 'ذكر' : 'Male' }}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                                id="gridRadiosGenderUser2" value="0"
                                                {{ old('gender') != null && old('gender') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadiosGenderUser2">
                                                {{ Config::get('app.locale') == 'ar' ? 'انثي' : 'Female' }}

                                            </label>
                                        </div>

                                    </div>
                                </fieldset>


                                <div class="form-check ">
                                    <input class="form-check-input custome-CheckBox  " type="checkbox" name="terms"
                                        id="flexCheckCheckedTermsUser">
                                    <label class="form-check-label  @error('terms', 'user') is-invalid @enderror"
                                        for="flexCheckCheckedTermsUser">
                                        {{ Config::get('app.locale') == 'ar' ? 'اوافق' : 'Agree' }} <a
                                            href="{{ route('terms') }}" style="color: var(--primary)">

                                            {{ Config::get('app.locale') == 'ar' ? 'الشروط والاحكام' : 'Terms And Conditions' }}
                                        </a>
                                    </label>

                                    @error('terms', 'user')
                                        <div class="invalid-feedback">
                                            {{ Config::get('app.locale') == 'ar'? 'يجب الموافقة علي الموافقة علي الشروط والاحكام اولا.': 'You must agree to accept the terms and conditions first.                                    ' }}
                                        </div>
                                    @enderror
                                </div>
                                <br>

                                <button type="submit" class="button_1_style text-center" style="width: 100%">
                                    {{ Config::get('app.locale') == 'ar' ? 'التسجيل' : 'Register' }}</button>
                                <br>
                                <br>
                            </div>
                        </form>

                    </div>


                    <div class="tab-pane fade  {{ empty($errors->provider->all()) == false ? 'active show' : '' }}"
                        id="pills-provider" role="tabpanel" aria-labelledby="pills-provider-tab">


                        <form method="POST" action="{{ route('auth.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="fields">

                                <div class="">
                                    <input type="hidden" class="form-control  custome-textFiled"
                                        id="nameFormControlInputTypeProvider" value='provider' name='type'>
                                </div>
                                <div class="">
                                    <input type="hidden" class="form-control  custome-textFiled"
                                        id="nameFormControlInputCountryProvider" value='{{ $countrey->id }}'
                                        name='country'>
                                </div>
                                <div class="container">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file'
                                                class="form-control @error('image', 'provider') is-invalid @enderror"
                                                id="imageUploadProvider" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUploadProvider"> <i
                                                    class="fas fa-cloud-upload-alt"></i></label>


                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreviewProvider"
                                                style="background-image: url({{asset('Website_Assets/assets/images/userImageDefault_Male.png')}});">
                                            </div>

                                        </div>

                                        <label class="form-label"
                                            style="text-align: center;padding-top: 10px">{{ Config::get('app.locale') == 'ar'
                                                ? 'الصورة الشخصية *
                                                                                                                                                                                                                                                                                '
                                                : 'User Image *' }}</label>


                                    </div>

                                    @if ($errors->any())
                                    <div class="invalid text-danger text-center">
                                        {{ Config::get('app.locale') == 'ar' ? 'حقل ال Image مطلوب' : 'Image field is required' }}
                                    </div>
                                @endif
                                    {{-- @error('image', 'provider')

                                        <div class="invalid text-danger text-center">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}
                                </div>


                                <div class="">
                                    <label for="nameFormControlInputNameProvider" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'اسم المستخدم *' : 'Username *' }}</label>
                                    <input type="text"
                                        class="form-control  custome-textFiled  @error('name', 'provider') is-invalid @enderror"
                                        id="nameFormControlInputNameProvider" value="{{ old('name') }}" name="name"
                                        placeholder="John Doe">
                                    @error('name', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>



                                <div class="">
                                    <label for="emailFormControlInputProvider" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني *' : 'Email address *' }}</label>
                                    <input type="email"
                                        class="form-control  custome-textFiled   @error('email', 'provider') is-invalid @enderror"
                                        style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                                        name="email" id="emailFormControlInputProvider" value="{{ old('email') }}"
                                        placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">
                                    @error('email', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label for="phoneFormControlInputProvider" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'رقم الهاتف *' : 'Phone *' }}</label>
                                    <input type="number"
                                        style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                                        class="form-control  custome-textFiled @error('phone', 'provider') is-invalid @enderror"
                                        name="phone" id="phoneFormControlInputProvider" value="{{ old('phone') }}"
                                        placeholder="+2010569.....">
                                    @error('phone', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="">
                                    <label for="passworddFormControlInputProvider" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'الرقم السري *' : 'Password *' }}</label>
                                    <input type="password"
                                        class="form-control  custome-textFiled  @error('password', 'provider') is-invalid @enderror"
                                        name="password" id="passworddFormControlInputProvider"
                                        value="{{ old('password') }}" placeholder="pas/#****">
                                    @error('password', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                {{-- <div class="">
                                <label for="addressesFormControlInputProvider" class="form-label">
                                    {{ Config::get('app.locale') == 'ar' ? 'العنوان [اختياري]' : 'Addresses [Optional]' }}</label>
                                <input type="text"
                                    class="form-control  custome-textFiled  @error('address', 'provider') is-invalid @enderror"
                                    name="address"
                                    id="addressesFormControlInputProvider"  placeholder="1 your location street " />
                                @error('address', 'provider')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}



                                <div class="">
                                    <label for="BioFormControlTextarea" class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'نبذه مختصره *' : 'Bio *' }} </label>
                                    <textarea class="form-control  textarea custome-textFiled  @error('bio', 'provider') is-invalid @enderror" name="bio"
                                        id="BioFormControlTextarea" rows="3"
                                        maxlength="500"> {{ old('bio') }}</textarea>
                                    <div id="the-count">
                                        <span id="current">0</span>
                                        <span id="maximum">/ 500</span>
                                    </div>
                                    @error('bio', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="">
                                    <label for="IDformFile"
                                        class="form-label ">{{ Config::get('app.locale') == 'ar' ? 'صورة للبطاقه الشخصية *' : 'Your ID Card Image *' }}</label>

                                    <input
                                        class="form-control  custome-textFiled @error('idCard', 'provider') is-invalid @enderror"
                                        name="idCard" type="file" id="IDformFile">
                                        @if ($errors->any())
                                        <div class="invalid text-danger">
                                            {{ Config::get('app.locale') == 'ar' ? 'حقل Id Card مطلوب' : 'Id Card field is required' }}
                                        </div>
                                    @endif

                                        {{-- @error('idCard', 'provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}
                                </div>

                                <div class="selects ">



                                    <div class="col-lg">
                                        <div class="item">

                                            <label for="id_label_single">

                                                {{ Config::get('app.locale') == 'ar' ? 'قسم الخدمة *' : ' Service Department *' }}</label>

                                            <div class="loadDiv" id="myLoadingServiceDepartment">

                                                <select
                                                    class="select-itemServiceDepartment   @error('service_department', 'provider') is-invalid @enderror"
                                                    name="service_department" id="Service_Department">
                                                    <option value=""></option>

                                                    @foreach ($serviceCatogries as $serviceCatogrey)
                                                        <option value="{{ $serviceCatogrey->id }}"
                                                            {{ old('service_department') != null && old('service_department') == $serviceCatogrey->id ? 'selected' : '' }}>
                                                            {{ Config::get('app.locale') == 'ar' ? $serviceCatogrey->name_ar : $serviceCatogrey->name_en }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                                @error('service_department', 'provider')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>




                                        </div>
                                    </div>


                                    <div class="col-lg">
                                        <div class="item">

                                            <label for="id_label_single">
                                                {{ Config::get('app.locale') == 'ar' ? 'تخصص الخدمة *' : 'Specialization *' }}
                                            </label>

                                            <div class="loadDiv" id="myLoadingSpecialization">

                                                <select
                                                    class="select-itemSpecialization   @error('specialization', 'provider') is-invalid @enderror"
                                                    name="specialization" id="Specialization">

                                                    @if (old('service_department') != null)
                                                        <option value=""></option>

                                                        @foreach (\App\Models\Specialization::where('serviceCatogrey_id', old('service_department'))->get() as $specialization)
                                                            <option value="{{ $specialization->id }}"
                                                                {{ old('specialization') != null && old('specialization') == $specialization->id ? 'selected' : '' }}>
                                                                {{ Config::get('app.locale') == 'ar' ? $specialization->name_ar : $specialization->name_en }}
                                                            </option>
                                                        @endforeach

                                                    @endif


                                                </select>
                                                @error('specialization', 'provider')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>




                                        </div>
                                    </div>


                                </div>

                                {{-- {{ json_encode(Session::getOldInput('more'))}} --}}
                                <div class=" moreServices">
                                    <label for="id_label_multiple">
                                        {{ Config::get('app.locale') == 'ar' ? ' المزيد [اختياري]' : 'More [Optional]' }}

                                    </label>
                                    <div class="loadDiv" id="myLoadingMoreServices">

                                        <select class="js-example-basic-multiple  js-more form-control"
                                            multiple="multiple" id="moreServices" name="more[]" style="width: 100%">


                                            @if (old('specialization') != null)
                                                <option value=""></option>

                                                @foreach (\App\Models\MoreService::where('specialization_id', old('specialization'))->get() as $moreService)
                                                    <option value="{{ $moreService->id }}"
                                                        {{ Session::getOldInput('more') != null && in_array($moreService->id, Session::getOldInput('more'))? 'selected': '' }}>
                                                        {{ Config::get('app.locale') == 'ar' ? $moreService->name_ar : $moreService->name_en }}
                                                    </option>
                                                @endforeach

                                            @endif




                                        </select>
                                    </div>
                                </div>


                                <div class="">
                                    <label class="form-label">
                                        {{ Config::get('app.locale') == 'ar' ? 'حدد موقعك [اختياري]' : 'Choose Your Location [Optional]' }}</label>

                                    <div id="map"></div>
                                    <input class="" name="lat" id="lat" type="hidden">
                                    <input class="" name="lng" id="lng" type="hidden">

                                </div>

                                <div class="row g-1">
                                    {{-- <div class="col-lg">
                                <div class="item">

                                    <label>
                                        {{ Config::get('app.locale') == 'ar' ? 'الدولة' : 'Country' }}
                                    </label>

                                    <select class="select-item">

                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>


                                    </select>



                                </div>
                            </div> --}}
                                    <div class="col-lg">
                                        <div class="item">

                                            <label for="id_label_single">
                                                <label for="floatingSelectGridState2">
                                                    {{ Config::get('app.locale') == 'ar' ? 'المنطقه *' : 'State *' }}</label>
                                            </label>

                                            <div class="loadDiv" id="myLoadingState2">

                                                <select
                                                    class="select-itemState2   @error('state', 'provider') is-invalid @enderror"
                                                    name="state" id="state2">
                                                    <option value=""></option>
                                                    @foreach ($countrey->states as $state)
                                                        <option value="{{ $state->id }}"
                                                            {{ old('state') != null && old('state') == $state->id ? 'selected' : '' }}>
                                                            {{ $state->name }}</option>
                                                    @endforeach



                                                </select>
                                                @error('state', 'provider')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>




                                        </div>
                                    </div>
                                    <div class="col-lg  cities2"
                                        style="display: {{ old('state') != null &&\App\Models\State::where('id', old('state'))->with(['cities'])->first()->cities->isEmpty() == false? 'block': 'none' }}  ">
                                        <div class="item">

                                                <label
                                                    for="floatingSelectGridCity">{{ Config::get('app.locale') == 'ar' ? ' المدينة [اختياري]' : 'City [Optional]' }}</label>
                                            <div class="loadDiv" id="myLoadingCity2">

                                                <select
                                                    class="select-itemCity2   @error('city', 'provider') is-invalid @enderror"
                                                    name="city" id="cities2" value="{{ old('city') }}">

                                                    @if (old('state') != null)
                                                        <option value=""></option>

                                                        @foreach (\App\Models\State::where('id', old('state'))->with(['cities'])->first()->cities
    as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ old('city') != null && old('city') == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}</option>
                                                        @endforeach

                                                    @endif


                                                </select>

                                                @error('city', 'provider')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror


                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <fieldset class="">
                                    <legend class="col-form-label col-sm-2 pt-0 ">
                                        {{ Config::get('app.locale') == 'ar' ? 'النوع' : 'Gender' }}</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check ">
                                            <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                                id="gridRadiosGenderProvider" value="1"
                                                {{ old('gender') == null || old('gender') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadiosGenderProvider">
                                                {{ Config::get('app.locale') == 'ar' ? 'ذكر' : 'Male' }}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                                id="gridRadiosGenderProvider2" value="0"
                                                {{ old('gender') != null && old('gender') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadiosGenderProvider2">
                                                {{ Config::get('app.locale') == 'ar' ? 'انثي' : 'Female' }}

                                            </label>
                                        </div>

                                    </div>
                                </fieldset>

                                <div class="form-check ">
                                    <input class="form-check-input custome-CheckBox  " type="checkbox" name="terms"
                                        id="flexCheckCheckedTermsProvider">
                                    <label class="form-check-label  @error('terms', 'user') is-invalid @enderror"
                                        for="flexCheckCheckedTermsProvider">
                                        {{ Config::get('app.locale') == 'ar' ? 'اوافق' : 'Agree' }} <a
                                            href="{{ route('terms') }}" style="color: var(--primary)">

                                            {{ Config::get('app.locale') == 'ar' ? 'الشروط والاحكام' : 'Terms And Conditions' }}
                                        </a>
                                    </label>

                                    @error('terms', 'user')
                                        <div class="invalid-feedback">
                                            {{ Config::get('app.locale') == 'ar'? 'يجب الموافقة علي الموافقة علي الشروط والاحكام اولا.': 'You must agree to accept the terms and conditions first.                                    ' }}
                                        </div>
                                    @enderror
                                </div>
                                <br>

                                <button type="submit" class="button_1_style text-center" style="width: 100%">
                                    {{ Config::get('app.locale') == 'ar' ? 'التسجيل' : 'Register' }}</button>
                                <br>
                                <br>
                            </div>

                        </form>
                    </div>


                </div>
            </div>

            </div>


        </section>


    </main>


    <br>


    <!-------------------------------------End Auth Section-->


    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};

        var lat = {!! json_encode($lat) !!};
        var lng = {!! json_encode($lng) !!};

        var oldLat = {!! json_encode(old('lat')) !!};
        var oldLng = {!! json_encode(old('lng')) !!};

        console.log(oldLat + ',' + oldLng);
    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}">
    </script>




    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>
    <script src=" {{ asset('Website_Assets/js/auth.js') }}"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFc96BJRXrT7kN-mQb2PVGUzNEeSCI94w&callback=initMap&libraries=&v=weekly"
        async></script>
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

    @error('image', 'user')
        <script>
            $.Toast(lang ? "خطأ" : "Error", {!! json_encode($message) !!}, "error", {
                position_class: "toast-top-right",
            });
        </script>
    @enderror
</body>

</html>
