<!DOCTYPE html>

<html lang="{{ Config::get('app.locale') }}">
<!-- Required meta tags -->
@include('Website.globalElements.meta')
<title>
    {{ Config::get('app.locale') == 'en'? "Read" .\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name."'s Terms and Conditions.": 'سجل الان لاستخدام جميع الميزات في Helperzz.' }}
</title>
<meta name="description"
    content="{{ Config::get('app.locale') == 'ar'? "قراءة البنود والشروط والاحكام الخاصة بموقع  ". \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name ."  والتي تتبع سياسة الاستخدام للموقع والتي توفر الامان والمصداقية والشروط التي يجب ان تتبع": 
   " Read the terms, conditions and conditions of the ". \App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name ." website, which follow the website's use policy, which provides security, credibility, and the conditions that must be followed" }}">
<meta name="googlebot" content="index,follow">

<link rel="stylesheet"
    href=" {{ Config::get('app.locale') == 'ar'? asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.rtl.min.css'): asset('Website_Assets/packages/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">

<link rel="stylesheet" href=" {{ asset('Website_Assets/css/Global.css') }}" />

<style>
    .title {
        text-align: center;
        padding: 10px;
        background-color: var(--primary);
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;

    }

    .title h1 {
        font-size: 30px;


    }

    @media (max-width: 991.98px) {

        .title h1 {
            text-align: center;
            padding: 10px;
            background-color: var(--primary);
            color: white;
            position: fixed;
            font-size: 20px;
            top: 0;
            left: 0;
            width: 100%;
        }
    }



    .describe {
        padding: 100px 0px;
    }

    .describe ul li {
        padding: 10px;
    }



    /******************* Footer Section */

    footer {
        background-color: var(--primary);

    }

    .footer {

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        height: 40vh;
    }

    footer ul {
        list-style-type: none;
        display: flex;
        flex-direction: column;
        align-self: center;

    }

    footer ul li {
        padding: 0px 10px;
        margin-top: 20px;
    }


    footer a {
        text-decoration: none;
        height: auto;
        color: rgba(255, 255, 255, .7);
    }

    footer a:hover {
        text-decoration: none;
        color: rgba(255, 255, 255, 1);
        transition: 1s all;
        font-size: 18px;
        cursor: pointer;
    }


    @media (max-width: 991.98px) {
        footer a {
            text-decoration: none;
            height: auto;
            color: rgba(255, 255, 255, .7);
            font-size: 15px;
        }

        footer img {
            width: 40%;
            height: 100%;
        }

        .footer {
            margin: 0;
            padding: 0;
            width: 100%;
        }
    }

    /******************* End Footer Section */



    #top {
        display: none;
        position: fixed;
        bottom: 50px;
        right: 30px;
        z-index: 99;
        border: none;
        outline: none;
        background-color: var(--buttons);
        color: var(--primary);
        cursor: pointer;
        padding: 15px;
        border-radius: 15px;
        font-size: 18px;
    }

    #top:hover {
        background-color: var(--primary);
        color: white;
        box-shadow: 5px 5px 10px;
    }

</style>

<!--------------------------------------------------------------------------------------->


</head>

<body dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" lang="{{ Config::get('app.locale') }}">
    <header>



            <div class="title">
                <h1> {{ Config::get('app.locale') == 'ar' ? 'الشروط والاحكام' : 'Terms and Conditions' }}</h1>

            </div>
        </header>

<main>

            <div class="describe container " style="min-height: 100vh">

                <ul>

                    @foreach ($terms as $term)
                        <li>{{ Config::get('app.locale') == 'ar' ? $term->describe_ar : $term->describe_en }}</li>
                    @endforeach

                </ul>



            </div>

        </main>






    <!------------------------------------- Footer Section-->

    @include('Website.globalElements.footer')

    <!------------------------------------- End Footer Section-->

    <!--  JS  ------------------------------------------------------------------------------>

    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        var lang = {!! json_encode(config('app.locale')) !!};
    </script>



    <script>
        mybutton = document.getElementById("top");

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>
