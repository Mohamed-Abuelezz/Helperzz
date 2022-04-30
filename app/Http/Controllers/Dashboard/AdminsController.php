<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::all();
        //
        return view('Dashboard.screens.admins.admins', ['admins' => $admins]);

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
            'name' => 'required|max:26',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $imagePath =    myStoreUploadImages('admin_images', $request);


        $admin =    new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->image =  $imagePath ;
        $admin->password = Hash::make($request->password);
        $admin->isActive = true;






        $admin->save();



        return redirect()->back();

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

            $admins = Admin::findOrFail($id);
            $admins->isActive = (int)$request->input('isActive');
            $admins->save();

            return myAjaxResponse($admins, 'تم التحديث بنجاح', 200);
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

            $admin = Admin::findOrFail($id);

            myDeleteUploadedImage($admin->image);

            $admin->delete();

            return myAjaxResponse($admin, 'تم بنجاح', 200);
        }
    }
}
