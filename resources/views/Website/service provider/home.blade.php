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
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/aos-master/dist/aos.css ') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.css') }}" rel="stylesheet">


    <!-- project css -->

    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/service_provider/home.css') }}" />

    <!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">

    @include('Website.globalElements.loading')

    <!------------------------------------- NavBar Section-->

    @include('Website.globalElements.navbar_providerAuth')


    <!-------------------------------------End NavBar Section-->


    <!------------------------------------- Taps Section-->

    <br>
    <br>
    <br>
    <br>
    <section>

        <div class="taps container">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="button_1_style  {{ $reservations->currentPage() == 1 ? 'active' : '' }}"
                        id="pills-statistics-tab" data-bs-toggle="pill" data-bs-target="#pills-statistics" type="button"
                        role="tab" aria-controls="pills-statistics" aria-selected="true">
                        {{ Config::get('app.locale') == 'ar' ? 'الاحصائيات' : 'Statistics' }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="button_1_style {{ $reservations->currentPage() > 1 ? 'active' : '' }}"
                        id="pills-bookings-tab" data-bs-toggle="pill" data-bs-target="#pills-bookings" type="button"
                        role="tab" aria-controls="pills-bookings" aria-selected="false">
                        {{ Config::get('app.locale') == 'ar' ? 'الحجوزات' : 'Reservations' }}</button>
                </li>
            </ul>



            <div class="tab-content" id="pills-tabContent">



                <br>
                <br>



                <div class="tab-pane statistics fade {{ $reservations->currentPage() == 1 ? 'show active' : '' }} "
                    id="pills-statistics" role="tabpanel" aria-labelledby="pills-statistics-tab">

                    <div class="cards">
                        <!-- <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header">Views</div>
                            <div class="card-body">
                                <br>
                                <h5 class=" card-title">50</h5>
                            </div>
                        </div> -->

                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                {{ Config::get('app.locale') == 'ar' ? 'الحجوزات' : 'Reservations' }}</div>
                            <div class="card-body">
                                <br>
                                <h5 class=" card-title">
                                    {{ App\Models\Order::where('serviceProvider_id', Auth::guard('provider')->id())->whereIn('ordersStatus_id', [3, 4, 5])->count() }}
                                </h5>
                            </div>
                        </div>

                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                {{ Config::get('app.locale') == 'ar' ? 'المفضلة' : 'Favourites' }}</div>
                            <div class="card-body">
                                <br>
                                <h5 class=" card-title">
                                    {{ App\Models\Favourite::where('serviceProvider_id', Auth::guard('provider')->id())->count() }}
                                </h5>
                            </div>
                        </div>

                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                {{ Config::get('app.locale') == 'ar' ? 'اجمالي المشاهدات' : 'Total Views' }}</div>
                            <div class="card-body">
                                <br>
                                <h5 class=" card-title">
                                    {{ App\Models\ServiceProviderView::where('serviceProvider_id', Auth::guard('provider')->id())->count() }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <!-- <div class="charts">

                        <div class="char">
                            <h6>Rates</h6>
                            <canvas id="myChart1" width="100" height="100"></canvas>

                        </div>

                        <div class="char">
                            <h6>Bookings</h6>
                            <canvas id="myChart2" width="100" height="100"></canvas>

                        </div>

                       <div class="char">
                            <h6>Bookings</h6>
                            <canvas id="myChart3" width="100" height="100"></canvas>

                        </div>

                    </div> -->



                    <div class="charts">


                        <canvas id="myChart">



                        </canvas>




                    </div>



                </div>












                <div class="tab-pane bookings fade  {{ $reservations->currentPage() > 1 ? 'show active' : '' }} "
                    id="pills-bookings" role="tabpanel" aria-labelledby="pills-bookings-tab">


                    <div class="cards" style="min-height: 100vh">
                        <div class="row justify-content-center row-cols-1 row-cols-lg-3 row-cols-xl-4 g-1">

                            @if ($reservations->isEmpty())
                            <h6 style="text-align: center"> {{ Config::get('app.locale') == 'ar' ? 'لاتوجد حجوزات 😥' : 'No Reservations 😥' }} </h6>

                            @else

                            @foreach ($reservations as $reservation)
                            <div class="col " id="card_{{ $reservation->id }}" data-aos="zoom-in-up"
                                style="margin-top: 10px">
                                <div class="card shadow" style="height: 500px;overflow: hidden">

                                    <img  src="{{ $reservation->user->image == null || $reservation->ordersStatus_id == 3 || $reservation->ordersStatus_id == 5? asset('Website_Assets/assets/images/userImageDefault.png'): asset('storage/' . $reservation->user->image) }} "
                                        height="250" class="card-img-top order_image" data-id="{{$reservation->id}}" alt="...">

                                    <div class="card-body">

                                        <div class="content d-flex flex-column justify-content-between" style="height: 100%">

                                            <div class="personal-data">
                                                <div class="name-address"
                                                    style="text-align:{{ Config::get('app.locale') == 'ar' ? 'right' : 'left' }}">
                                                    <h6 class="order_name" data-id="{{$reservation->id}}">{{ $reservation->ordersStatus_id == 3 || $reservation->ordersStatus_id == 5? '': (strlen($reservation->user->name) >= 22? substr($reservation->user->name, 0, 22) . '...': $reservation->user->name) }}
                                                    </h6>
                                                    <p class="order_address"  data-id="{{$reservation->id}}" >
                                                    @if ($reservation->ordersStatus_id == 4)
                                                    {{ $reservation->user->country->name }} /
                                                        {{ $reservation->user->city->name }}

                                                    @endif
                                                </p>
                                                </div>
                                                <div class="rate d-flex flex-column justify-content-end">

                                                    <p style="font-weight: bold;">
                                                        {{ Config::get('app.locale') == 'ar' ? 'رقم الحجز :' : 'Reservation number :' }}
                                                        {{ $reservation->id }} </p>

                                                    <p style="color: gray">
                                                        {{ Carbon\Carbon::parse($reservation->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="bio" style="overflow: hidden;margin-bottom: 5px">
                                                <p style="color: black;">
                                                    {{ strlen($reservation->describe) > 250? substr($reservation->describe, 0, 250) . '...': $reservation->describe }}
                                                    <a></a>
                                                    {{-- @if (strlen($reservation->describe) > 250)
                                                        <a href="#"
                                                            data-bs-target="#cardModal"
                                                            data-bs-toggle="modal"
                                                            style="color: var(--primary);  text-decoration: underline;">
                                                            {{ Config::get('app.locale') == 'ar'?    'المزيد' : 'More' }}
                                                        </a>
                                                    @endif --}}
                                                </p>
                                            </div>

                                            <div class="status" id="status" data-id="{{ $reservation->id}}"
                                                style="font-size: 12px;margin-bottom: 5px;color: {{ $reservation->ordersStatus_id == 5 ? 'red' : 'green' }};">
                                                @if ($reservation->ordersStatus_id == 3)
                                                    <a  class="button_1_style accept_btn"
                                                        style="height: 10px"id='accept_btn' data-id="{{$reservation->id}}">{{ Config::get('app.locale') == 'ar' ? 'القبول' : 'Accept' }}</a>
                                                    <a  class="button_1_style refused_btn"
                                                        style="background-color: red;" id='refused_btn' data-id="{{$reservation->id}}">{{ Config::get('app.locale') == 'ar' ? 'الرفض' : 'Refused' }}</a>
                                                    <br>
                                                @else
                                                    {{ Config::get('app.locale') == 'ar'? $reservation->orderStatus->descProvider_ar: $reservation->orderStatus->descProvider_en }}
                                                    @if ($reservation->ordersStatus_id == 4)
                                                        <div>
                                                            <a data-bs-target="#reservation_Modal"  data-bs-toggle="modal" id="reservationDetails_btn"
                                                                style="color: var(--primary);text-decoration: underline;cursor: pointer;" data-id="{{$reservation->id}}">
                                                                {{ Config::get('app.locale') == 'ar' ? "تفاصيل الحجز":"Reservation Details"}}
                                                                
                                                                </a>
                                                        </div>
                                                    @endif
                                                @endif

                                            </div>

                                        </div>


                                    </div>

                                    <a>
                                        {{-- @if ($reservation->ordersStatus_id != 4)
                                            <div class="fav remove" style="z-index: 9999"
                                                data-id="{{ $reservation->id }}" style="background: white">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                        @endif --}}

                                    </a>

                                </div>



                            </div>
                        @endforeach

                            @endif






                        </div>







                    </div>



                    <br>



                    @if ($reservations->isEmpty() == false)
                        {!! $reservations->links() !!}
                    @endif




                </div>





            </div>
        </div>

        </div>












    </section>



    <br>



    <!-------------------------------------End Bookings Section-->

    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!------------------------------------- Modal Section-->


    <div class="modal fade i" id="reservation_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="reservationModal" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalTitle">
                                       
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reservationModalbody">

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="termsModal" tabindex="-1" data-id="" aria-labelledby="termsModalLabel" aria-hidden="true">

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

                            @foreach ($acceptOrderConditions as $orderCondition)
                                <li>{{ Config::get('app.locale') == 'ar' ? $orderCondition->describe_ar : $orderCondition->describe_en }}
                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="modal-footer">
<div style="width: 100px">
    <div id="loadingAgree"  >
                           
        <a type="submit" id="agreeTerm" 
        class="button_1_style">{{ Config::get('app.locale') == 'ar' ? 'اوافق' : 'Agree' }}</a>

    </div>
</div>

                    </div>
                </div>
            </div>


    </div>

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
        //  var viewsCount = {!! json_encode(App\Models\ServiceProviderView::where('serviceProvider_id', Auth::guard('provider')->id())->count()) !!};
        var views = {!! json_encode($serviceProviderViews) !!};
        var reservations = {!! json_encode($reservations) !!};
        var profile_id = {!! json_encode(Auth::guard('provider')->user()->id) !!};

    </script>


    <!-- packages js -->
    <script src="{{ asset('Website_Assets/packages/jquery/jquery.mini.js') }}"> </script>
    <script src=" {{ asset('Website_Assets/packages/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/charts/charts.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/js-loading-overlay-master/dist/js-loading-overlay.min.js') }}"></script>
    <script src=" {{ asset('Website_Assets/packages/sweet alert/dist/sweetalert2.min.js') }}"></script>
    {{-- <script  src="{{asset('/dist/js/echo.js')}}"  type="module"></script>
   <script  src="{{asset('/dist/js/echo.common.js')}}"  type="module"></script> 
 --}}


    <!-- project js -->

    <script src=" {{ asset('Website_Assets/js/Global.js') }}"></script>
    <script src=" {{ asset('Website_Assets/js/service_provider/home.js') }}"></script>

    <!--------------------------------------------------------------------------------------->

</body>

</html>
