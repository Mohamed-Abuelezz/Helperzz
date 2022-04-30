<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteConfig;

class WebsiteConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $websiteConfig = WebsiteConfig::where('isActive',1)->get();

        return view('Dashboard.screens.website_config.website_config',
        ['websiteConfig' => $websiteConfig,]);

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
            'name' => 'required',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);


        $websiteConfigs = WebsiteConfig::where('isActive',1)->update(['isActive' => 0]);



      //  dd($request->all());
        $imagePath =    myStoreUploadImages('website_logos', $request);

        $websiteConfig =    new WebsiteConfig;
        $websiteConfig->logo = $imagePath ;
        $websiteConfig->website_name = $request->name;
        $websiteConfig->meta_descAr = $request->desc_ar;
        $websiteConfig->meta_descEn = $request->desc_en;
        $websiteConfig->isActive = 1;

        $websiteConfig->save();

        return redirect()->route('websiteConfig.index');

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
