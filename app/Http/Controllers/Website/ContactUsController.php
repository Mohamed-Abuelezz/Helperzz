<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Models\ContactUs;


class ContactUsController extends Controller
{
    //

    public function index()
    {
        // $json = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']);
        // $details = json_decode($json);
            
     //   dd($details);

    //  $decrypted = Crypt::decryptString('eyJpdiI6IjRlbEVqZWwwc1ZKUUFFK29SRXRsclE9PSIsInZhbHVlIjoiZE1ZYlRTM3lNNWhTV1B5dGNYQkVJdz09IiwibWFjIjoiYjdlMTA3OTYxOTFjMzNlZTc3NmIwMzQ2MzlkNjY4OGFmZDdhNzljZmQ3OGIwMjY1NDc2YWZiZDYwNDU0YzBiZCIsInRhZyI6IiJ9');
    //  dd($decrypted);


        return view('Website.contactUs', []);

    }





    public function send(Request $request)
    {

    //  dd($request->all());

        $validated = $request->validate([
            'name' => 'required|max:26',
            'email' => 'required|email',
            'message' => 'required|max:500',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
if ( $request->image == null) {
    # code...
    $imagePath = null;

} else {
    # code...
    $imagePath =    myStoreUploadImages('contactUs_images', $request);

}



        
        $contactUs =    new ContactUs;
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->message = $request->message;
        $contactUs->file = $imagePath;
        $contactUs->isActive = true;


        $contactUs->save();


        return   redirect()->back()->with('msg',Config::get('app.locale') == 'ar' ?  ' تم الارسال بنجاح.' : 'Sent Succesfully.'); 

    }



}
