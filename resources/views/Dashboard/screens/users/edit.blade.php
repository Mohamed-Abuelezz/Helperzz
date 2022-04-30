<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  @include('Dashboard.globalElements.meta')


    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!--<link rel="stylesheet"-->
    <!--    href="{{ asset('Dashboard_Assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <!-- Main Sidebar Container -->
    @include('Dashboard.globalElements.sidebarWithHeader')

    <!-- /.navbar -->

    <div class="content-wrapper d-flex justify-content-center flex-column">

            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1 class="m-0">التعديل</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                              <li class="breadcrumb-item active">Edit</li>
                          </ol>
                      </div><!-- /.col -->
                  </div><!-- /.row -->
              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->




        <div class="container">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">تعديل حساب مستخدم</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">

                    @csrf

                    @method('PATCH')
                
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputFile"> الصورة الشخصية #اختياري</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror"
                                        id="exampleInputFile" name="image" value="{{ old('image') }}">
                                    <label class="custom-file-label" for="exampleInputFile">الصورة الشخصية</label>
                                </div>
                                @error('image')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الاسم</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                placeholder="الاسم" name="name" value="{{ $user->name }}"> 
                                @error('name')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror


                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">البريد الاليكتروني</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputPassword1" placeholder="البريد الاليكتروني"
                                name="email"  value="{{ $user->email }}">
                                @error('email')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">الرقم السري #اختياري</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                placeholder="الرقم السري" name="password"   >
                                @error('password')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">رقم الهاتف</label>
                            <input type="number" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                placeholder="رقم الهاتف" name="phone"    value="{{ $user->phone }}">

                                @error('phone')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror

                        </div>




                        <div class="form-group">
                            <label>البلد</label>
                            <select class="custom-select @error('country') is-invalid @enderror"     value="{{ $user->country_id }}" name="country" id="country">

                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"   {{ $user->country_id == $country->id ? 'selected' :'' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>
                        @enderror

                        </div>


                        <div class="form-group">
                            <label>المنطقه</label>
                            <select class="custom-select @error('state') is-invalid @enderror"     value="{{ $user->state_id }}"  name="state" id="state">
                           
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}"   {{ $user->state_id == $state->id ? 'selected' :'' }}>{{ $state->name }}</option>
                            @endforeach

                           
                            </select>
                            @error('state')
                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label>المدينة</label>
                            <select class="custom-select @error('city') is-invalid @enderror"     value="{{ $user->city_id }}"   name="city" id="cities">
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}"   {{ $user->city_id == $city->id ? 'selected' :'' }}>{{ $city->name }}</option>
                            @endforeach

                            </select>

                            @error('city')
                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>
                        @enderror
                        </div>

                        <div class="form-group">

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" value="1"
                                    name="gender" {{ $user->gender == 1 ? 'checked' : '' }}>
                                <label for="customRadio1" class="custom-control-label">ذكر</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" value="0"
                                    name="gender" {{ $user->gender == 0 ? 'checked' : '' }}>
                                <label for="customRadio2" class="custom-control-label">انثي</label>
                            </div>

                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                    </div>
                </form>
            </div>







        </div>
    </div>





    <!-- Footer Container -->
    @include('Dashboard.globalElements.footer')




    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/dashboard')) !!}
    </script>
    <script src=" {{ asset('Dashboard_Assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!--<script src="{{ asset('Dashboard_Assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>-->
    <!--<script src="{{ asset('Dashboard_Assets/dist/js/adminlte.js') }}"></script>-->
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/global.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/users.js') }}"></script>
    <script>
        // $(function() {
        //     bsCustomFileInput.init();
        // });
    </script>

</body>

</html>
