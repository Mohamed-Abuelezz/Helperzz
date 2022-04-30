    <style>

/*******************  NavBar Section */
nav {
  background-color: var(--primary);
  padding: 15px 100px;
  position: fixed;
  display: flex;
  justify-content: center
  top: 0;
  left: 0;
  width: 100%;
  z-index: 999;
  height: 50px;
  padding: 10px 0px;
}
nav .items {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  align-items: center;
}

nav .items ul:nth-child(2) {
  display: flex;
  justify-content: end;
}

.popover-body {
  border-radius: 50px;
  width: 200px;
}
.dropdown-profile-content {
  display: flex;
  width: 100%;
  flex-direction: column;
  text-align: center;
  align-items: center;
}

.dropdown-profile-content a {
  text-decoration: none;
  color: black;
  padding: 8px 10px;
}

.dropdown-profile-content a:hover {
  color: var(--primary);
  font-weight: bold;
}
.dropdown-profile-content hr {
  width: 100%;
}


@media (max-width: 991.98px) {
  nav {
    display: none;
    padding: 15px 10px;
  }
}

nav ul {
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  list-style-type: none;
  display: flex;
  justify-content: start;
  align-items: center;
}

nav ul li {
  padding: 0px 10px;
  float: left;
}

nav a {
  text-decoration: none;
  height: auto;
  color: rgba(255, 255, 255, 0.7);
}

nav a:hover {
  text-decoration: none;
  color: rgba(255, 255, 255, 1);
  transition: 1s all;
  /* font-size: 18px; */
  cursor: pointer;
}

nav .items ul:nth-child(2) img {
  border-radius: 50%;
}

nav .items ul:nth-child(2) img:hover {
  cursor: pointer;
}

/* NavBar Mobile */
.nav-mobile {
  display: none;
  padding: 10px 20px !important;
}
@media (max-width: 991.98px) {
  .nav-mobile {
    display: flex;
    flex-direction: column;
    justify-content: center  }
}
.nav-mobile span {
  text-align: left;
  width: 100%;
}
.sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  background-color: var(--primary);
  overflow-x: hidden;
  transition: 0.5s;
  transform: translateX(-100%);
  padding-top: 60px;
  text-align: center;

}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 18px;
  color: white;
  display: block;
  transition: 0.3s;
}
.sidenav a:hover {
  font-size: 20px;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.open-bg {
}

.open {
  transform: translateX(0px);
}

@media screen and (max-height: 450px) {
  .sidenav {
    padding-top: 15px;
  }
  .sidenav a {
    font-size: 18px;
  }
}

/******************* End NavBar Section */



    </style>
    
    
    
    
    
    
    <!------------------------------------- NavBar Section-->
    <nav class="nav-screen">
        <div class="items container">

            <ul>
                <li> <a href="{{ route('home') }}">{{Config::get('app.locale') == 'ar' ?  'الرئيسية' :  'Home'}}</a></li>

                <li> <a href="{{route('terms')}}"> {{Config::get('app.locale') == 'ar' ?  'الشروط والاحكام' :  'Terms And Conditions'}}</a></li>
                <li> <a href="{{route('contactUs')}}"> {{Config::get('app.locale') == 'ar' ?  'تواصل معنا' :  'Contact Us'}}</a></li>

            </ul>
            <ul>
                <li> <a href="{{route('auth')}}">{{Config::get('app.locale') == 'ar' ?  'التسجيل' :  'Login'}}</a></li>
                <li> | </li>
                <li> <a href="{{url('setlocale/'.(Config::get('app.locale') == 'ar' ? 'en': 'ar') )}}"> <i class="fas fa-globe-africa"></i> {{Config::get('app.locale') == 'ar' ? 'English' : 'عربي'}} </a></li>

            </ul>

        </div>


    </nav>

    <!--
 Mobile NavBar Section
  -->

    <nav class="nav-mobile" >

        <div class="">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" id="closeNav">&times;</a>
                <a href="{{ route('home') }}">{{Config::get('app.locale') == 'ar' ?  'الرئيسية' :  'Home'}}</a>
              <a href="{{route('terms')}}"> {{Config::get('app.locale') == 'ar' ?  'الشروط والاحكام' :  'Terms And Conditions'}}</a>
             <a href="{{route('contactUs')}}"> {{Config::get('app.locale') == 'ar' ?  'تواصل معنا' :  'Contact Us'}}</a>
<hr>
<a href="{{route('auth')}}">{{Config::get('app.locale') == 'ar' ?  'التسجيل' :  'Login'}}</a>
<a href="{{url('setlocale/'.(Config::get('app.locale') == 'ar' ? 'en': 'ar') )}}"> <i class="fas fa-globe-africa"></i> {{Config::get('app.locale') == 'ar' ? 'English' : 'عربي'}} </a>            </div>
            <span style="font-size:30px;cursor:pointer;color: white;" id="openNav">&#9776;</span>
        </div>


    </nav>



    <!-------------------------------------End NavBar Section-->


    