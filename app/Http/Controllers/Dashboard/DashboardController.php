<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\WebsiteViews;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::select("*")
        ->whereNotNull('last_seen')->get();

        $serviceProviders = ServiceProvider::select("*")
        ->whereNotNull('last_seen')->get();

        $onlineUsers = 0;


    foreach ($users as $user) {

        if(Cache::has('user-is-online-' . $user->id)){

            $onlineUsers =  $onlineUsers +1 ;

        }

    }

    foreach ($serviceProviders as $serviceProvider) {

        if(Cache::has('user-is-online-' . $serviceProvider->id)){

            $onlineUsers =  $onlineUsers +1 ;

        }

    }


    $websiteViews=  WebsiteViews::where('created_at','>', Carbon::now()->subDays(7))->get()->groupBy(function($item) {
        return $item->created_at->format('Y-m-d');
   });
    


   // dd($websiteViews);
        return view('Dashboard.index',[
            'onlineUsers' => $onlineUsers,
            'websiteViews' => $websiteViews,        
        ]);

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
