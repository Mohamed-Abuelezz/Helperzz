<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        //
        return view('Dashboard.screens.users.users', ['users' => $users]);
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
        return view('Dashboard.screens.users.create', ['countries' => $countries]);
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
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|min:6',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $imagePath =    myStoreUploadImages('user_images', $request);


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
        $user->email_verified_at = now();






        $user->save();

        $userContent = $request->name . "\r\n" . $request->email . "\r\n" . Crypt::encryptString($request->password) . "\r\n" . $request->phone . "\r\n" . $user->country->name . "\r\n" . $user->state->name . "\r\n" . $user->city->name . "\r\n" . ($request->gender == 1 ? 'Male' : 'Female') . "\r\n" . $imagePath;

        $passwordPath =   Storage::put('userInformations/' . $request->email . '.txt', $userContent);


        return redirect()->route('users.index');
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

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        $user = User::findOrFail($id);

        //
        return view('Dashboard.screens.users.edit', ['user' => $user,'countries' => $countries,'states' => $states,'cities' => $cities]);

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
        if ($request->ajax()) {

            $user = User::findOrFail($id);
            $user->isActive = (int)$request->input('isActive');
            $user->save();

            return myAjaxResponse($user, 'تم التحديث بنجاح', 200);
        }else{

            $validated = $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email,'. $id,
                'password' => 'nullable|min:8',
                'phone' => 'required|min:6',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'gender' => 'required',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);





            $user =     User::find($id);
            $user->name = $request->name;
            
            Storage::move('userInformations/'.$user->email.'.txt', 'userInformations/'.$request->email.'.txt'); // keep the same folder to just rename 

            $user->email = $request->email;

            $user->phone = $request->phone;

            if ($request->password != null) {
                # code...
                $user->password = Hash::make($request->password);

            }


            $user->country_id = $request->country;
            $user->state_id = $request->state;
            $user->city_id = $request->city;
            $user->gender = $request->gender;
            if ($request->image != null) {
                # code...
                myDeleteUploadedImage($user->image);

                $imagePath =    myStoreUploadImages('user_images', $request);

                $user->image = $imagePath;

            }
    
            $user->save();

        }


        return redirect()->route('users.index');

    }










    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        if ($request->ajax()) {

            $user = User::findOrFail($id);

if ($user->image != null) {
    # code...
    myDeleteUploadedImage($user->image);

}
            $user->delete();

            return myAjaxResponse($user, 'تم بنجاح', 200);
        }
    }
}
