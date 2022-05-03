<?php

namespace App\Http\Controllers\Website\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\MoreServiceOfServiceProvider;
use App\Models\ServiceCatogrey;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class AccountController extends Controller
{
    //

    public function index(Request $request)
    {
        $details = getMyLocationDetails();
        $lat =  explode(',',  $details->loc)[0];
        $lng =  explode(',', $details->loc)[1];

        $countrey = Country::where('code', $details->country)->first();
        $serviceCatogries = ServiceCatogrey::where('isActive', true)->get();


        return view('Website.service provider.editAccount', [
            'countrey' => $countrey,
            'serviceCatogries' => $serviceCatogries,
            'lat' => $lat,
            'lng' => $lng,

        ]);

    }


    public function edit(Request $request)
    {

      //  dd($request->all());

        $validated = $request->validateWithBag('provider', [
            'name' => 'required|max:26',
            'email' => 'required|email|unique:users,email,'.Auth::guard('provider')->id().'|unique:serviceproviders,email,'.Auth::guard('provider')->id(),
            'phone' => 'required|min:6',
            'bio' => 'required|max:500',

            'country' => 'required',
            'state' => 'required',

            'service_department' => 'required',
            'specialization' => 'required',


            'gender' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imagePath = null;

        if ($request->image != null) {
            # code...
            $imagePath =    myStoreUploadImages('user_images', $request);
            $serviceProvider =    ServiceProvider::where('id', Auth::guard('provider')->id())->update([
                'image' => $imagePath,
            ]);

        }
        Storage::move('serviceProviderInformations/'.Auth::guard('provider')->user()->email.'.txt', 'serviceProviderInformations/'.$request->email.'.txt'); // keep the same folder to just rename 


        $serviceProvider =    ServiceProvider::where('id', Auth::guard('provider')->id())->update([
            'name' =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'serviceCatogrey_id' => $request->service_department,
            'specialization_id' => $request->specialization,
            'gender' => $request->gender,
        ]);
      
        MoreServiceOfServiceProvider::where('serviceProvider_id', Auth::guard('provider')->id())->delete();

        if ($request->more != null ||$request->more != []) {
            # code...
            foreach ($request->more as $m) {
                // code
                $moreServiceOfServiceProvider = new  MoreServiceOfServiceProvider();

                $moreServiceOfServiceProvider->serviceProvider_id =   Auth::guard('provider')->id();
                $moreServiceOfServiceProvider->moreService_id = $m;

                $moreServiceOfServiceProvider->save();
            }
        }



  //   return   $request->all();
     return redirect()->back()->with('msg', Config::get('app.locale') == 'ar' ?  ' تم التعديل بنجاح.' : 'Edit Succesfully.');

    }
}
