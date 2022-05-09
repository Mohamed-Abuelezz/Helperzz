<!DOCTYPE html>

<html>

<head>
    <!-- Required meta tags -->

    @include('Website.globalElements.meta')

    <title>
        {{ Config::get('app.locale') == 'en'? 'Search now available service providers and professions.': ' ابحث الان مقدمين الخدمات واصحاب المهن المتاحين .' }}
    </title>
    <meta name="description"
        content="{{ Config::get('app.locale') == 'en'? 'You can see the providers and professions you need, search for them and see their reviews.':
         'يمكنك رؤية مقدمي الخدمات واصحاب المهن الذين تحتاجهم والبحث عنهم ورئية تقييماتهم .' }}">

    <meta name="googlebot" content="index,follow">

    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/aos-master/dist/aos.css ') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />


    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/users/home.css') }}" />

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

    @if (Auth::check() && Auth::user()->hasVerifiedEmail())
        @include('Website.globalElements.navbar_userAuth')
    @else
        @include('Website.globalElements.navbar_guest')
    @endif


    <!-------------------------------------End NavBar Section-->


    <!------------------------------------- Search Section-->
<header>

    <section>
        <div class="container">

            <div class="advanced-search">


                <a class="item-nav" data-bs-toggle="collapse" href="#collapseBody-advancedSearch" role="button"
                    aria-expanded="false" aria-controls="collapseBody-advancedSearch">
                    <ul>
                        <li>
                            <h6> {{ Config::get('app.locale') == 'ar' ? 'البحث المتقدم' : 'Advanced Search' }}</h6>
                        </li>
                        <li><i class="fas fa-chevron-circle-down"></i></li>
                    </ul>
                </a>


                <div class="collapse" id="collapseBody-advancedSearch">
                    <div class="card card-body ">


                        <div class="selects">

                            <div class="item">

                                <label for="id_label_single">
                                    {{ Config::get('app.locale') == 'ar' ? 'قسم الخدمة' : ' Service Department' }}

                                </label>

                                <select class="select-item" id="service-category" style="width: 100%">
                                    <option></option>
                                    <option value="all">{{ Config::get('app.locale') == 'ar' ? 'الكل' : 'All' }}
                                    </option>

                                    @foreach ($servicesCatogries as $servicesCatogrey)
                                        <option value="{{ $servicesCatogrey->id }}">
                                            {{ Config::get('app.locale') == 'ar' ? $servicesCatogrey->name_ar : $servicesCatogrey->name_en }}
                                        </option>
                                    @endforeach


                                </select>



                            </div>

                            <div class="item">

                                <label for="id_label_single">
                                    {{ Config::get('app.locale') == 'ar' ? 'تخصص الخدمة' : 'Specialization' }}
                                </label>
                                <div id="myLoadingSpecialization">
                                    <select class="select-item" id="specialization" style="width: 100%">
                                        <option></option>
                                        <option value="all">{{ Config::get('app.locale') == 'ar' ? 'الكل' : 'All' }}
                                        </option>

                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">
                                                {{ Config::get('app.locale') == 'ar' ? $specialization->name_ar : $specialization->name_en }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>




                            </div>

                            <div class="item more" style="display: {{ 'none' }}">

                                <label for="id_label_single">
                                    {{ Config::get('app.locale') == 'ar' ? ' المزيد ' : 'More' }}
                                </label>

                                <div id="myLoadingMore">

                                    <select class="select-item" id="more" style="width: 100%">
                                        <option></option>
                                        <option value="all">{{ Config::get('app.locale') == 'ar' ? 'الكل' : 'All' }}
                                        </option>




                                    </select>

                                </div>




                            </div>

                            <div class="break">
                                <hr>
                            </div> <!-- break -->
                            <!-- <div class="item">

                                <label for="id_label_single">
                                    Country

                                </label>

                                <select class="select-item">

                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>


                                </select>



                            </div> -->
                            <div class="item">

                                <label for="id_label_single">
                                    {{ Config::get('app.locale') == 'ar' ? 'المنطقه' : 'State' }}
                                </label>

                                <div id="myLoadingState ">

                                    <select class="select-item" id="state" style="width: 100%">

                                        <option></option>
                                        <option value="all">{{ Config::get('app.locale') == 'ar' ? 'الكل' : 'All' }}
                                        </option>

                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}
                                            </option>
                                        @endforeach


                                    </select>

                                </div>


                            </div>
                            <div class="item city">

                                <label for="id_label_single">
                                    {{ Config::get('app.locale') == 'ar' ? 'المدينة' : 'City' }}
                                </label>
                                <div id="myLoadingCity">

                                    <select class="select-item" id="city" style="width: 100%">
                                        <option></option>
                                        <option value="all">{{ Config::get('app.locale') == 'ar' ? 'الكل' : 'All' }}
                                        </option>

                                        @foreach ($states as $state)
                                            @foreach ($state->cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}
                                                </option>
                                            @endforeach
                                        @endforeach



                                    </select>



                                </div>
                            </div>



                        </div>

                        <div style="width: 150px;margin: auto">

                        <div id="loadingCards1" style="text-align: center;margin-bottom: 5px;">

                            <a href="#" id="search"
                                class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'البحث' : 'Search' }}</a>

                        </div>
                    </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <section>

        <div class="container">


            <div class="searching">

                <div class="searchDiv" style="width: 200px">
                    <div id="loadingSearchInput">

                        <input type="search" class="form-control custome-textFiled" id="searchInput"
                            placeholder="{{ Config::get('app.locale') == 'ar' ? 'ابحث...' : 'Search...' }}">

                    </div>
                </div>

                <div class="drop">


                    <div class="mapWithDrop">

                        <div class="sortDiv float-start">

                            <div id="loadingSort">

                                <div class="dropdown float-start">
                                    <button class="button_1_style dropdown-toggle " type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Config::get('app.locale') == 'ar' ? ' ترتيب حسب' : 'sort by' }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" data-id="1">
                                                {{ Config::get('app.locale') == 'ar' ? 'الاعلي تقييما' : 'top rated' }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-id="0">
                                                {{ Config::get('app.locale') == 'ar' ? 'الاقل تقييما' : 'lowest rated' }}</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>



                        <button type="button" class="button_1_style d-lg-none float-end" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <img src=" {{ asset('Website_Assets/assets/icons/google-maps-icon-3d-24.jpg') }}"
                                width="20" alt="google maps icon">
                        </button>

                    </div>




                </div>

            </div>


            <button type="button" class="button_1_style d-none d-lg-block" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <img src="{{ asset('Website_Assets/assets/icons/google-maps-icon-3d-24.jpg') }}" width="20" alt="google maps icon">
            </button>






        </div>

    </section>

</header>

    <br>
    <!-------------------------------------End Search Section-->

<main>


    <section>
        <div class="cards container" style="min-height: 100vh">

            <div class="row justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-4 " id="providerCards">




                @include(
                    'Website.globalElements.custome screens.home.provider'
                )



            </div>




        </div>


    </section>


    <br>
    <div class="d-flex justify-content-center ">
        <div class="spinner-border" style="color: #009DAE;display: none" role="status" id="loadMore">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</main>

    <br>
    <br>
    <br>
    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.userHomeFooter')

    <!------------------------------------- End Footer Section-->
    <!-- Modal -->
    <div class="modal fade i" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ Config::get('app.locale') == 'ar' ? 'مواقع مقدمي الخدمات' : 'Service Provider Locations' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>

                </div>

            </div>
        </div>
    </div>
    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};

        var lat = {!! json_encode($lat) !!};
        var lng = {!! json_encode($lng) !!};

        var providers = {!! json_encode($providersMaps->makeHidden(['address', 'phone','email','idCard_photo','wallet','isActive',''])) !!};
    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>
    <script src="  {{ asset('Website_Assets/packages/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Live-Search-Plugin-jQuery-e-search/e-search.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}">
    </script>
    <script src=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.js') }}"></script>


    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js ') }}"></script>
    <script src=" {{ asset('Website_Assets/js/users/home.js ') }}"></script>

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

</body>

</html>
