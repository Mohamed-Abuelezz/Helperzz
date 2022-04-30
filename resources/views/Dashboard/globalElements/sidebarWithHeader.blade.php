    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: black">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('storage/'.\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->logo)}}" alt="Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{config('app.name')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('storage/'.auth()->guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->guard('admin')->user()->name}}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{route('Dashboard')}}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>




                    <li class="nav-header">Core</li>
                    

                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                المستخدمين
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('providers.index')}}" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                مقدمي الخدمات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admins.index')}}" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                الادمنز
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('orders.index')}}" class="nav-link">
                            <i class="nav-icon far fa-solid fa-bookmark"></i>
                            <p>
                                الحجوزات
                                <span class="badge badge-info right" id="orderCount">{{\App\Models\Order::where(['ordersStatus_id' => 1])->get()->count() }}</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-table"></i>
                                                        <p>
                                تعديل الخدمات
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('servicesCategories.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>اقسام الخدمات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('specializations.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>تخصصات الخدمات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('moreServices.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>المزيد للخدمات</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-flag"></i>
                            
                            <p>
                                الابلاغات
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right" id="orderCount">{{\App\Models\ReportProfile::where(['isActive' => 1])->get()->count() + \App\Models\ReportComment::where(['isActive' => 1])->get()->count() }}</span>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('reportsProfile.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>مقدمي الخدمات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('reportsComment.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>التعليقات</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-scroll"></i>                            
                            <p>
                                الشروط والاحكام
                                <i class="fas fa-angle-left right"></i>
                                
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('termsAndConditions.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>الشروط والاحكام</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('termsAndConditionsOrder.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>شروط انشاء حجز</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('termsAndConditionsAcceptOrder.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>شروط قبول حجز</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('contactUs.index')}}" class="nav-link">
                            <i class="fas fa-envelope-open-text"></i>
                            <span class="badge badge-info right" id="orderCount">{{\App\Models\ContactUs::where(['isActive' => 1])->get()->count()  }}</span>

                                                                  <p>
رسائل التواصل</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('sendMail.index')}}" class="nav-link">
                            <i class="fas fa-envelope-open-text"></i>
                                                                  <p>
ارسال بريد</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('websiteConfig.index')}}" class="nav-link">
                            <i class="fas fa-cogs"></i>                                      <p>
اعدادات الموقع                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('deHash.index')}}" class="nav-link">
                            <i class="fas fa-user-lock"></i>                                     <p>
فك التشفير
                           </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('adminLogout')}}" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>                            <p>
                                تسجيل الخروج
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>

        </ul>

    </nav>