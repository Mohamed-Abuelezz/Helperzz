<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\OrderShipmentStatusUpdated;
use App\Events\ChangeOrderStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DashboardMail;
use Illuminate\Support\Facades\Config;


use App\Models\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
                //
                $orders = Order::where(['ordersStatus_id' => 1])->get();

                return view('Dashboard.screens.orders.orders', ['orders' => $orders]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $order = Order::findOrFail($id);
            $order->ordersStatus_id = (int)$request->input('status');
            $order->save();
            if ( (int)$request->input('status') == 3) {
                # code...
                $order = $order->fresh($with = ['user','provider','orderStatus']); 
                ChangeOrderStatus::dispatch( $order);
                Mail::to($order->user->email)->queue(new DashboardMail(Config::get('app.locale') == 'ar' ? (' تم ارسال الحجز  لمقدم الخدمة '.$order->provider->name.' وبانتظار الرد')  :  ( 'The reservation has been sent to the service provider '.$order->provider->name.' And waiting for a reply'), config('app.url').'/'.'myreservations'));
                Mail::to($order->provider->email)->queue(new DashboardMail(Config::get('app.locale') == 'ar' ? (' قام '.$order->user->name.'  بارسال طلب جديد وينتظر ردك')  :  ( $order->user->name.'  sent a new request and is waiting for your reply '), config('app.url').'/'.'provider'));
    
            }else{
//dd(config('app.url'));
$order = $order->fresh($with = ['user','provider','orderStatus']); 

                ChangeOrderStatus::dispatch( $order);
                Mail::to($order->user->email)->queue(new DashboardMail(Config::get('app.locale') == 'ar' ? (' تم رفض ارسال الطلب لمقدم الخدمة '.$order->provider->name.' يرجي الالتزام بالشروط والاحكام اولا')  :  ( ' The request was refused to be sent to the service provider '.$order->provider->name.' Please adhere to the terms and conditions first '), config('app.url').'/'.'myreservations'));
    
            }


            return myAjaxResponse($order, 'تم التحديث بنجاح', 200);
        }else{


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
