<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrderCondition;

class TermsAndConditionsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ordersCondition = OrderCondition::all();

        return view('Dashboard.screens.termsAndConditions.termsAndConditionsOrder',
        ['ordersCondition' => $ordersCondition,]);

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

        $orderCondition =    new OrderCondition;
        $orderCondition->describe_ar = $request->desc_ar;
        $orderCondition->describe_en = $request->desc_en;

        $orderCondition->save();

        return redirect()->route('termsAndConditionsOrder.index');

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

            $orderCondition = OrderCondition::findOrFail($id);
            $orderCondition->delete();

            return myAjaxResponse($orderCondition, 'تم التحديث بنجاح', 200);
        }
    }
}
