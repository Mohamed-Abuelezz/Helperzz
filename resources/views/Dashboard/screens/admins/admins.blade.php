<!DOCTYPE html>
<html lang="en">

  <!-- Required meta tags -->
  @include('Dashboard.globalElements.meta')

    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Dashboard_Assets/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <!-- Main Sidebar Container -->
    @include('Dashboard.globalElements.sidebarWithHeader')

    <!-- /.navbar -->

    <div class="content-wrapper">


            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">الادمنز</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Admins</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


        <div class="card">
            <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">

                @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-2">
                  <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="الاسم"  name="name" value="{{ old('name') }}">
                  @error('name')
                  <div class="invalid-feedback">

                      {{ $message }}

                  </div>
              @enderror
               
                </div>
                <div class="col-2">
                  <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="البريد الاليكتروني"  name="email" value="{{ old('email') }}">
                  @error('email')
                  <div class="invalid-feedback">

                      {{ $message }}

                  </div>
              @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                        placeholder="الرقم السري" name="password"   value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>
                    @enderror

                </div>
                <div class="col-3">

                    <div class="form-group">
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
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary">اضافة</button>
                  </div>

              </div>
            </div>
        </form>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>الصورة الشخصية</th>
                            <th>الاسم</th>
                            <th>البريد الاليكتروني</th>
                            <th>اوامر</th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($admins as $admin)
                            <tr  data-id="{{$admin->id}}">
                                <td>{{ $admin->id }}</td>
                                <td><img src="{{ asset('storage/'.$admin->image) }}" alt="user image" width="100" height="100"> </td>
                                <td>{{ $admin->name }}</td>

                                <td>{{ $admin->email }}</td>

                                <td class="d-flex flex-row justify-content-between g-5"  style="gap: 10px">

                                  <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                      <input type="checkbox" class="custom-control-input myActiveSwitch" data-id="{{$admin->id}}" data-resource="admins/{{$admin->id}}" id="customSwitch{{$admin->id}}" {{ $admin->isActive == 1 ? 'checked' : '' }}>
                                      <label class="custom-control-label " for="customSwitch{{$admin->id}}"></label>
                                    </div>
                                  </div>

                                  <a href="#" id="delete" class="delete" style="color: red;" data-id="{{$admin->id}}" data-resource="admins/{{$admin->id}}"><i class="fas fa-trash"></i> </a>
                                 
                                </td>
                                <td>{{ $admin->created_at }}</td>
                            </tr>
                        @endforeach



                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>









    </div>




    </div>





    <!-- Footer Container -->
    @include('Dashboard.globalElements.footer')


    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/dashboard/')) !!}
        </script>
        

    <script src=" {{ asset('Dashboard_Assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src=" {{ asset('Dashboard_Assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" type="module"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/global.js') }}"></script>


    <script src="{{ asset('Dashboard_Assets/dist/js/pages/admins.js') }}"></script>


    <script>
        $(function () {
    $('#myTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    }).buttons().container().appendTo('.col-md-6:eq(0)');
  });
    </script>

</body>

</html>
