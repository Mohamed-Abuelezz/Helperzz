<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ServiceCatogrey;
use App\Models\Specialization;
use App\Models\MoreService;
use App\Models\ServiceProvider;
use App\Models\Favourite;
use App\Models\WebsiteViews;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {

        
        $websiteViews =     WebsiteViews::where('mac', $_SERVER['REMOTE_ADDR'])->whereDate('created_at', Carbon::today())->get();
//dd($websiteViews);
        if ($websiteViews->isEmpty()) {
            # code...
         //   dd(empty($ServiceProviderView));

            $websiteViews = new WebsiteViews;
            $websiteViews->mac =  $_SERVER['REMOTE_ADDR'];
            $websiteViews->save();


            return redirect()->route('index', []);
        }



        $states = null;
        $details = getMyLocationDetails();
        $lat =  explode(',',  $details->loc)[0];
        $lng =  explode(',', $details->loc)[1];
        $countryCode = $details->country;
        $states =   Country::where('code', $countryCode)->first()->states;
        $servicesCatogries = ServiceCatogrey::where('isActive', true)->get();
        $specializations = Specialization::where('isActive', true)->get();
        $mores = MoreService::where('isActive', true)->get();
        $search_key =  $request->input('search_key');


        $providers = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 || $request->input('order-key') == null ? 'DESC' : 'ASC'))
            ->paginate(12);

        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }
        //////////////////////
        //   $providersMaps 

        $providersMaps = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 || $request->input('order-key') == null ? 'DESC' : 'ASC'))
            ->get();


        return view('Website.users.home', [
            'servicesCatogries' => $servicesCatogries,
            'specializations' => $specializations,
            'mores' => $mores,
            'states' => $states,
            'lat' => $lat,
            'lng' => $lng,


            'providers' => $providers,
            'providersMaps' => $providersMaps,
            'userFavourites' => $userFavourites,


        ]);
    }


    public function advancedSearch(Request $request)
    {

        $details = getMyLocationDetails();

        $countryCode = $details->country;

        $service_category = $request->input('service_category');
        $specialization  = $request->input('specialization');
        $more  = $request->input('more');
        $state   = $request->input('state');
        $city  = $request->input('city');
        $search_key =  $request->input('search_key');

        $providers = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 || $request->input('order-key') == null ? 'DESC' : 'ASC'))
            ->paginate(12);



        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }

        //////////////////////////////

        $providersMaps = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')->whereNotNull('lat')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 || $request->input('order-key') == null ? 'DESC' : 'ASC'))
            ->get();







        return myAjaxResponse(
            [
                'view' =>  view('Website.globalElements.custome screens.home.provider', [
                    'userFavourites' => $userFavourites,
                    'providers' => $providers,
                ])->render(),
                'providersMaps' => $providersMaps

            ]


        );
    }

    public function moreProveiders(Request $request)
    {

        $details = getMyLocationDetails();

        $countryCode = $details->country;

        $service_category = $request->input('service_category');
        $specialization  = $request->input('specialization');
        $more  = $request->input('more');
        $state   = $request->input('state');
        $city  = $request->input('city');
        $search_key =  $request->input('search_key');

        $providers = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 || $request->input('order-key') == null ? 'DESC' : 'ASC'))
            ->paginate(12);

//return myAjaxResponse($providers);
        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }



        return myAjaxResponse(
            [
                'view' =>  view('Website.globalElements.custome screens.home.provider', [
                    'userFavourites' => $userFavourites,
                    'providers' => $providers,
                ])->render(),
                //  'providers' => $providers

            ]


        );
    }



    public function orderByProveiders(Request $request)
    {

        $details = getMyLocationDetails();

        $countryCode = $details->country;

        $service_category = $request->input('service_category');
        $specialization  = $request->input('specialization');
        $more  = $request->input('more');
        $state   = $request->input('state');
        $city  = $request->input('city');
        $search_key =  $request->input('search_key');

        $providers = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 ? 'DESC' : 'ASC'))
            ->paginate(12);


        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }



        return myAjaxResponse(
            view('Website.globalElements.custome screens.home.provider', [
                'userFavourites' => $userFavourites,
                   'providers' => $providers,
            ])->render()


        );
    }





    public function searchProveiders(Request $request)
    {

        $details = getMyLocationDetails();

        $countryCode = $details->country;

        $service_category = $request->input('service_category');
        $specialization  = $request->input('specialization');
        $more  = $request->input('more');
        $state   = $request->input('state');
        $city  = $request->input('city');
        $search_key =  $request->input('search_key');

        $providers = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 ? 'DESC' : 'ASC'))
            ->paginate(12);


        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }

        ////////////////////////////////////////
        $providersMaps = ServiceProvider::where('country_id', Country::where('code', $countryCode)->first()->id)
            ->where('isActive', true)
            ->whereNotNull('email_verified_at')
            ->where(function ($query) use ($service_category,) {
                if ($service_category != 'all') {

                    $query->where('serviceCatogrey_id', $service_category);
                }

                return  $query;
            })
            ->where(function ($query) use ($specialization,) {
                if ($specialization != 'all') {

                    $query->where('specialization_id', $specialization);
                }

                return  $query;
            })
            ->where(function ($query) use ($more,) {
                if ($more != 'all') {

                    $query->where(function ($subquery) use ($more) {

                        $subquery->whereHas('moreservicesofserviceproviders', function ($q) use ($more) {

                            $q->where('moreService_id', $more);

                            return $q;
                        });

                        return $subquery;
                    });




                    return  $query;
                }
            })
            ->where(function ($query) use ($state,) {
                if ($state != 'all') {

                    $query->where('state_id', $state);
                }

                return  $query;
            })
            ->where(function ($query) use ($city,) {
                if ($city != 'all') {

                    $query->where('city_id', $city);
                }

                return  $query;
            })
            ->where(function ($query) use ($search_key,) {
                if ($search_key != null) {

                    $query->where('name', 'like', '%' . $search_key . '%');
                }

                return  $query;
            })
            ->with(['specialization', 'serviceCatogrey', 'country', 'state', 'city',])
            ->withCount(['rates as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])->orderBy('average_rating', ($request->input('order-key') == 1 ? 'DESC' : 'ASC'))
            ->get();
        return myAjaxResponse(
            [
                'view' =>  view('Website.globalElements.custome screens.home.provider', [
                    'userFavourites' => $userFavourites,
                    'providers' => $providers,
                ])->render(),
                'providersMaps' => $providersMaps

            ]


        );
    }
}
