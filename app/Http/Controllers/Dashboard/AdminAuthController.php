<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('Dashboard.screens.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {

        if (Admin::where('email','m.abuelezz97@gmail.com')->first() == null) {
            $admin =    new Admin;
            $admin->name = 'Mohamed';
            $admin->email = 'm.abuelezz97@gmail.com';
            $admin->isActive = 1;
            $admin->image = 'ssssss';
            $admin->password = Hash::make('adam1997ezz7991');
            $admin->save();
        } 

// if (Admin::where('email', $request->email)->first() == null) {
//     $admin =    new Admin;
//     $admin->name = 'name';
//     $admin->email = $request->email;
//     $admin->isActive = 1;
//     $admin->image = 'ssssss';
//     $admin->password = Hash::make($request->password);
//     $admin->save();
// } 

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'isActive' => true,]))
        {
            $user = auth()->guard('admin')->user();
            
            \Session::put('success','You are Login successfully!!');

            return redirect(route('Dashboard'));

        } else {
            return back()->with('error','your username Or password are wrong.');
        }

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        \Session::flush();
        \Session::put('success','You are logout successfully');        
        return redirect(route('adminLogin'));
    }
}
