<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;


class TermsAndConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $termsAndCondition = TermsAndCondition::all();

        return view('Dashboard.screens.termsAndConditions.termsAndConditions',
        ['termsAndCondition' => $termsAndCondition,]);

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

        $termsAndCondition =    new TermsAndCondition;
        $termsAndCondition->describe_ar = $request->desc_ar;
        $termsAndCondition->describe_en = $request->desc_en;

        $termsAndCondition->save();

        return redirect()->route('termsAndConditions.index');

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
    public function edit(Request $request,$id)
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

            $termsAndCondition = TermsAndCondition::findOrFail($id);
            $termsAndCondition->delete();

            return myAjaxResponse($termsAndCondition, 'تم التحديث بنجاح', 200);
        }

    }
}
