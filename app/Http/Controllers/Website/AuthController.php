<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use Illuminate\Auth\Events\Registered;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\MoreService;
use App\Models\MoreServiceOfServiceProvider;
use App\Models\ServiceCatogrey;
use App\Models\ServiceProvider;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function index()
    {

        $details = getMyLocationDetails();
        $lat =  explode(',',  $details->loc)[0];
        $lng =  explode(',', $details->loc)[1];

        $countrey = Country::where('code', $details->country)->first();
        $serviceCatogries = ServiceCatogrey::where('isActive', true)->get();


        return view('Website.auth', [
            'countrey' => $countrey,
            'serviceCatogries' => $serviceCatogries,
            'lat' => $lat,
            'lng' => $lng,

        ]);
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validated = $request->validateWithBag('login', [
            'email' => 'required|email',
            'password' => 'required',

        ]);


      //  dd($request->all());
$remeber = false;

        if($request->remember != null){
            $remeber = true;


        }

        

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1],$remeber)) {
            $request->session()->regenerate();

            if (Auth::user()->hasVerifiedEmail()) {
                # code...
                return redirect()->intended('/');
            } else {
                # code...
                return  redirect()->route('verification.notice');
            }
        }

        if ( Auth::guard('provider')->attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1],$remeber) ) {
            $request->session()->regenerate();

            if ( Auth::guard('provider')->user()->hasVerifiedEmail()) {
                # code...
            return redirect()->route('provider.index');

            } else {
                # code...
                return  redirect()->route('verification.notice');
            }

        }

        return back()->withErrors([
            'email' =>  Config::get('app.locale') == 'ar' ?  'بيانات تسجيل الدخول غير صحيحة.'   : 'The login information is incorrect.',
        ], 'login')->onlyInput('email');
    }





    //
    public function register(Request $request)
    {

        if ($request->input('type') == 'user') {
            # code...
            return  $this->registerUser($request);
        } else {
            # code...
            return  $this->registerProvider($request);
        }
    }



    public function logout(Request $request)
    {
        if (Auth::guard('provider')->check()) {
            # code...
            Auth::guard('provider')->logout();

        } else {
            # code...
            Auth::logout();

        }
        
        return redirect('/authentication');
    }



    // Helper Methods


    public function registerUser(Request $request)
    {

        //    dd($request->all());
        if ($request->input('terms') == null) {
            # code...
            redirect()->back()->withErrors(['msg' => (Config::get('app.locale') == 'ar' ?  'للتسجيل يجب الموافقة علي الشروط والاحكام اولا.' : 'To register, you must first agree to the terms and conditions.')]);
        }

        $validated = $request->validateWithBag('user', [
            'terms' => 'required',
            'name' => 'required|max:26',
            'email' => 'required|email|unique:users|unique:serviceproviders,email',
            'password' => 'required|min:8',
            'phone' => 'required|min:6',
            'country' => 'required',
            'state' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imagePath = null;

        if ($request->image != null) {
            # code...
            $imagePath =    myStoreUploadImages('user_images', $request);
        }



        $user =    new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->gender = $request->gender;
        $user->image = $imagePath;
        $user->isActive = true;


        $user->save();

        $userContent = $request->name . "\r\n" .
         $request->email . "\r\n" .
          Crypt::encryptString($request->password) . "\r\n" .
           $request->phone . "\r\n" . 
           $user->country->name . "\r\n" . 
           $user->state->name . "\r\n" . 
           $user->city != null ? $user->city->name : 'لاتوجد مدينة' . "\r\n" .
            ($request->gender == 1 ? 'Male' : 'Female') . "\r\n" . $imagePath;

        $passwordPath =   Storage::put('userInformations/' . $request->email . '.txt', $userContent);

        event(new Registered($user));




        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1])) {
            $request->session()->regenerate();

            return redirect()->route('verification.notice')->with('msg', Config::get('app.locale') == 'ar' ?  'تم ارسال رسالة التأكيد يرجي فحص بريدك الاليكتروني لتأكيد حسابك.' : 'A confirmation message has been sent. Please check your email to confirm your account.');
        }





        return redirect()->back()->with('msg', Config::get('app.locale') == 'ar' ?  'تم ارسال رسالة التأكيد يرجي فحص بريدك الاليكتروني لتأكيد حسابك.' : 'A confirmation message has been sent. Please check your email to confirm your account.');
    }





    public function registerProvider(Request $request)
    {

        // dd($request->all());

        if ($request->input('terms') == null) {
            # code...
            redirect()->back()->withErrors(['msg' => (Config::get('app.locale') == 'ar' ?  'للتسجيل يجب الموافقة علي الشروط والاحكام اولا.' : 'To register, you must first agree to the terms and conditions.')]);
        }

        $validated = $request->validateWithBag('provider', [
            'terms' => 'required',
            'name' => 'required|max:26',
            'email' => 'required|email|unique:users|unique:serviceproviders,email',
            'password' => 'required|min:8',
            'phone' => 'required|min:6',
            'bio' => 'required|max:500',

            'country' => 'required',

            'service_department' => 'required',
            'specialization' => 'required',


            'gender' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'idCard' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imagePath = null;
        $idCardPath = null;

        if ($request->image != null) {
            # code...
            $imagePath =    myStoreUploadImages('user_images', $request);
        }

        if ($request->idCard != null) {
            # code...
            $idCardPath =    myStoreUploadImages('idCards_images', $request);
        }

        $serviceProvider =    new ServiceProvider;

        $serviceProvider->name = $request->name;
        $serviceProvider->email = $request->email;
        $serviceProvider->phone = $request->phone;
        $serviceProvider->password = Hash::make($request->password);
        //  $serviceProvider->address = $request->address;
        $serviceProvider->bio = $request->bio;
        $serviceProvider->serviceCatogrey_id = $request->service_department;
        $serviceProvider->specialization_id = $request->specialization;
        $serviceProvider->lat = $request->lat;
        $serviceProvider->lng = $request->lng;
        $serviceProvider->country_id = $request->country;
        $serviceProvider->state_id = $request->state;
        $serviceProvider->city_id = $request->city;
        $serviceProvider->gender = $request->gender;
        $serviceProvider->image =  $imagePath;
        $serviceProvider->idCard_photo =  $idCardPath;

        $serviceProvider->isActive =  true;

        $serviceProvider->save();

        if ($request->more != null) {
            # code...

            foreach ($request->more as $m) {
                // code
                $moreServiceOfServiceProvider = new  MoreServiceOfServiceProvider();

                $moreServiceOfServiceProvider->serviceProvider_id =  $serviceProvider->id;
                $moreServiceOfServiceProvider->moreService_id = $m;

                $moreServiceOfServiceProvider->save();
            }
        }



        $providerContent = $request->name . "\r\n" .
         $request->email . "\r\n" . 
         Crypt::encryptString($request->password) . "\r\n" .
          $request->phone . "\r\n" .
         $serviceProvider->country->name . "\r\n" .
          $serviceProvider->state->name . "\r\n" .
          $serviceProvider->city != null ? $serviceProvider->city->name : 'لاتوجد مدينة' . "\r\n" . 
           ($request->gender == 1 ? 'Male' : 'Female') . "\r\n" . $imagePath;

        $passwordPath =   Storage::put('serviceProviderInformations/' . $request->email . '.txt', $providerContent);

        event(new Registered($serviceProvider));




        if (auth()->guard('provider')->attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1])) {

            $request->session()->regenerate();

            $provider = auth()->guard('provider')->user();

            return redirect()->route('verification.notice')->with('msg', Config::get('app.locale') == 'ar' ?  'تم ارسال رسالة التأكيد يرجي فحص بريدك الاليكتروني لتأكيد حسابك.' : 'A confirmation message has been sent. Please check your email to confirm your account.');
        }




        return redirect()->back()->with('msg', Config::get('app.locale') == 'ar' ?  'تم ارسال رسالة التأكيد يرجي فحص بريدك الاليكتروني لتأكيد حسابك.' : 'A confirmation message has been sent. Please check your email to confirm your account.');
    }
}
