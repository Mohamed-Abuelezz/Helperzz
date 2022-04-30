<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>لوحة التحكم</title>
<meta name="author" content="{{\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name}}">
<meta name="keywords" content="HTML, CSS, javaScript">
<meta name="description" content="{{ Config::get('app.locale') == 'en' ?  \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->meta_descEn   : \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->meta_descAr}}"> 
<meta name="_token" content="{{ csrf_token() }}" />

{{-- <meta name="referrer" content="unsafe-url">
<!--<meta name="googlebot" content="index,follow">-->
<!--<meta name="google-site-verification" content="verification_token"> --}}-->
<!--<link rel="icon" href="{{asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" sizes="16x16" type="image/png">-->
<!--<link rel="icon" href="{{asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" sizes="32x32" type="image/png">-->
<!--<link rel="icon" href="{{asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" sizes="48x48" type="image/png">-->
<!--<link rel="icon" href="{{asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" sizes="62x62" type="image/png">-->
<!--<link rel="icon" href="{{asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" sizes="192x192" type="image/png">-->
