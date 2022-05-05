<!DOCTYPE html>

<html>

<head>
    <!-- Required meta tags -->

    @include('Website.globalElements.meta')
    <title>
        {{ Config::get('app.locale') == 'en' ? 'my reservations ' : 'حجوزاتي' }}
    </title>
    {{-- <meta name="description"
        content="{{ Config::get('app.locale') == 'en'? 'You can see the providers and professions you need, search for them and see their reviews.':
         'يمكنك رؤية مقدمي الخدمات واصحاب المهن الذين تحتاجهم والبحث عنهم ورئية تقييماتهم .' }}"> --}}

    <meta name='robots' content="noindex,nofollow">



    <!--  JS  ------------------------------------------------------------------------------>

    <!-- packages css -->
    <link rel="stylesheet"
        href=" {{ Config::get('app.locale') == 'ar' ? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css') : asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/animation/animation.min.css ') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/aos-master/dist/aos.css ') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.style.min.css') }}" />


    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/users/booking.css') }}" />

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

    <main>
        <section>
            <div class="bookings">


                <div class="container-lg">

                    <div class="drop">
                        <h5>
                            {{ Config::get('app.locale') == 'ar' ? 'حجوزاتي' : 'My Reservations' }}
                        </h5>
                        <div class="dropdown float-start">
                            <button class="button_1_style dropdown-toggle " type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $sort }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ url()->current() . '?sortby=oldest' }}">
                                        {{ Config::get('app.locale') == 'ar' ? 'الاقدم' : 'oldest' }}</a></li>
                                <li><a class="dropdown-item" href="{{ url()->current() . '?sortby=recent' }}">
                                        {{ Config::get('app.locale') == 'ar' ? 'الاحدث' : 'recent' }}</a></li>
                            </ul>
                        </div>
                    </div>


                    <br>
                    <br>

                    <div class="cards" style="min-height: 100vh">
                        <div class="row justify-content-center row-cols-1 row-cols-md-3 row-cols-xlg-4">

                            @if ($reservations->isEmpty())

                                <h6 style="text-align: center">
                                    {{ Config::get('app.locale') == 'ar' ? 'لاتوجد نتائج' : 'No results' }} </h6>
                            @else
                                @foreach ($reservations as $reservation)
                                    <div class="col " id="card_{{ $reservation->id }}"
                                        data-aos="zoom-in-up" style="margin-top: 10px">
                                        <a href="{{ route('profile', ['id' => $reservation->provider->id]) }}">
                                            <div class="card ">

                                                <img src="{{ asset('storage/' . $reservation->provider->image) }}"
                                                    height="250" class="card-img-top"
                                                    alt="{{ $reservation->provider->name }}">

                                                <div class="card-body">

                                                    <div class="content d-flex flex-column ">

                                                        <div class="personal-data">
                                                            <div class="name-address">
                                                                <h6>{{ strlen($reservation->provider->name) >= 25 ? substr($reservation->provider->name, 0, 25) . '...' : $reservation->provider->name }}
                                                                </h6>
                                                                <p>{{ $reservation->provider->country->name }} /
                                                                    {{ $reservation->provider->city != null ? $reservation->provider->city->name : $reservation->provider->state->name }}
                                                                </p>


                                                                <p> {{ Config::get('app.locale') == 'ar'
                                                                    ? $reservation->provider->serviceCatogrey->name_ar
                                                                    : $reservation->provider->serviceCatogrey->name_en }}
                                                                    /
                                                                    {{ Config::get('app.locale') == 'ar' ? $reservation->provider->specialization->name_ar : $reservation->provider->specialization->name_en }}
                                                                </p>





                                                            </div>
                                                            <div class="rate d-flex flex-column justify-content-end">
                                                                😍
                                                                {{ number_format((float) $reservation->provider->rates->avg('rate'), 1, '.', '') }}
                                                                <br>
                                                                <br>
                                                                <p style="font-weight: bold;">
                                                                    {{ Config::get('app.locale') == 'ar' ? 'رقم الحجز :' : 'Reservation number :' }}
                                                                    {{ $reservation->id }} </p>

                                                                <p style="color: gray">
                                                                    {{ Carbon\Carbon::parse($reservation->created_at)->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="bio"
                                                            style="overflow: hidden;margin-bottom: 5px">
                                                            <p style="color: black;">
                                                                {{ strlen($reservation->describe) >= 150 ? mb_strimwidth($reservation->describe, 0, 150, '...') : $reservation->describe }}
                                                                <a></a>
                                                                @if (strlen($reservation->describe) >= 150)
                                                                    <a href="#" class="more"
                                                                        data-bs-target="#cardModal_{{ $reservation->id }}"
                                                                        data-bs-toggle="modal"
                                                                        style="color: var(--primary);  text-decoration: underline;">
                                                                        {{ Config::get('app.locale') == 'ar' ? 'المزيد' : 'More' }}

                                                                    </a>
                                                                @endif
                                                            </p>
                                                        </div>

                                                        <div class="status" data-id="{{ $reservation->id }}"
                                                            style="font-size: 10px;font-weight: bold;color: {{ $reservation->ordersStatus_id == 1 || $reservation->ordersStatus_id == 3 ? 'orange' : ($reservation->ordersStatus_id == 2 || $reservation->ordersStatus_id == 5 ? 'red' : 'green') }};">
                                                            {{ Config::get('app.locale') == 'ar' ? $reservation->orderStatus->descUser_ar : $reservation->orderStatus->descUser_en }}
                                                        </div>

                                                    </div>


                                                </div>

                                                <a>
                                                    @if ($reservation->ordersStatus_id != 4)
                                                        <div class=" remove" style="z-index: 9999"
                                                            data-id="{{ $reservation->id }}"
                                                            style="background: white">
                                                            <i class="fas fa-trash" style="color: #f27474"></i>
                                                        </div>
                                                    @endif

                                                </a>

                                            </div>


                                        </a>

                                    </div>

                                    <div class="modal fade i cardModal_{{ $reservation->id}}"
                                        id="cardModal_{{ $reservation->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="cardModal_{{ $reservation->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="">
                                                        {{ Config::get('app.locale') == 'ar' ? 'تفاصيل الحجز  #' . $reservation->id : 'Reservation Details #' . $reservation->id }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>{{ $reservation->describe }} </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
            </div>
            <br>
            {{-- <div aria-label="Page navigation" class="pagi">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>


        </div> --}}

            @if ($reservations->isEmpty() == false)
                {!! $reservations->links() !!}
            @endif

            <br>

        </section>

    </main>





    <!-------------------------------------End Bookings Section-->

    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
        var userId = {!! json_encode(auth()->user()->id) !!};
    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" type="module"></script>
    <script src=" {{ asset('Website_Assets/packages/Toast-Popup-Plugin-jQuery-Toaster/toast.script.js') }}"></script>



    <!-- project js -->
    <script src=" {{ asset('Website_Assets/js/Global.js ') }}"></script>
    <script src=" {{ asset('Website_Assets/js/users/bookings.js ') }}"></script>

    <!--------------------------------------------------------------------------------------->

</body>

</html>
