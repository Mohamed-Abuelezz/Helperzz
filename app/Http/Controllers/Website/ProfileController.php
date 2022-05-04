<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use App\Events\ChangeOrderStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DashboardMail;

use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderCondition;
use App\Models\Rate;
use App\Models\ServiceProvider;
use App\Models\ReportProfile;
use App\Models\ServiceProviderView;
use App\Events\NewOrderSocket;
use App\Models\ReportComment;

class ProfileController extends Controller
{
    //
    public function index(Request $request, $id)
    {


      //  dd($_SERVER['REMOTE_ADDR']);

        $ServiceProviderView =     ServiceProviderView::where('serviceProvider_id', $id)->where('mac', $_SERVER['REMOTE_ADDR'])->whereDate('created_at', Carbon::today())->get();
        $serviceProvider = ServiceProvider::findOrFail($id);

        if ($ServiceProviderView->isEmpty()) {
            # code...
         //   dd(empty($ServiceProviderView));

            $ServiceProviderView = new ServiceProviderView;
            $ServiceProviderView->mac =  $_SERVER['REMOTE_ADDR'];
            $ServiceProviderView->serviceProvider_id =  $id;
            $ServiceProviderView->save();
        }


        $orderConditions = OrderCondition::all();

        $userFavourites = [];

        if (Auth::check()) {
            # code...
            $userFavourites = Favourite::select('serviceProvider_id')->where('user_id', Auth::user()->id)->get();
        }
        return view('Website.users.profile', [
            'serviceProvider' =>  $serviceProvider,
            'userFavourites' => $userFavourites,
            'orderConditions' => $orderConditions,

        ]);
    }

    public function report(Request $request, $id)
    {


        $reportProfile =     ReportProfile::where('user_id', Auth::id())
            ->where('serviceProvider_id', $request->provider_id)
            ->where('isActive', true)->first();



        if ($reportProfile == null) {
            # code...
            $validated = $request->validate([
                'desc' => 'required|max:500',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ]);

            $imagePath = null;

            if ($request->image != null) {
                # code...
                $imagePath =    myStoreUploadImages('reports_images', $request);
            }
            $reportProfile =    new ReportProfile;

            $reportProfile->photo = $imagePath;
            $reportProfile->reason = $request->desc;
            $reportProfile->user_id = Auth::id();
            $reportProfile->serviceProvider_id = $request->provider_id;
            $reportProfile->isActive = true;


            $reportProfile->save();
            return  myAjaxResponse($reportProfile,Config::get('app.locale') == 'ar' ? 'تم الارسال بنجاح.' : 'Sent Succesfully.');
        } else {
            # code...
            return  myAjaxResponse($reportProfile,Config::get('app.locale') == 'ar' ? 'لقد تم ارسال بلاغ من قبل.' : 'A report has already been sent.');
        }





        // return  myAjaxResponse(Config::get('app.locale') == 'ar' ? 'تم الارسال بنجاح' :'Sent Succesfully');

    }
    
    public function reportComment(Request $request, $id){



   //     return $request->all();

        $reportComment =     ReportComment::where('serviceProvider_id',  Auth::guard('provider')->user()->id)
        ->where('comment_id', $id)
            ->where('isActive', true)->first();



        if ($reportComment == null) {
            # code...
            $validated = $request->validate([
                'desc' => 'required|max:500',

            ]);


            $reportComment =    new ReportComment;

            $reportComment->serviceProvider_id = $request->provider_id;
            $reportComment->comment_id = $id;
            $reportComment->reason = $request->desc;

            $reportComment->isActive = true;


            $reportComment->save();
            return  myAjaxResponse($reportComment,Config::get('app.locale') == 'ar' ? 'تم الارسال بنجاح.' : 'Sent Succesfully.');
        } else {
            # code...
            return  myAjaxResponse($reportComment,Config::get('app.locale') == 'ar' ? 'لقد تم ارسال بلاغ من قبل.' : 'A report has already been sent.');
        }





}
    public function rate(Request $request, $id)
    {

        $rate = Rate::where('user_id', Auth::id())->where('serviceProvider_id', $id)->first();



        if ($rate == null) {
            # code...
            $rate = new Rate;
            $rate->user_id = Auth::id();
            $rate->serviceProvider_id = $id;
            $rate->rate = $request->input('rate');
            $rate->save();
        } else {
            $rate = Rate::where('user_id', Auth::id())->where('serviceProvider_id', $id)->update(['rate' => $request->input('rate')]);
        }


        return myAjaxResponse($rate, (Config::get('app.locale') == 'ar' ? 'تم التقييم بنجاح' : 'Rated Successfully '));
    }


    public function comment(Request $request, $id)
    {
        $comment = new Comment();

        $comment->user_id = Auth::id();
        $comment->serviceProvider_id = $id;
        $comment->comment = $request->input('comment');
        $comment->save();


        $comment =  Comment::where('id',$comment->id)->with(['user'])->first();

        $comment->carbon= Carbon::parse($comment->created_at)->diffForHumans();

        return myAjaxResponse($comment);
}




public function reservation(Request $request, $id){

    $order = Order::where('user_id', Auth::id())
    ->where('serviceProvider_id', $id)
    ->whereIn('ordersStatus_id',[1,3])
    ->whereDate("created_at", '>=',Carbon::now()->subDays(1))
    ->get();

  //  return $order;
    if ($order->isEmpty()) {
        # code...
        $order = new Order;
        $order->user_id = Auth::id();
        $order->serviceProvider_id = $id;
        $order->ordersStatus_id = 1;
        $order->describe = $request->input('desc');
        $order->save();

        $order =     $order->fresh($with = ['user.country','user.city','user.state','provider.country','provider.city','provider.state','orderStatus']);

        Mail::to($order->provider->email)->queue(new DashboardMail(Config::get('app.locale') == 'ar' ? ('لقد تم ارسال لك حجز جديد يرجي مراجعته ❤️.') : ('A new reservation has been sent to you, please review it ❤️'),route('provider.index')));

        NewOrderSocket::dispatch( $order);
        return myAjaxResponse($order, (Config::get('app.locale') == 'ar' ? '.تم الارسال بنجاح' : 'Send Successfully. '));

    } else {

        return myAjaxResponse($order, (Config::get('app.locale') == 'ar' ? 'لقد تم ارسال حجز من قبل وجاري المراجعه يرجي الانتظار لمدة 24 ساعه علي الاقل لارسال حجز جديد..' : 'A reservation has already been sent and is being reviewed. Please wait for at least 24 hours to send a new reservation.'));

    }



}




}
