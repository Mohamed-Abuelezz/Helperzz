<?php

namespace App\Http\Controllers\Website\provider;

use App\Http\Controllers\Controller;
use App\Models\AcceptOrderCondition;
use App\Models\Order;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceProviderView;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\ChangeOrderStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DashboardMail;
use Illuminate\Support\Facades\Config;


class ProviderController extends Controller
{
    //
    public function index(Request $request)
    {


        $serviceProviderViews = ServiceProviderView::where('serviceProvider_id', Auth::guard('provider')->id())
            ->where('created_at', '>=', Carbon::today()->subDays(6))->orderBy('created_at', 'Asc')
            ->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->dayName;
            });

        $reservations = Order::where('serviceProvider_id', Auth::guard('provider')->id())->whereIn('ordersStatus_id', [3, 4, 5])->with(['user.country','user.state','user.city'])->orderBy('created_at', 'Desc')->paginate(12);

        $acceptOrderConditions =     AcceptOrderCondition::all();




        //dd( $serviceProviderViews);
        return view('Website.service provider.home', [
            'serviceProviderViews' => $serviceProviderViews,
            'reservations' => $reservations,
            'acceptOrderConditions' => $acceptOrderConditions,
        ]);
    }


    
    public function acceptOrder(Request $request,$id)
    {
        $reservation = Order::where('id', $id)->with(['user','provider','orderStatus'])->first();

        // if ( $reservation->provider->wallet != null &&  $reservation->provider->wallet >= 5 ) {
            # code...
            ServiceProvider::where('id', $reservation->provider->id)->update(['wallet'=> ($reservation->provider->wallet - 5)]);
               Order::where('id', $id)->update(['ordersStatus_id'=>4]);
               $reservation =     $reservation->fresh($with = ['user.country','user.city','provider','orderStatus']);


               ChangeOrderStatus::dispatch( $reservation);
               Mail::to($reservation->user->email)->send(new DashboardMail(Config::get('app.locale') == 'ar' ? ('قام مقدم الخدمة '.$reservation->provider->name.' بالموافقة علي الحجز الخاص بك') : ('The service provider '.$reservation->provider->name.'  has approved your reservation'),route('myreservations')));



            return myAjaxResponse( $reservation);
        // }else{

        //     return   myAjaxResponse(0) ;

        // }







    }



    public function refusedOrder(Request $request,$id){

        Order::where('id', $id)->update(['ordersStatus_id'=>5]);
        $reservation = Order::where('id', $id)->with(['user','provider','orderStatus'])->first();
        ChangeOrderStatus::dispatch( $reservation);
        Mail::to($reservation->user->email)->send(new DashboardMail(Config::get('app.locale') == 'ar' ? ('قام مقدم الخدمة '.$reservation->provider->name.' برفض  الحجز الخاص بك') : ('The service provider '.$reservation->provider->name.'  has rejected your reservation'),route('myreservations')));

        return myAjaxResponse( $reservation);

}
}
