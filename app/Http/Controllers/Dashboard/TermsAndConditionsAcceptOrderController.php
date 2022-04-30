<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcceptOrderCondition;

class TermsAndConditionsAcceptOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acceptOrderConditions = AcceptOrderCondition::all();

        return view('Dashboard.screens.termsAndConditions.termsAndConditionsAcceptOrder',
        ['acceptOrderConditions' => $acceptOrderConditions,]);

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
        $validated = $request->validate([
            'desc_ar' => 'required',
            'desc_en' => 'required',
        ]);

        $acceptOrderCondition =    new AcceptOrderCondition;
        $acceptOrderCondition->describe_ar = $request->desc_ar;
        $acceptOrderCondition->describe_en = $request->desc_en;

        $acceptOrderCondition->save();

        return redirect()->route('termsAndConditionsAcceptOrder.index');

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
    public function destroy(Request $request,$id)
    {
        //
        if ($request->ajax()) {

            $acceptOrderCondition = AcceptOrderCondition::findOrFail($id);
            $acceptOrderCondition->delete();

            return myAjaxResponse($acceptOrderCondition, 'تم التحديث بنجاح', 200);
        }
    }
}
