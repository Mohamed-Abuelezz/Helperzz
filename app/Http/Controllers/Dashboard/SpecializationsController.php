<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Specialization;
use App\Models\ServiceCatogrey;

class SpecializationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      //  dd('ok');

        //
        $specializations = Specialization::all();
        $serviceCatogries = ServiceCatogrey::all();

        //
        return view('Dashboard.screens.services.specializations',
         ['specializations' => $specializations,
         'serviceCatogries' => $serviceCatogries
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
        $validated = $request->validate([
            'name_ar' => 'required|unique:servicescatogries|max:50',
            'name_en' => 'required|unique:servicescatogries|max:50',
        ]);

        $specialization =    new Specialization;
        $specialization->name_ar = $request->name_ar;
        $specialization->name_en = $request->name_en;
        $specialization->serviceCatogrey_id = $request->category;
        $specialization->isActive = 1;

        $specialization->save();

        return redirect()->route('specializations.index');

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

            $specialization = Specialization::findOrFail($id);
            $specialization->isActive = (int)$request->input('isActive');
            $specialization->save();

            return myAjaxResponse($specialization, 'تم التحديث بنجاح', 200);
        }

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

            $specialization = Specialization::findOrFail($id);


            $specialization->delete();

            return myAjaxResponse($specialization, 'تم بنجاح', 200);
        }

    }
}
