<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReportComment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use  Illuminate\Support\Facades\Config;
use App\Mail\DashboardMail;

class ReportsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reportComments = ReportComment::where('isActive',1)->get();
        //
        return view('Dashboard.screens.reports.commentsReports', ['reportComments' => $reportComments]);

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
        $reportComment = ReportComment::findOrFail($id);

        if ($request->ajax()) {

            if ($request->input('status') == 1) {
                # code...
                $msgprovider= Config::get('app.locale') == 'ar' ? 'لقد تم فحص رسالتك بنجاح وتم ايقاف الحساب المبلغ '.$reportComment->comment->user->name.' عنه لانتهاكه سياسة الاستخدام .. شكرا لك ❤️ ' : 'Your message has been successfully checked and the reported account has been suspended '.$reportComment->comment->user->name.' for violating the usage policy.. Thank you ❤️' ;
                $msguser= Config::get('app.locale') == 'ar' ? 'لقد تم ايقاف ايقاف حسابك لانتهاكه سياسة الشروط والاستخدام اذا شعرت بانه يوجد خطأ يرجي التواصل معنا' : 'Your account has been suspended for violating the terms and use policy. If you feel there is an error, please contact us' ;
                


                $user = User::findOrFail($reportComment->comment->user->id);
                $user->isActive = 0;
                $user->save();


            Mail::to($reportComment->comment->user->email)->queue(new DashboardMail( $msguser,null));
            Mail::to($reportComment->serviceProvider->email)->queue(new DashboardMail( $msgprovider,null));
                

            } else  {
                # code...
                $msgprovider= Config::get('app.locale') == 'ar' ? 'لقد تم فحص رسالتك المبلغ عنها للمستخدم '.$reportComment->comment->user->name.'  ولم يتم ايجاد اي خروقات لسياسات الاستخدام ... شكرا لتفهمك ❤️ ': 'Your message reported to the user '.$reportComment->comment->user->name.'has been checked no violations of usage policies have been found... Thank you for your understanding ❤️' ;
                Mail::to($reportComment->serviceProvider->email)->queue(new DashboardMail( $msgprovider,null));

            }
            


            $reportComment->isActive = 0 ;

            $reportComment->save();


     //       $reportProfile->delete();


            return myAjaxResponse($reportComment, 'تم التحديث بنجاح', 200);
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
