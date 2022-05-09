<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Verified;

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\EditAccountController;
use App\Http\Controllers\Website\FavouritesController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\MyReservationsController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\provider\ProviderController;
use App\Http\Controllers\Website\provider\AccountController;
use App\Http\Controllers\Website\provider\WalletController;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\ServiceCatogrey;
use App\Models\Favourite;
use App\Models\MoreService;
use App\Models\Specialization;
use App\Models\TermsAndCondition;
use App\Models\WebsiteViews;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Artisan::call('storage:link');

Route::get('/test', function () {
  //test
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  Artisan::call('view:clear');

 // Artisan::call('storage:link');
 Artisan::call('storage:link');
$contents = File::get(storage_path('app/emailsMarketing/emails.txt'));
$array = explode(',', $contents);

dd($array);

    
    return 'ok';
});


Route::get('setlocale/{locale}', function ($locale) {
  // if ( !empty($raw_locale) && in_array($locale, Config::get('app.locales'))) {
  session(['locale' => $locale]);
  // }
  return redirect()->back();
});





Route::get('/authentication', [AuthController::class, 'index'])->name('auth');
Route::post('/authenticationLogin', [AuthController::class, 'login'])->name('auth.login');
Route::get('/authenticationLogout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/authentication', [AuthController::class, 'register'])->name('auth.store');

