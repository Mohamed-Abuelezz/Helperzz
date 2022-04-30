
@if ($providers->isEmpty())

@else
@foreach ( $providers as $provider)



<div class="col " data-aos="zoom-in-up" style="margin-top: 10px">
    <a href="{{route('profile', ['id'=>$provider->id])}}">
        <div class="card shadow">
            <img src="{{ asset('storage/'.$provider->image) }}" height="250" class="card-img-top " 

            alt="...">
            <div class="card-body">

                <div class="content">

                    <div class="personal-data" >
                        <div class="name-address">
                            <h6> {{ strlen($provider->name) >= 25 ? substr($provider->name,0,25)."..." :   $provider->name}}</h6>
                            <p> {{$provider->country->name . '/' .$provider->city->name }}</p>
                            <p>  {{ Config::get('app.locale') == 'ar' ? $provider->serviceCatogrey->name_ar : $provider->serviceCatogrey->name_en }} / {{ Config::get('app.locale') == 'ar' ? $provider->specialization->name_ar : $provider->specialization->name_en }} </p>
                        </div>
                        <div class="rate">
                            😍 {{number_format((float)$provider->rates->avg('rate'), 1, '.', '')}}
                        </div>
                    </div>

                    <div class="bio">
                        <p> {{ strlen($provider->bio) >= 200 ? substr($provider->bio,0,199)."..." :   $provider->bio}}
                        </p>
                    </div>

                </div>


            </div>
            <div class="loading" id="load-{{$provider->id}}">

            <a  class="addFav" id="{{$provider->id}}" data-id="{{$provider->id}}" >
                    <div class="fav" >
                        <i class="fas fa-heart"    data-id="{{$provider->id}}" style=" color: {{ Auth::check() && in_array($provider->id, $userFavourites->pluck('serviceProvider_id')->toArray()) ?  '#FFE652' : 'white'}} "></i>
                    </div>

            </a>
        </div>

        </div>


    </a>
</div>


@endforeach
@endif
