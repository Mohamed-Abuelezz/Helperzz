<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\ServiceProvider;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ServiceCatogrey;
use App\Models\Specialization;
use App\Models\MoreService;
use App\Models\MoreServiceOfServiceProvider;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $providers = ServiceProvider::all();
        //
        return view('Dashboard.screens.providers.providers', ['providers' => $providers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::all();
        $servicesCatogries = ServiceCatogrey::all();
        $specializations = Specialization::all();
        return view('Dashboard.screens.providers.create', ['countries' => $countries,'servicesCatogries' => $servicesCatogries,'specializations' => $specializations]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users|unique:serviceproviders',
            'password' => 'required|min:8',
            'phone' => 'required|min:6',
            'wallet' => 'nullable|numeric',
            'bio' => 'required|max:500',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'serviceCatogrey' => 'required',
            'specialization' => 'required',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'idCard' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $imagePath =    myStoreUploadImages('providers_images', $request);
        $imageCardPath =  Storage::disk('public')->putFile('idCards_images', $request->file('idCard'));


        $serviceProvider =    new ServiceProvider;
        $serviceProvider->image = $imagePath;
        $serviceProvider->idCard_photo = $imageCardPath;

        $serviceProvider->name = $request->name;
        $serviceProvider->email = $request->email;
        $serviceProvider->phone = $request->phone;
        $serviceProvider->password = Hash::make($request->password);
        $serviceProvider->wallet = $request->wallet;
        $serviceProvider->bio = $request->bio;
        $serviceProvider->country_id = $request->country;
        $serviceProvider->state_id = $request->state;
        $serviceProvider->city_id = $request->city;
        $serviceProvider->lat = $request->lat;
        $serviceProvider->lng = $request->lng;
        $serviceProvider->serviceCatogrey_id = $request->serviceCatogrey;
        $serviceProvider->specialization_id = $request->specialization;
        

       
        $serviceProvider->gender = $request->gender;
        $serviceProvider->isActive = true;
        $serviceProvider->email_verified_at = now();






        $serviceProvider->save();


               
        if ($request->moreServices != null) {
            # code...

            foreach($request->moreServices as $item) {
                $moreServiceOfServiceProvider =    new MoreServiceOfServiceProvider;

                $moreServiceOfServiceProvider->serviceProvider_id = $serviceProvider->id;
                $moreServiceOfServiceProvider->moreService_id = $item;

              $moreServiceOfServiceProvider->save();
            
            }
        }
       
        $serviceProviderContent = $request->name . "\r\n" . $request->email . "\r\n" . Crypt::encryptString($request->password) . "\r\n" . $request->phone . "\r\n" . $serviceProvider->country->name . "\r\n" . $serviceProvider->state->name . "\r\n" . $serviceProvider->city->name . "\r\n" . ($request->gender == 1 ? 'Male' : 'Female') . "\r\n" . $imagePath;

        $passwordPath =   Storage::put('serviceProviderInformations/' . $request->email . '.txt', $serviceProviderContent);


        return redirect()->route('providers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $serviceCatogries = ServiceCatogrey::all();
        $specializations = Specialization::all();
        $moreServices = MoreService::all();
      

        $serviceProvider = ServiceProvider::where('id', $id)->first();
        $moreServiceOfServiceProvider = MoreServiceOfServiceProvider::where('serviceProvider_id', $id)->get();

        //
        return view('Dashboard.screens.providers.edit', [
            'serviceProvider' => $serviceProvider,
            'moreServiceOfServiceProvider' => $moreServiceOfServiceProvider,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'serviceCatogries' => $serviceCatogries,
            'specializations' => $specializations,
            'moreServices' => $moreServices,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
                //
                if ($request->ajax()) {

                    $serviceProvider = ServiceProvider::findOrFail($id);
                    $serviceProvider->isActive = (int)$request->input('isActive');
                    $serviceProvider->save();
        
                    return myAjaxResponse($serviceProvider, 'تم التحديث بنجاح', 200);
                }else{
        
                    $validated = $request->validate([
                        'name' => 'required|max:50',
                        'email' => 'required|email|unique:users|unique:serviceproviders,email,'. $id,
                        'password' => 'nullable|min:8',
                        'phone' => 'required|min:6',
                        'wallet' => 'nullable|numeric',
                        'bio' => 'required|max:500',
                        'country' => 'required',
                        'state' => 'required',
                        'city' => 'required',
                        'lat' => 'nullable|numeric',
                        'lng' => 'nullable|numeric',
                        'serviceCatogrey' => 'required',
                        'specialization' => 'required',
                        'gender' => 'required',
                        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                        'idCard' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                                ]);
        
        
        
        
        
                    $serviceProvider =     ServiceProvider::find($id);
                    $serviceProvider->name = $request->name;
                    
                    Storage::move('serviceProviderInformations/'.$serviceProvider->email.'.txt', 'serviceProviderInformations/'.$request->email.'.txt'); // keep the same folder to just rename 
        
                    $serviceProvider->email = $request->email;
        
                    $serviceProvider->phone = $request->phone;
        
                    if ($request->password != null) {
                        # code...
                        $serviceProvider->password = Hash::make($request->password);
        
                    }
        
                    $serviceProvider->bio = $request->bio;
        
                    $serviceProvider->country_id = $request->country;
                    $serviceProvider->state_id = $request->state;
                    $serviceProvider->city_id = $request->city;
                    
                    $serviceProvider->lat = $request->lat;
                    $serviceProvider->lat = $request->lat;


                    $serviceProvider->serviceCatogrey_id = $request->serviceCatogrey;
                    $serviceProvider->specialization_id = $request->specialization;


                    $serviceProvider->gender = $request->gender;

                    if ($request->image != null) {
                        # code...
                        myDeleteUploadedImage($serviceProvider->image);
                        $imagePath =    myStoreUploadImages('providers_images', $request);
                        $serviceProvider->image = $imagePath;
                    }
            
                    if ($request->idCard != null) {
                        # code...
                        myDeleteUploadedImage($serviceProvider->idCard_photo);
                        $imagePath = Storage::disk('public')->putFile('idCards_images', $request->file('idCard'));
                        $serviceProvider->idCard_photo = $imagePath;
                    }


                    $serviceProvider->save();
        
                }
        
        
                return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        if ($request->ajax()) {

            $serviceProvider = ServiceProvider::findOrFail($id);


            myDeleteUploadedImage($serviceProvider->image);
            myDeleteUploadedImage($serviceProvider->idCard_photo);

            $serviceProvider->delete();

            return myAjaxResponse($serviceProvider, 'تم بنجاح', 200);
        }
    }
}
