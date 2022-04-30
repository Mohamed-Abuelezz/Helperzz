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
                            <h1 class="m-0">الابلاغات عن مقدمي الخدمات</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Providers Reports</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>اسم المستخدم</th>
                            <th>اسم مقدم الخدمة</th>
                            <th>الصورة</th>
                            <th>السبب</th>

                            <th>اوامر</th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($reportsProfile as $reportProfile)
                            <tr  data-id="{{$reportProfile->id}}">

                                <td>{{ $reportProfile->id }}</td>
                                <td>{{ $reportProfile->user->name }}</td>
                                <td>{{ $reportProfile->serviceProvider->name }}</td>
@if ($reportProfile->photo != null)
<td>   <img src="{{ asset('storage/'.$reportProfile->photo) }}" alt="user image" width="100" height="100"> </td>

@else
    <td>لاتوجد صورة</td>
@endif
                                <td>{{ $reportProfile->reason }}</td>

                                <td class="d-flex flex-row justify-content-between g-5"  style="gap: 10px">


                                    <div class="form-group">
                                        <select class="form-control" id="actions" name="category" data-id="{{$reportProfile->id}}" data-resource="reportsProfile/{{$reportProfile->id}}">
                                            <option value="" disabled selected>اختار رد</option>

                                          <option value="0" >لاتوجد مشكلة</option>
                                          <option value="1">ايقاف حساب مقدم الخدمة</option>
                
                                        </select>
                                      </div>

                                    {{-- <a href="#" id="accept" class="accept" style="color: green;" data-id="{{$reportProfile->id}}" data-resource="reportsProfile/{{$reportProfile->id}}"><i class="fas fa-thumbs-up"></i></a>
                                    <a href="#" id="reject" class="reject" style="color: red;" data-id="{{$reportProfile->id}}" data-resource="reportsProfile/{{$reportProfile->id}}"> <i class="fas fa-thumbs-down"></i></a> --}}
  

                                 
                                </td>


                                <td>{{ $reportProfile->created_at }}</td>
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
    <script src="{{ asset('Dashboard_Assets/dist/js/global.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/providersReports.js') }}"></script>


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
