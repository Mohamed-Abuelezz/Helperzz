<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MoreService;
use App\Models\Specialization;

class MoreServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $moreServices = MoreService::all();
        $specializations = Specialization::all();

        //
        return view('Dashboard.screens.services.moreServices', ['moreServices' => $moreServices,'specializations' => $specializations]);

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

        $moreService =    new MoreService;
        $moreService->name_ar = $request->name_ar;
        $moreService->name_en = $request->name_en;
        $moreService->specialization_id = $request->category;
        $moreService->isActive = 1;

        $moreService->save();

        return redirect()->route('moreServices.index');

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

            $moreService = MoreService::findOrFail($id);
            $moreService->isActive = (int)$request->input('isActive');
            $moreService->save();

            return myAjaxResponse($moreService, 'تم التحديث بنجاح', 200);
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

            $moreService = MoreService::findOrFail($id);


            $moreService->delete();

            return myAjaxResponse($moreService, 'تم بنجاح', 200);
        }
    }
}
