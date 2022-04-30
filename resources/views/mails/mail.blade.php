<div style="padding: 20px;background-color:#009DAE;color:aliceblue;text-align:center;font-size:20px">

    {{\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name;}}


</div>


<div style="min-height:500px;text-align:center;font-size:20px">

    <br>
    {{Config::get('app.locale') == 'ar' ? 'تنويه' : 'Note'}}
    <br>
    <br>
<p style="font-size:15px;width:90%;margin:auto "> {{$msg}} </p>
<br>

<a href="{{$url == null ?  Request::root() : $url}}" style="padding: 10px 20px;color: white;margin:auto;background-color:#009DAE;text-decoration:none">{{Config::get('app.locale') == 'ar' ? 'الذهاب' :  'Continue' }}</a>


</div>

<div style="padding: 20px;background-color:#009DAE;color:aliceblue;text-align:center;font-size:20px">

    {{Config::get('app.locale') == 'ar' ? 'جميع الحقوق محفوظة '. \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name   . '2022' : 'All rights reserved '. \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name    .' 2022' }}

</div>