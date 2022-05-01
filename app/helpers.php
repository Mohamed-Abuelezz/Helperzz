<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function myAjaxResponse($data,$message = 'تم بنجاح',$status = 200){

    return response()->json([
        'data' => $data,
        'message' => $message,
        'status' => $status,
    ],$status);    
}
   


  
function myStoreUploadImages($path,$request){
    $pathSave = null;

    if (Storage::disk('public')->exists($path) == false) {
        # code...
     Storage::makeDirectory('public/'.$path);
    }

    $randomFileName = $path.'/'.Str::random(40).'.'.$request->file('image')->extension();

    $pathSave =     storage_path('app/public/'.$randomFileName);


   $image =    Image::make($request->file('image'))->resize(250, 250, function ($constraint) {
        $constraint->aspectRatio(); //to preserve the aspect ratio
        $constraint->upsize();
     })->save($pathSave);
     
     
    return $randomFileName;
}

function myDeleteUploadedImage($path){

Storage::disk('public')->delete($path);

}

function getMyLocationDetails(){
// $_SERVER['REMOTE_ADDR']

    $json = file_get_contents("http://ipinfo.io/102.43.228.52");
    $details = json_decode($json);

    return  $details;
    }



