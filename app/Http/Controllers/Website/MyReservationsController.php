<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MyReservationsController extends Controller
{
    //

    public function index(Request $request)
    {

        $reservations = null;
        $sort =  Config::get('app.locale') == 'ar' ? 'الاحدث' : 'the recent';

        if ($request->has('sortby')) {
            # code...
            if ($request->input('sortby') == 'oldest') {
                # code...
                $reservations = Order::where('user_id', Auth::id())->orderBy('created_at', 'ASC')->paginate(12);
                $sort =   Config::get('app.locale') == 'ar' ? 'الاقدم' : 'the oldest';
            } else {
                # code...
                $reservations = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(12);
            }
        } else {
            # code...
            $reservations = Order::where('user_id', Auth::id())->paginate(12);
        }







        return view('Website.users.bookings', [
            'reservations' =>  $reservations,
            'sort' => $sort
        ]);
    }
    

    public function remove(Request $request,$id)
{

    $order=Order::where('id',$id)->delete();


return myAjaxResponse($order);

}

}
