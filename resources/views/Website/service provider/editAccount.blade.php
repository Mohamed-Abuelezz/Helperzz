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
        href=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/css/select2.min.css') }}" />
        <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />



    <!-- project css -->

    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/service_provider/editAccount.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')

    <!------------------------------------- NavBar Section-->

    @include('Website.globalElements.navbar_providerAuth')


    <!-------------------------------------End NavBar Section-->




    <!------------------------------------- editAccount Section-->

    <br>
    <br>
    <br>
    <br>

    <section>
        <div class="editAccount container">
            <form method="POST" action="{{ route('provider.account.edit') }}" enctype="multipart/form-data">

                @csrf
                <div class="fields">


                    <div class="">
                        <input type="hidden" class="form-control shadow custome-textFiled"
                            id="nameFormControlInputCountryProvider" placeholder="medo" value='{{ $countrey->id }}'
                            name='country'>
                    </div>
                    <div class="container">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' class="form-control @error('image', 'provider') is-invalid @enderror"
                                    id="imageUploadProvider" name="image" accept=".png, .jpg, .jpeg" />
                                <label for="imageUploadProvider"> <i class="fas fa-cloud-upload-alt"></i></label>


                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreviewProvider"
                                    style="background-image: url({{ auth()->guard('provider')->user()->image == null? asset('Website_Assets/assets/images/userImageDefault.png'): asset('storage/' .auth()->guard('provider')->user()->image) }});">
                                </div>

                            </div>

                            <label class="form-label"
                                style="text-align: center;">{{ Config::get('app.locale') == 'ar'
                                    ? 'الصورة الشخصية
                                                                                                                                                                                                                '
                                    : 'User Image' }}</label>


                        </div>

                        @error('image', 'provider')
                            <div class="invalid text-danger text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="">
                        <label for="nameFormControlInputNameProvider" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'اسم المستخدم' : 'Username' }}</label>
                        <input type="text"
                            class="form-control shadow custome-textFiled  @error('name', 'provider') is-invalid @enderror"
                            id="nameFormControlInputNameProvider" name="name" placeholder="medo"
                            value="{{ auth()->guard('provider')->user()->name }}">
                        @error('name', 'provider')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <div class="">
                        <label for="emailFormControlInputProvider" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}</label>
                        <input type="email"
                            class="form-control shadow custome-textFiled   @error('email', 'provider') is-invalid @enderror"
                            style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                            name="email" id="emailFormControlInputProvider"
                            value="{{ auth()->guard('provider')->user()->email }}"
                            placeholder=" {{ Config::get('app.locale') == 'ar' ? 'البريد الاليكتروني' : 'Email address' }}">
                        @error('email', 'provider')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="">
                        <label for="phoneFormControlInputProvider" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'رقم الهاتف' : 'Phone' }}</label>
                        <input type="number"
                            style="text-align: {{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}"
                            class="form-control shadow custome-textFiled @error('phone', 'provider') is-invalid @enderror"
                            name="phone" value="{{ auth()->guard('provider')->user()->phone }}"
                            id="phoneFormControlInputProvider" placeholder="+2010569.....">
                        @error('phone', 'provider')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- <div class="">
                        <label for="passworddFormControlInputProvider" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'الرقم السري' : 'Password' }}</label>
                        <input type="password"
                            class="form-control shadow custome-textFiled  @error('password', 'provider') is-invalid @enderror"
                            name="password"

                            id="passworddFormControlInputProvider" placeholder="pas/#****">
                        @error('password', 'provider')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}



                    {{-- <div class="">
                        <label for="addressesFormControlInputProvider" class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'العنوان [اختياري]' : 'Addresses [Optional]' }}</label>
                        <input type="text"
                            class="form-control shadow custome-textFiled  @error('address', 'provider') is-invalid @enderror"
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
                            {{ Config::get('app.locale') == 'ar' ? 'نبذه مختصره' : 'Bio' }} </label>
                        <textarea class="form-control shadow textarea custome-textFiled  @error('bio', 'provider') is-invalid @enderror" name="bio"
                            id="BioFormControlTextarea" rows="3" maxlength="500">
                       {{ auth()->guard('provider')->user()->bio }}
                    
                    
                    </textarea>
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


                    {{-- <div class="">
                        <label for="IDformFile"
                            class="form-label ">{{ Config::get('app.locale') == 'ar' ? 'صورة للبطاقه الشخصية' : 'Your ID Card Image' }}</label>
                       
                        <input class="form-control shadow custome-textFiled @error('idCard', 'provider') is-invalid @enderror"  name="idCard"  type="file" id="IDformFile">
                        @error('idCard', 'provider')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                       @enderror
                    </div> --}}

                    <div class="selects">



                        <div class="col-lg">
                            <div class="item">

                                <label for="id_label_single">

                                    {{ Config::get('app.locale') == 'ar' ? 'قسم الخدمة' : ' Service Department' }}</label>

                                <div class="loadDiv" id="myLoadingServiceDepartment">

                                    <select
                                        class="select-itemServiceDepartment   @error('service_department', 'provider') is-invalid @enderror"
                                        name="service_department" id="Service_Department">
                                        <option value=""></option>

                                        @foreach ($serviceCatogries as $serviceCatogrey)
                                            <option value="{{ $serviceCatogrey->id }}"
                                                {{ old('service_department') == $serviceCatogrey->id ||auth()->guard('provider')->user()->serviceCatogrey_id == $serviceCatogrey->id? 'selected': '' }}>
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
                                    {{ Config::get('app.locale') == 'ar' ? 'تخصص الخدمة' : 'Specialization' }}
                                </label>

                                <div class="loadDiv" id="myLoadingSpecialization">

                                    <select
                                        class="select-itemSpecialization   @error('specialization', 'provider') is-invalid @enderror"
                                        name="specialization" id="Specialization">
                                        <option value=""></option>


                                        @foreach (auth()->guard('provider')->user()->serviceCatogrey->specializations
    as $specialization)
                                            <option value="{{ $specialization->id }}"
                                                {{ old('service_department') == $specialization->id ||auth()->guard('provider')->user()->specialization_id == $specialization->id? 'selected': '' }}>
                                                {{ Config::get('app.locale') == 'ar' ? $specialization->name_ar : $specialization->name_en }}
                                            </option>
                                        @endforeach

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


                    <div class=" ">
                        <label for="id_label_multiple">
                            {{ Config::get('app.locale') == 'ar' ? ' المزيد [اختياري]' : 'More [Optional]' }}

                        </label>
                        <div class="loadDiv" id="myLoadingMoreServices">

                            <select class="js-example-basic-multiple  js-more form-control" multiple="multiple"
                                id="moreServices" name="more[]" style="width: 100%">


                                @foreach (auth()->guard('provider')->user()->specialization->moreServices as $moreService)
                                    <option value="{{ $moreService->id }}"
                                        {{ in_array($moreService->id,auth()->guard('provider')->user()->moreservicesofserviceproviders->pluck('moreService_id')->toArray())? 'selected': '' }}>

                                        {{ Config::get('app.locale') == 'ar' ? $moreService->name_ar : $moreService->name_en }}
                                    </option>
                                @endforeach



                            </select>
                        </div>
                    </div>


                    <div class="">
                        <label class="form-label">
                            {{ Config::get('app.locale') == 'ar' ? 'حدد موقعك [اختياري]' : 'Choose Your Location [Optional]' }}</label>

                        <div id="map">
                              
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{auth()->guard('provider')->user()->lat != null ?  'checked' : ''}} >
                            <label class="form-check-label" for="flexSwitchCheckDefault">{{Config::get('app.locale') == 'ar' ? 'اظهار الموقع الخاص بي علي الخريطه':'Show my location on the map'}}</label>
                          </div>
                          
                        <input class="" name="lat" id="lat" type="hidden">
                        <input class="" name="lng" id="lng" type="hidden">

                    </div>

                    <div class="row g-1 shadow">
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
                                        {{ Config::get('app.locale') == 'ar' ? 'المنطقه' : 'State' }}</label>
                                </label>

                                <div class="loadDiv" id="myLoadingState2">

                                    <select class="select-itemState2   @error('state', 'provider') is-invalid @enderror"
                                        name="state" id="state2">
                                        <option value=""></option>

                                        @foreach ($countrey->states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ old('state') == $state->id ||auth()->guard('provider')->user()->state_id == $state->id? 'selected': '' }}>
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
                        <div class="col-lg">
                            <div class="item">

                                <label for="id_label_single">
                                    <label
                                        for="floatingSelectGridCity">{{ Config::get('app.locale') == 'ar' ? 'المدينة' : 'City' }}</label>
                                </label>
                                <div class="loadDiv" id="myLoadingCity2">

                                    <select class="select-itemCity2   @error('city', 'provider') is-invalid @enderror"
                                        name="city" id="cities2" value="{{ old('city') }}">

                                        {{-- @foreach ($countries->first()->states->first()->cities as $city)
                                        <option value="{{ $city->id }}" selected="{{old('city') == $city->id ?  'selected' : ''}}">{{ $city->name }}</option>
                                    @endforeach --}}

                                        @foreach (auth()->guard('provider')->user()->state->cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city') == $city->id ||auth()->guard('provider')->user()->city_id == $city->id? 'selected': '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach

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
                                    {{  (int)auth()->guard('provider')->user()->gender == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadiosGenderProvider">
                                    {{ Config::get('app.locale') == 'ar' ? 'ذكر' : 'Male' }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input custome-CheckBox" type="radio" name="gender"
                                    id="gridRadiosGenderProvider2" value="0"
                                    {{  (int)auth()->guard('provider')->user()->gender == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadiosGenderProvider2">
                                    {{ Config::get('app.locale') == 'ar' ? 'انثي' : 'Female' }}

                                </label>
                            </div>

                        </div>
                    </fieldset>


                    <br>

                    <button type="submit" class="button_1_style text-center" style="width: 100%">
                        {{ Config::get('app.locale') == 'ar' ? 'التعديل' : 'Edit' }}</button>
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

        var lat = {!! json_encode(auth()->guard('provider')->user()->lat) !!};
        var lng = {!! json_encode(auth()->guard('provider')->user()->lng) !!};
        var myLat = {!! json_encode($lat) !!};
        var myLng = {!! json_encode($lng) !!};

        

        // var userId = {!! json_encode(auth()->guard('provider')->user()->id) !!};
        var profile_id = {!! json_encode(Auth::guard('provider')->user()->id) !!};

    </script>

    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}">
    </script>
        <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>

    <script src=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>





    <!-- project js -->

    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>
    <script src=" {{ asset('Website_Assets/js/service_provider/editAccount.js') }}"></script>

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

    @error('image')
    <script>
        $.Toast(lang ? "خطأ" : "Error", {!! json_encode($message) !!}, "error", {
            position_class: "toast-top-right",
        });
    </script>
    @enderror

</body>

</html>
