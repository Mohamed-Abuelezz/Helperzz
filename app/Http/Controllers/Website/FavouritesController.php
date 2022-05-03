<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class FavouritesController extends Controller
{
    //
    public function index(Request $request)
    {

        $favourites = Favourite::where('user_id', Auth::id())->paginate(12);

        return view('Website.users.favourites', [
            'favourites' => $favourites
        ]);
    }

    public function remove(Request $request,$id)
    {
    
        $favourite=Favourite::where('id',$id)->delete();
    
    
    return myAjaxResponse($favourite);
    
    }
}
