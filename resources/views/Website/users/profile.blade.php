<!DOCTYPE html>

<html>

<head>
    <!-- Required meta tags -->

    @include('Website.globalElements.meta')
    <title>
        {{ $serviceProvider->name }}
    </title>
    <meta name="description" content="{{ $serviceProvider->bio }}">


    <meta name='robots' content="noindex,nofollow">



    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/EmojiRaiting-master/csshake.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />


    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/users/profile.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/626efb0fb0d10b6f3e70310c/1g20rcqg0';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
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

    <main>
        <!------------------------------------- Bookings Section-->

        <br>
        <br>
        <br>
        <br>

        <section>

            {{-- <div class="atropos my-atropos">
                <!-- scale container (required) -->
                <div class="atropos-scale">
                    <!-- rotate container (required) -->
                    <div class="atropos-rotate">
                        <!-- inner container (required) -->
                        <div class="atropos-inner">
                            <!-- put your custom content here --> --}}

                            <div class="info d-none d-lg-flex container">

                                <div class="personDataDiv">

                                    <div class="personData">
                                        <img src="{{ asset('storage/' . $serviceProvider->image) }}"
                                     class="zoom"
                                            alt="{{ $serviceProvider->name }}">
                                        <p>{{ $serviceProvider->name }}</p>
                                        <span>{{ $serviceProvider->country->name }} /
                                            {{ ($serviceProvider->city != null ?  $serviceProvider->city->name :  $serviceProvider->state->name)  }}</span>
                                    </div>
                                    <div class="bio">
                                        {{ $serviceProvider->bio }} </div>


                                    <div class="rate ">
                                        😍
                                        {{ number_format((float) $serviceProvider->rates->avg('rate'), 1, '.', '') }}

                                    </div>
                                    @if ($serviceProvider->lat != null)
                                        <div class="location">
                                            <a data-bs-toggle="modal" data-bs-target="#staticBackdropMap"> <img
                                                    src="{{ asset('Website_Assets/assets/icons/google-maps-icon-3d-24.jpg') }}"
                                                    width="30" alt="map icon"></a>

                                        </div>
                                    @endif

                                </div>


                                <div class="otherDataDiv"
                                    style="background-image: url(' {{ asset('storage/' . $serviceProvider->serviceCatogrey->image) }}');">
                                    <div id="blur"></div>


                                    <div class="cats">
                                        <div class="catogrey">
                                            {{ Config::get('app.locale') == 'ar' ? 'قسم الخدمة' : ' Service Department' }}

                                            <p> {{ Config::get('app.locale') == 'ar'? $serviceProvider->serviceCatogrey->name_ar: $serviceProvider->serviceCatogrey->name_en }}
                                            </p>


                                        </div>
                                        <div class="specialization">
                                            {{ Config::get('app.locale') == 'ar' ? 'تخصص الخدمة' : 'Specialization' }}
                                            <p> {{ Config::get('app.locale') == 'ar'? $serviceProvider->specialization->name_ar: $serviceProvider->specialization->name_en }}
                                            </p>
                                        </div>

                                        @if ($serviceProvider->moreservicesofserviceproviders->isEmpty() == false)
                                            <div class="others">
                                                {{ Config::get('app.locale') == 'ar' ? ' المزيد ' : 'More' }}
                                                <ul>

                                                    @foreach ($serviceProvider->moreservicesofserviceproviders as $more)
                                                        <li>
                                                            <p style="margin-bottom:1px">
                                                                {{ Config::get('app.locale') == 'ar' ? $more->moreService->name_ar : $more->moreService->name_en }}
                                                            </p>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>

                                        @endif
                                    </div>

                                    <div class="rates">
                                        <div class="5rates">
                                            😍 <span
                                                class="numbers">{{ $serviceProvider->rates->where('rate', '5')->count() }}</span>

                                        </div>
                                        <div class="4rates">
                                            😃 <span
                                                class="numbers">{{ $serviceProvider->rates->where('rate', '4')->count() }}</span>


                                        </div>
                                        <div class="3rates">
                                            😊 <span
                                                class="numbers">{{ $serviceProvider->rates->where('rate', '3')->count() }}</span>


                                        </div>
                                        <div class="2rates">
                                            😐 <span
                                                class="numbers">{{ $serviceProvider->rates->where('rate', '2')->count() }}</span>


                                        </div>
                                        <div class="1rates">
                                            😠 <span
                                                class="numbers">{{ $serviceProvider->rates->where('rate', '1')->count() }}</span>


                                        </div>
                                    </div>


                                    <div class="sendButton">
                                        <a data-bs-toggle="modal" href="#termsModal" class="button_1_style" style="">
                                            {{ Config::get('app.locale') == 'ar' ? 'حجز' : 'book' }}</a>
                                    </div>

                                    <div class="shareButton" data-bs-container="body" data-bs-toggle="popover"
                                        data-bs-placement="bottom">

                                        <a class="menu-button"><i class="fas fa-share-alt"></i></a>






                                    </div>


                                    <div class="favButton">

                                        <a class="addFav" data-id="{{ $serviceProvider->id }}"><i
                                                class="fas fa-heart" data-id="{{ $serviceProvider->id }}"
                                                style="color: {{ Auth::check() && in_array($serviceProvider->id, $userFavourites->pluck('serviceProvider_id')->toArray())? '#FFE652': 'white' }}"></i></a>
                                    </div>
                                    <div class="reportButton">
                                        <a class="" data-bs-toggle="modal" href="#reportModal"><i
                                                class="fas fa-flag"></i></a>
                                    </div>

                                </div>


                            </div>

                        {{-- </div>
                    </div>
                </div>


            </div> --}}


            <div class="infoMobile d-flex d-lg-none container">


                <div class="personData">
                    <img  src="{{ asset('storage/' . $serviceProvider->image) }}"
                        alt="{{ $serviceProvider->name }}">
                    <p>{{ $serviceProvider->name }}</p>
                    <span>{{ $serviceProvider->country->name }} / {{ ($serviceProvider->city != null ?  $serviceProvider->city->name :  $serviceProvider->state->name)  }}</span>
                </div>


                <div class="bio">
                    {{ $serviceProvider->bio }} </div>



                <div class="bottomItems">
                    <div class="rates">
                        <div class="5rates">
                            😍 <span
                                class="numbers">{{ $serviceProvider->rates->where('rate', '5')->count() }}</span>

                        </div>
                        <div class="4rates">
                            😃 <span
                                class="numbers">{{ $serviceProvider->rates->where('rate', '4')->count() }}</span>


                        </div>
                        <div class="3rates">
                            😊 <span
                                class="numbers">{{ $serviceProvider->rates->where('rate', '3')->count() }}</span>


                        </div>
                        <div class="2rates">
                            😐 <span
                                class="numbers">{{ $serviceProvider->rates->where('rate', '2')->count() }}</span>


                        </div>
                        <div class="1rates">
                            😠 <span
                                class="numbers">{{ $serviceProvider->rates->where('rate', '1')->count() }}</span>


                        </div>
                    </div>

                    <div class="cats">
                        <div class="catogrey">
                            <h6> {{ Config::get('app.locale') == 'ar' ? 'قسم الخدمة' : ' Service Department' }}</h6>

                            <p> {{ Config::get('app.locale') == 'ar'? $serviceProvider->serviceCatogrey->name_ar: $serviceProvider->serviceCatogrey->name_en }}
                            </p>


                        </div>
                        <div class="specialization">
                            <h6> {{ Config::get('app.locale') == 'ar' ? 'تخصص الخدمة' : 'Specialization' }}</h6>
                            <p> {{ Config::get('app.locale') == 'ar'? $serviceProvider->specialization->name_ar: $serviceProvider->specialization->name_en }}
                            </p>
                        </div>

                        @if ($serviceProvider->moreservicesofserviceproviders->isEmpty() == false)
                            <div class="others">
                                <h6> {{ Config::get('app.locale') == 'ar' ? ' المزيد ' : 'More' }} </h6>
                                <ul>

                                    @foreach ($serviceProvider->moreservicesofserviceproviders as $more)
                                        <li>
                                            <p style="margin-bottom:1px">
                                                {{ Config::get('app.locale') == 'ar' ? $more->moreService->name_ar : $more->moreService->name_en }}
                                            </p>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        @endif
                    </div>
                </div>

                <br>

                <div class="sendButton">
                    <a data-bs-toggle="modal" href="#termsModal" class="button_1_style">
                        {{ Config::get('app.locale') == 'ar' ? 'حجز' : 'Reservation' }}</a>
                </div>

                <br>

                <div class="shareButton2" data-bs-container="body" data-bs-toggle="popover"
                    data-bs-placement="bottom">
                    <a><i class="fas fa-share-alt"></i></a>
                </div>


                <div class="favButton">
                    <a class="addFav" data-id="{{ $serviceProvider->id }}"><i class="fas fa-heart"
                            data-id="{{ $serviceProvider->id }}"
                            style="color: {{ Auth::check() && in_array($serviceProvider->id, $userFavourites->pluck('serviceProvider_id')->toArray())? '#FFE652': 'grey' }}"></i></a>
                </div>


                <div class="rate ">
                    😍 {{ number_format((float) $serviceProvider->rates->avg('rate'), 1, '.', '') }}

                </div>



                @if ($serviceProvider->lat != null)
                    <div class="location">
                        <a data-bs-toggle="modal" data-bs-target="#staticBackdropMap"> <img
                                src="{{ asset('Website_Assets/assets/icons/google-maps-icon-3d-24.jpg') }}"
                                width="30" alt="map icon"></a>

                    </div>
                @endif


                <div class="reportButton">
                    <a class="" data-bs-toggle="modal" href="#reportModal"><i
                            class="fas fa-flag"></i></a>
                </div>




            </div>


















        </section>







        <!-------------------------------------End Bookings Section-->

        <br>
        <br>
        <br>
        <br>
        <!------------------------------------- Comments Section-->


        <section>

            <div class="Comments  container">

                <div class="peopleComments">

                    @if ($serviceProvider->comments->sortByDesc('created_at')->isEmpty() == true)
                        <h6 class="text-center" id="nocomment">
                            {{ Config::get('app.locale') == 'ar' ? ' لاتوجد تعليقات' : 'No Comments' }}</h6>
                    @else
                        @foreach ($serviceProvider->comments->sortByDesc('created_at') as $comment)
                            <div class="card mb-3"  style="max-width: 100%;">
                                <div class="row justify-content-start" >
                                    <div class="col-12 col-lg-1">
                                        <img class="zoom" src=" {{ $comment->user->image == null? ($comment->user->gender == 1? asset('Website_Assets/assets/images/userImageDefault_Male.png'): asset('Website_Assets/assets/images/userImageDefault_Female.png')): asset('storage/' . $comment->user->image) }}"
                                            width="60" height="60" style="margin: auto" class="rounded-circle"
                                            alt="{{ $comment->user->name }}">
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        <div class="card-body">
                                            <h6 class="card-title"> {{ $comment->user->name }}</h6>
                                            <p class="card-text text-center text-lg-start"><small class="text-muted"
                                                    style="font-size: .5rem">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                                            </p>

                                            @if (Auth::guard('provider')->check())
                                                @if (App\Models\ReportComment::where('serviceProvider_id', $serviceProvider->id)->where('comment_id', $comment->id)->first() == null)
                                                    <div class="reportCommentButton" data-id="{{ $comment->id }}">
                                                        <a class="" data-bs-toggle="modal"
                                                            href="#reportCommentModal"><i
                                                                class="fas fa-flag text-danger"></i></a>
                                                    </div>
                                                @endif
                                            @endif
                                            <p class="card-text text-center text-lg-start comment"
                                                style="font-weight: bold"> {{ $comment->comment }}

                                            </p>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif




                </div>

                <div class="sendComment">
                    <div id="emoji-div" data-id="{{ $serviceProvider->id }}"></div>
                    <div class="field">
                        <div class="">
                            <textarea class="form-control  custome-textFiled" id="commentInput" rows="4"></textarea>
                            {{-- <div class="form-text">
                            {{ Config::get('app.locale') == 'ar' ? '500 حرف كحد اقصي.' : 'maximan 500 charachter.' }}
                        </div> --}}

                        </div>

                        <div class=" d-flex flex-column justify-content-center" style="margin: auto;width: 100px">

                            <div id="loadingCommentSend">
                                <a id="sendComment" class="button_1_style" style="color: whitesmoke;padding: 8px 25px;">
                                    {{ Config::get('app.locale') == 'ar' ? 'ارسال' : 'Send' }} </a>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


        </section>



        <!-------------------------------------End Comments Section-->
        <br>
        <br>
        <br>
        <br>
    </main>
    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')



    <!------------------------------------- End Footer Section-->

    <!-- Modals  -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <form action="" id="reportProfileForm" enctype="multipart/form-data">

            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">
                            {{ Config::get('app.locale') == 'ar' ? 'الابلاغ' : 'Report' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="" type="hidden" id="formFile" name="provider_id"
                            value="{{ $serviceProvider->id }}">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1 " class="form-label">
                                {{ Config::get('app.locale') == 'ar' ? 'وصف المشكلة' : 'Description of the problem' }}</label>
                            <textarea class="form-control custome-textFiled textarea1  @error('desc') is-invalid @enderror" id="reportInput"
                                maxlength="500" rows="3" name="desc"></textarea>
                            <div id="the-count1">
                                <span id="current1">0</span>
                                <span id="maximum1">/ 500</span>
                            </div>
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="formFile" class="form-label ">
                                {{ Config::get('app.locale') == 'ar' ? 'ارفاق ملف [اختياري]' : 'attach file [optional] ' }}</label>
                            <input class="form-control  custome-textFiled   @error('image') is-invalid @enderror"
                                type="file" id="formFile" name="image">
                            @error('image')
                                <div class="invalid-feedback"> 
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button_1_style" data-bs-dismiss="modal"
                            style="background-color: red;">
                            {{ Config::get('app.locale') == 'ar' ? 'اغلاق' : 'Close' }}</button>
                        <div id="loadingReport" style="max-width: 100px">
                            <button type="submit" id="sendReport"
                                class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ارسال' : 'Send' }}</button>

                        </div>

                    </div>
                </div>
            </div>


        </form>
    </div>




    <div class="modal fade" id="reportCommentModal" tabindex="-1" aria-labelledby="reportCommentLabel"
        aria-hidden="true">
        <form action="" id="reportComment" enctype="multipart/form-data">

            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportCommentLabel">
                            {{ Config::get('app.locale') == 'ar' ? 'الابلاغ' : 'Report' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="" type="hidden" id="formFile" name="provider_id"
                            value="{{ $serviceProvider->id }}">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1 " class="form-label">
                                {{ Config::get('app.locale') == 'ar' ? 'وصف المشكلة' : 'Description of the problem' }}</label>
                            <textarea class="form-control  custome-textFiled  textarea2 @error('desc') is-invalid @enderror"
                                id="reportCommentInput" maxlength="500" rows="3" name="desc"></textarea>
                            <div id="the-count2">
                                <span id="current2">0</span>
                                <span id="maximum2">/ 500</span>
                            </div>
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label for="formFile" class="form-label ">
                                {{ Config::get('app.locale') == 'ar' ? 'ارفاق ملف [اختياري]' : 'attach file [optional] ' }}</label>
                            <input
                                class="form-control shadow-none custome-textFiled   @error('image') is-invalid @enderror"
                                type="file" id="formFile" name="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button_1_style" data-bs-dismiss="modal"
                            style="background-color: red;">
                            {{ Config::get('app.locale') == 'ar' ? 'اغلاق' : 'Close' }}</button>
                        <div id="loadingReport" style="max-width: 100px">
                            <button type="submit" id="sendReport"
                                class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'ارسال' : 'Send' }}</button>

                        </div>

                    </div>
                </div>
            </div>


        </form>
    </div>












    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <form action="" id="termsModal" enctype="multipart/form-data">

            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">
                            {{ Config::get('app.locale') == 'ar' ? 'الشروط والاحكام' : 'Terms and Conditions' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="height: 50vh; overflow-y: auto;">
                        <ul>

                            @foreach ($orderConditions as $orderCondition)
                                <li>{{ Config::get('app.locale') == 'ar' ? $orderCondition->describe_ar : $orderCondition->describe_en }}
                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="modal-footer">
                        <a type="submit" id="agreeTerm" data-bs-toggle="modal" href="#reservationModal"
                            class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'اوافق' : 'Agree' }}</a>

                    </div>
                </div>
            </div>


        </form>
    </div>






    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
        aria-hidden="true">
        <form action="" id="reservationModalForm" enctype="multipart/form-data">

            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationModalLabel">
                            {{ Config::get('app.locale') == 'ar' ? 'حجز' : 'Reservation' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input class="" type="hidden" id="formFile" name="provider_id"
                            value="{{ $serviceProvider->id }}">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1 " class="form-label">
                                {{ Config::get('app.locale') == 'ar' ? 'تفاصيل الطلب' : 'Reservation details' }}</label>
                            <textarea class="form-control  custome-textFiled  textarea3 @error('desc') is-invalid @enderror" id="reservationInput"
                                maxlength="500" rows="3" name="desc"></textarea>
                            <div id="the-count3">
                                <span id="current3">0</span>
                                <span id="maximum3">/ 500</span>
                            </div>
                            @error('desc')
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







    <!--  JS  ------------------------------------------------------------------------------>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var current_URL = {!! json_encode(url()->current()) !!}

        var lang = {!! json_encode(config('app.locale')) !!};

        var profile_id = {!! json_encode($serviceProvider->id) !!};
        var provider = {!! json_encode($serviceProvider) !!};


        var user_rated = null;

        var isProviderAuth = false;
    </script>



    @if (Auth::check() && Auth::user()->hasVerifiedEmail())
        <script>
            user_rated = {!! json_encode($serviceProvider->rates->where('user_id', Auth::id())->first()) !!}
        </script>
    @endif

    @if (Auth::guard('provider')->check())
        <script>
            isProviderAuth = true;
        </script>
    @endif
    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/Readmore.js-master/readmore.min.js') }}"></script>
    <script src="{{ asset('Website_Assets/packages/EmojiRaiting-master/emoji.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}">
    </script>
    <script src=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/sharer.js-main/sharer.min.js') }}"></script>

    <!-- project js -->

    <script src=" {{ asset('Website_Assets/js/Global.js ') }}"></script>
    <script src=" {{ asset('Website_Assets/js/users/profile.js ') }}"></script>

    @if ($serviceProvider->lat != null)
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFc96BJRXrT7kN-mQb2PVGUzNEeSCI94w&callback=initMap&libraries=&v=weekly"
                async></script>
    @endif
    <!-- Modal -->
    <div class="modal fade i" id="staticBackdropMap" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ Config::get('app.locale') == 'ar' ? 'الموقع' : 'Location' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>

                </div>

            </div>
        </div>
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