Route::get('/email/verify', function (Request $request) {


  if ($request->ajax() || $request->wantsJson()) {

    return myAjaxResponse(null, 'Unauthorized', 401);
  } else {

    return view('Website.verify-email');
  }


})->middleware('ensureIsAuthUserOrProvider')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
 //dd(Auth::guard('provider')->check());
  if (Auth::guard('provider')->check()) {
    # code...
    if (! Auth::guard('provider')->user()->hasVerifiedEmail()) {
      Auth::guard('provider')->user()->markEmailAsVerified();

      event(new Verified(Auth::guard('provider')->user()));
  }

  return redirect()->route('provider.index');

  } else {
    $request->fulfill();

    return redirect('/');
  }
})->middleware(['ensureIsAuthUserOrProvider', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
  if (Auth::guard('provider')->check()) {
    Auth::guard('provider')->user()->sendEmailVerificationNotification();

  }else {
    # code...
    $request->user()->sendEmailVerificationNotification();

  }

  return back()->with('msg', Config::get('app.locale') == 'ar' ? 'تم إرسال رابط التحقق!' : 'Verification link sent!');
})->middleware(['ensureIsAuthUserOrProvider', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', function () {
  return view('Website.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
  $request->validate(['email' => 'required|email']);

  $status = Password::sendResetLink(
    $request->only('email')
  );

  if ($status == Password::INVALID_USER) {
    # code...

    $status = Password::broker('providers')->sendResetLink(
      $request->only('email')
    );
    
  
  }

  return $status === Password::RESET_LINK_SENT
    ? back()->with(['msg' => Config::get('app.locale') == 'ar' ? 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني بنجاح .' : 'The password reset link has been sent to your email successfully .'])
    : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
  return view('Website.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {

  // return $request->all();
  $request->validate([
    'token' => 'required',
    'email' => 'required|email',
    'password' => 'required|min:8|confirmed',
    'password_confirmation' => 'required|min:8|same:password',

  ]);

  $status = Password::reset(
    $request->only('email', 'password', 'password_confirmation', 'token'),
    function ($user, $password) {
      $user->forceFill([
        'password' => Hash::make($password)
      ])->setRememberToken(Str::random(60));

      $user->save();

      event(new PasswordReset($user));
    }
  );

  if ($status == Password::INVALID_USER) {
    # code...
    $status = Password::broker('providers')->reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));
  
        $user->save();
  
        event(new PasswordReset($user));
      }
    );
  
  }

  return $status === Password::PASSWORD_RESET
    ? redirect()->route('auth')->with('msg', Config::get('app.locale') == 'ar' ? 'تم اعادة تعيين كلمة المرور بنجاح .' : 'Password has been reset successfully.')
    : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::group(['middleware' => ['auth','verified']], function () {

  Route::get('/account', [EditAccountController::class, 'index'])->name('account');
  Route::post('/account', [EditAccountController::class, 'edit'])->name('account.edit');


  Route::get('/myreservations', [MyReservationsController::class, 'index'])->name('myreservations');
  Route::post('/{id}/api/reservations/remove', [MyReservationsController::class, 'remove'])->name('myreservations.remove');

  Route::get('/favourites', [FavouritesController::class, 'index'])->name('favourites');
  Route::post('/{id}/api/favourites/remove', [FavouritesController::class, 'remove'])->name('favourites.remove');
});


Route::group(['middleware' => ['providerauth','verifiedProvider']], function () {

  Route::get('/provider', [ProviderController::class, 'index'])->name('provider.index');
  Route::post('/{id}/api/provider/acceptOrder', [ProviderController::class, 'acceptOrder'])->name('provider.acceptOrder');
  Route::post('/{id}/api/provider/refusedOrder', [ProviderController::class, 'refusedOrder'])->name('provider.refusedOrder');

  Route::get('/provider/account', [AccountController ::class, 'index'])->name('provider.account');
  Route::post('/provider/account', [AccountController ::class, 'edit'])->name('provider.account.edit');


  Route::get('/provider/wallet', [WalletController ::class, 'index'])->name('provider.wallet');
  Route::post('/provider/wallet/charge', [WalletController ::class, 'charge'])->name('provider.charge');
  Route::get('/provider/wallet/chargeStatus', [WalletController ::class, 'chargeStatus'])->name('provider.chargeStatus');



});


// global Screens

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/advancedSearch', [HomeController::class, 'advancedSearch']);
Route::get('/api/moreProveiders', [HomeController::class, 'moreProveiders']);
Route::get('/api/orderProveiders', [HomeController::class, 'orderByProveiders']);
Route::get('/api/searchProveiders', [HomeController::class, 'searchProveiders']);

Route::get('/{id}/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/{id}/api/profile/report', [ProfileController::class, 'report'])->middleware('verified');
Route::post('/{id}/api/profile/reportComment', [ProfileController::class, 'reportComment'])->middleware(['providerauth','verifiedProvider']);
Route::post('/{id}/api/profile/rate', [ProfileController::class, 'rate'])->middleware('verified');
Route::post('/{id}/api/profile/comment', [ProfileController::class, 'comment'])->middleware('verified');
Route::post('/{id}/api/profile/reservation', [ProfileController::class, 'reservation'])->middleware('verified');




Route::get('/index', function () {
          
  $websiteViews =     WebsiteViews::where('mac', $_SERVER['REMOTE_ADDR'])->whereDate('created_at', Carbon::today())->get();
  //dd($websiteViews);
          if ($websiteViews->isEmpty()) {
              # code...
           //   dd(empty($ServiceProviderView));
  
              $websiteViews = new WebsiteViews;
              $websiteViews->mac =  $_SERVER['REMOTE_ADDR'];
              $websiteViews->save();
  
  
        //      return redirect()->route('index', []);
          }

  return view('Website.index');
  
})->name('index');

Route::get('/termsAndConditions', function () {

  $terms = TermsAndCondition::all();
  return view('Website.termsAndConditions', ['terms' => $terms]);
})->name('terms');

Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contactUs');
Route::post('/contactUs', [ContactUsController::class, 'send'])->name('contactUs.send');













///////////////////////////////////////////////////////////////// HELPER Apis Reqs
Route::get('/{country_id}/api/states', function ($country_id) {



  $states = State::where('country_id', $country_id)->get();


  return myAjaxResponse($states);
});
Route::get('/{state_id}/api/cities', function ($state_id) {

  $cities = [];
  if ($state_id == 'all') {

    $json = file_get_contents("http://ipinfo.io/156.217.203.127");
    $details = json_decode($json);

    $countryCode = $details->country;

    $states =   Country::where('code', $countryCode)->first()->states;

    foreach ($states as $state) {
      foreach ($state->cities as $city) {

        array_push($cities, $city);
      }
    }
  } else {
    # code...
    $cities = City::where('state_id', $state_id)->get();
  }



  return myAjaxResponse($cities);
});

Route::get('/{serviceCatogrey_id}/api/specializations', function ($serviceCatogrey_id) {

  if ($serviceCatogrey_id == 'all') {
    # code...
    $specializations = Specialization::where('isActive', true)->get();
  } else {
    # code...
    $specializations = Specialization::where('serviceCatogrey_id', $serviceCatogrey_id)->where('isActive', true)->get();
  }



  return myAjaxResponse($specializations);
});

Route::get('/{specialization_id}/api/moreServices', function ($specialization_id) {
  $moreServices = null;

  if ($specialization_id == 'all') {
    # code...
    $moreServices = [];
  } else {
    # code...
    $moreServices = MoreService::where('specialization_id', $specialization_id)->where('isActive', true)->get();
  }


  return myAjaxResponse($moreServices);
});


Route::post('/{userProvider_id}/api/userFav', function ($userProvider_id) {

  $serviceProvider = ServiceProvider::findOrFail($userProvider_id);

  if (Favourite::where('user_id', Auth::id())->where('serviceProvider_id', $userProvider_id)->exists()) {
    // your code...
    Favourite::where('user_id', Auth::id())->where('serviceProvider_id', $userProvider_id)->delete();
    return myAjaxResponse(0);
  } else {
    $favourite = new Favourite;

    $favourite->user_id = Auth::id();
    $favourite->serviceProvider_id = $userProvider_id;
    $favourite->save();

    return myAjaxResponse(1);
  }


  return myAjaxResponse(null);
})->name('userFav')->middleware('verified');
