<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use  Illuminate\Support\Facades\Config;
use App\Mail\DashboardMail;

use App\Models\ContactUs;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = ContactUs::where(['isActive' => 1])->get();

        return view('Dashboard.screens.contactus.contactus',
        ['contacts' => $contacts,]);

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

                $msg= Config::get('app.locale') == 'ar' ? 'لقد تم مراجعة رسالتك وسوف يتم الرد عليك في اقرب فرصة' : 'Your message has been reviewed and we will reply to you as soon as possible.' ;
                


                $contactUs = ContactUs::findOrFail($id);
                $contactUs->isActive = 0;
                $contactUs->save();


            Mail::to($contactUs->email)->queue(new DashboardMail( $msg,null));
                


            return myAjaxResponse($contactUs, 'تم التحديث بنجاح', 200);
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
