<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class EditAccountController extends Controller
{
    //

    public function index(Request $request){



        return view('Website.users.editAccount', []);
    }


    public function edit(Request $request){


        $validated = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required|max:26',
            'email' => 'required|email|unique:users,email,'. Auth::user()->id.'|unique:serviceproviders,email,'. Auth::user()->id,
            'phone' => 'required|min:6',
        
        ]);

        $imagePath = null;

        if ($request->image != null) {
            # code...
            $imagePath =    myStoreUploadImages('user_images', $request);
    
        }
    

        $user =    User::where('id', Auth::id())->update([
            'name' =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'image' => $imagePath,
            
        ]);
      
        Storage::move('userInformations/'.Auth::user()->email.'.txt', 'userInformations/'.$request->email.'.txt'); // keep the same folder to just rename 

        return redirect()->back()->with('msg', Config::get('app.locale') == 'ar' ?  ' تم الارسال بنجاح.' : 'Sent Succesfully.');


    }

}
