<html>

<html lang="{{ Config::get('app.locale') }}">
<!-- Required meta tags -->
@include('Website.globalElements.meta')

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


    @media (max-width: 991.98px) { 

        .title h3{
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
    <div>

        <div class="title">
            <h3> {{ Config::get('app.locale') == 'ar' ? 'الشروط والاحكام' : 'Terms and Conditions' }}</h3>

        </div>


        <div class="describe container " style="min-height: 100vh" >

            <ul>

              @foreach ($terms as $term)
              <li>{{  Config::get('app.locale') == 'ar' ? $term->describe_ar :  $term->describe_en }}</li>
      @endforeach

            </ul>



        </div>



    </div>




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
