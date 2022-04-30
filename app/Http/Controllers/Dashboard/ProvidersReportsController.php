<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportProfile;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use  Illuminate\Support\Facades\Config;

 
use App\Mail\DashboardMail;

class ProvidersReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reportsProfile = ReportProfile::where('isActive',1)->get();
        //
        return view('Dashboard.screens.reports.providersReports', ['reportsProfile' => $reportsProfile]);

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
        $reportProfile = ReportProfile::findOrFail($id);

        if ($request->ajax()) {

            if ($request->input('status') == 1) {
                # code...
                $msgUser= Config::get('app.locale') == 'ar' ? 'لقد تم فحص رسالتك بنجاح وتم ايقاف الحساب المبلغ '.$reportProfile->serviceProvider->name.' عنه لانتهاكه سياسة الاستخدام .. شكرا لك ❤️ ' : 'Your message has been successfully checked and the reported account has been suspended '.$reportProfile->serviceProvider->name.' for violating the usage policy.. Thank you ❤️' ;
                $msgprovider= Config::get('app.locale') == 'ar' ? 'لقد تم ايقاف ايقاف حسابك لانتهاكه سياسة الشروط والاستخدام اذا شعرت بانه يوجد خطأ يرجي التواصل معنا' : 'Your account has been suspended for violating the terms and use policy. If you feel there is an error, please contact us' ;
                


                $serviceProvider = ServiceProvider::findOrFail($reportProfile->serviceProvider->id);
                $serviceProvider->isActive = 0;
                $serviceProvider->save();


            Mail::to($reportProfile->user->email)->send(new DashboardMail( $msgUser,null));
            Mail::to($reportProfile->serviceProvider->email)->send(new DashboardMail( $msgprovider,null));
                

            } else  {
                # code...
                $msgUser= Config::get('app.locale') == 'ar' ? 'لقد تم فحص رسالتك المبلغ عنها لمقدم الخدمة '.$reportProfile->serviceProvider->name.'  ولم يتم ايجاد اي خروقات لسياسات الاستخدام ... شكرا لتفهمك ❤️ ': 'Your message reported to the service provider has been checked '.$reportProfile->serviceProvider->name.' no violations of usage policies have been found... Thank you for your understanding ❤️' ;
                Mail::to($reportProfile->user->email)->send(new DashboardMail( $msgUser,null));

            }
            


            $reportProfile->isActive = 0 ;

            $reportProfile->save();


     //       $reportProfile->delete();


            return myAjaxResponse($reportProfile, 'تم التحديث بنجاح', 200);
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
