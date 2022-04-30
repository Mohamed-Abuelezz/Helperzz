<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminAuthController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ProvidersController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ServiceCategoryController;
use App\Http\Controllers\Dashboard\SpecializationsController;
use App\Http\Controllers\Dashboard\MoreServicesController;
use App\Http\Controllers\Dashboard\ProvidersReportsController;
use App\Http\Controllers\Dashboard\ReportsCommentsController;
use App\Http\Controllers\Dashboard\TermsAndConditionsController;
use App\Http\Controllers\Dashboard\TermsAndConditionsOrderController;
use App\Http\Controllers\Dashboard\TermsAndConditionsAcceptOrderController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\WebsiteConfigController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\SendMailController;
use App\Http\Controllers\Dashboard\DecodeSecretsController;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use App\Models\Gender;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\ServiceProvider;
use App\Models\MoreService;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Events\NewOrderSocket;
use Illuminate\Support\Facades\Mail;

 
use App\Mail\DashboardMail;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
//Route::domain('admin.helperzz.com')->group(function () {


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('login',[AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('logout',[AdminAuthController::class, 'logout'])->name('adminLogout');



Route::get('/Test', function () {
    
    Mail::to('m.abuelezz97@gmail.com')->send(new DashboardMail('رسالتي اوك',route('provider.index')));
    return 'ok';

   });
Route::group(['middleware' => 'adminauth'], function () {








    Route::get('/', [DashboardController::class, 'index'])->name('Dashboard');
    
    Route::resource('admins', AdminsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('providers', ProvidersController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('servicesCategories', ServiceCategoryController::class);
    Route::resource('specializations', SpecializationsController::class);
    Route::resource('moreServices', MoreServicesController::class);
    Route::resource('reportsProfile', ProvidersReportsController::class);
    Route::resource('reportsComment', ReportsCommentsController::class);
    Route::resource('termsAndConditions', TermsAndConditionsController::class);
    Route::resource('termsAndConditionsOrder', TermsAndConditionsOrderController::class);
    Route::resource('termsAndConditionsAcceptOrder', TermsAndConditionsAcceptOrderController::class);
    Route::resource('websiteConfig', WebsiteConfigController::class);
    Route::resource('contactUs', ContactUsController::class);
    Route::resource('sendMail', SendMailController::class);
  //  Route::resource('deHash', DecodeSecretsController::class);
    
    
    
    Route::get('/users/{user_id}/userInfo', function ($user_id) {
    
        $user = User::where('id', $user_id)->first();
    
    
        return Storage::download('userInformations/'.$user->email.'.txt');
    })->name('userInfo');
    Route::get('/providers/{provider_id}/providerInfo', function ($provider_id) {
    
        $user = ServiceProvider::where('id', $provider_id)->first();
    
    
        return Storage::download('serviceProviderInformations/'.$user->email.'.txt');
    })->name('providerInfo');

    Route::get('/deHash', function () {
        return view('Dashboard.screens.decodeSecrets.decodeSecrets',  ['decrypted' => null]);
    })->name('deHash.index');
    
    Route::post('/deHash', function (Request $request) {
        $decrypted = null;
        try {
            $decrypted = Crypt::decryptString($request->hash);
        } catch (DecryptException $e) {
            //
        }
        
        
       
        return    view('Dashboard.screens.decodeSecrets.decodeSecrets', ['decrypted' => $decrypted]);;
    })->name('deHash.decode');



    
    // HELPER Api Reqs
    Route::get('/{country_id}/api/states', function ($country_id) {
    
        $states = State::where('country_id', $country_id)->get();
    
    
        return myAjaxResponse($states);
    })->name('statesApi');
    
    
    
    
    Route::get('/{state_id}/api/cities', function ($state_id) {
    
        $states = City::where('state_id', $state_id)->get();
    
    
        return myAjaxResponse($states);
    })->name('citiesApi');
    
    Route::get('/{serviceCatogrey_id}/api/specializations', function ($serviceCatogrey_id) {
    
        $specializations = Specialization::where('serviceCatogrey_id', $serviceCatogrey_id)->get();
    
    
        return myAjaxResponse($specializations);
    })->name('specializationsApi');
    
    
    
    Route::get('/{specialization_id}/api/moreServices', function ($specialization_id) {
    
        $specializations = MoreService::where('specialization_id', $specialization_id)->get();
    
    
        return myAjaxResponse($specializations);
    })->name('moreServicesApi');
    
    
    
    
    
    



});



//});
















