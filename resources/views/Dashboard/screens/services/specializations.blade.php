<!DOCTYPE html>
<html lang="en">

<head>
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
                            <h1 class="m-0">تخصصات الخدمات</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Specializations</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


        <div class="card">

            <div class="card card-primary">
                {{-- <div class="card-header">
                  <h3 class="card-title">اضافة </h3>
                </div> --}}
                <form method="POST" action="{{ route('specializations.store') }}" enctype="multipart/form-data">

                    @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <input type="text" class="form-control  @error('name_ar') is-invalid @enderror" placeholder="العنوان باللغه العربية"  name="name_ar" value="{{ old('name_ar') }}">
                      @error('name_ar')
                      <div class="invalid-feedback">

                          {{ $message }}

                      </div>
                  @enderror
                   
                    </div>
                    <div class="col-2">
                      <input type="text" class="form-control  @error('name_en') is-invalid @enderror" placeholder="العنوان باللغه الانجليزية"  name="name_en" value="{{ old('name_en') }}">
                      @error('name_en')
                      <div class="invalid-feedback">

                          {{ $message }}

                      </div>
                  @enderror
                    </div>
                    <div class="col-2">

                    <div class="form-group">
                        <select class="form-control" name="category">

                        @foreach ($serviceCatogries as $serviceCatogrey)
                          <option value="{{ $serviceCatogrey->id }}">{{$serviceCatogrey->name_ar}}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">اضافة</button>
                      </div>
  
                  </div>
                </div>
            </form>

                <!-- /.card-body -->
              </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>العنوان</th>
                            <th>القسم</th>

                            <th>اوامر</th>
                            <th>تاريخ الانشاء</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($specializations as $specialization)
                            <tr  data-id="{{$specialization->id}}">
                                <td>{{ $specialization->id }}</td>
                                <td>{{ $specialization->name_ar }}</td>
                                <td>{{ $specialization->category->name_ar }}</td>


                                <td class="d-flex flex-row justify-content-center g-5"  style="gap: 10px">


                                      <div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                          <input type="checkbox" class="custom-control-input myActiveSwitch" data-id="{{$specialization->id}}" data-resource="specializations/{{$specialization->id}}" id="customSwitch{{$specialization->id}}" {{ $specialization->isActive == 1 ? 'checked' : '' }}>
                                          <label class="custom-control-label " for="customSwitch{{$specialization->id}}"></label>
                                        </div>
                                      </div>

                                  <a href="#" id="delete" class="delete" style="color: red;" data-id="{{$specialization->id}}" data-resource="specializations/{{$specialization->id}}"><i class="fas fa-trash"></i> </a>
                                 
                                </td>
                                <td>{{ $specialization->created_at }}</td>
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
    <script src="{{ asset('Dashboard_Assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" type="module"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/dashboard.js') }}"></script>


    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('Dashboard_Assets/dist/js/global.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/specializations.js') }}"></script>


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
