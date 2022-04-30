<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceCatogrey;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceCatogries = ServiceCatogrey::all();
        //
        return view('Dashboard.screens.services.serviceCategory', ['serviceCatogries' => $serviceCatogries]);

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
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imagePath =    myStoreUploadImages('serviceCatogrey_images', $request);

        $serviceProvider =    new ServiceCatogrey;
        $serviceProvider->name_ar = $request->name_ar;
        $serviceProvider->name_en = $request->name_en;
        $serviceProvider->image =  $imagePath;
        $serviceProvider->isActive = 1;

        $serviceProvider->save();

        return redirect()->route('servicesCategories.index');

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

            $serviceCatogrey = ServiceCatogrey::findOrFail($id);
            $serviceCatogrey->isActive = (int)$request->input('isActive');
            $serviceCatogrey->save();

            return myAjaxResponse($serviceCatogrey, 'تم التحديث بنجاح', 200);
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

            $serviceCatogrey = ServiceCatogrey::findOrFail($id);
            
            myDeleteUploadedImage($serviceCatogrey->image);


            $serviceCatogrey->delete();

            return myAjaxResponse($serviceCatogrey, 'تم بنجاح', 200);
        }

    }
}
