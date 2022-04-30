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
    <link rel="stylesheet" href=" {{ asset('Website_Assets/packages/aos-master/dist/aos.css ') }}" rel="stylesheet">


    <!-- project css -->
    <link rel="stylesheet" href="{{ asset('Website_Assets/css/Global.css') }}" />
    <link rel="stylesheet" href=" {{ asset('Website_Assets/css/users/favourites.css') }}" />

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


    <!------------------------------------- Favourites Section-->

    <br>
    <br>
    <br>
    <br>

    <section>
        <div class="cards container" style="height: 100vh">


            <div class="row justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-4 g-5">
@if ($favourites->isEmpty())
    

<h6 style="text-align: center"> {{Config::get('app.locale')  == 'ar' ? 'لاتوجد نتائج 😥': 'No results 😥'}} </h6> 



@else
@foreach ($favourites as $favourite)
<div class="col " id="card_{{$favourite->id}}" data-aos="flip-up">
    <a href="{{route('profile', ['id'=>$favourite->provider->id])}}">
        <div class="card shadow">
            <img src="{{ asset('storage/' . $favourite->provider->image) }}" height="250"
                class="card-img-top " alt="...">
            <div class="card-body">

                <div class="content">

                    <div class="personal-data">
                        <div class="name-address">
                            <h6> {{ strlen($favourite->provider->name) >= 25? substr($favourite->provider->name, 0, 25) . '...': $favourite->provider->name }}
                            </h6>
                            <p> {{ $favourite->provider->country->name . '/' . $favourite->provider->city->name }}
                            </p>
                            <p>  {{ Config::get('app.locale') == 'ar' ? $favourite->provider->serviceCatogrey->name_ar : $favourite->provider->serviceCatogrey->name_en }} / {{ Config::get('app.locale') == 'ar' ? $favourite->provider->specialization->name_ar : $favourite->provider->specialization->name_en }} </p>
                        </div>
                        <div class="rate">
                            😍
                            {{ number_format((float) $favourite->provider->rates->avg('rate'), 1, '.', '') }}
                        </div>
                    </div>

                    <div class="bio">
                        <p> {{ strlen($favourite->provider->bio) >= 200? substr($favourite->provider->bio, 0, 199) . '...': $favourite->provider->bio }}
                        </p>
                    </div>

                </div>


            </div>

            <a>

                    <div class="fav remove"   data-id="{{$favourite->id}}" style="background-color: white">
                        <i class="fas fa-trash"></i>
                    </div>


                </a>


    </a>
</div>
@endforeach
@endif


            </div>



        </div>

        <br>
        <br>
        @if ($favourites->isEmpty() == false)
        {!! $favourites->links() !!}
    @endif
    <br>

    </section>





    <!-------------------------------------End Favourites Section-->

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
    <script src=" {{ asset('Website_Assets/packages/aos-master/dist/aos.js') }}"></script>



    <!-- project js -->

    <script src=" {{ asset('Website_Assets/js/Global.js ') }}"></script>
    <script src=" {{ asset('Website_Assets/js/users/favourites.js ') }}"></script>

    <!--------------------------------------------------------------------------------------->

</body>

</html>
