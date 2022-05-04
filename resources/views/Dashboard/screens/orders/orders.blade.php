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
                            <h1 class="m-0">الحجوزات</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Orders</li>
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
                            <th>المستخدم البلد/المنطقه/المدينة</th>
                            <th>اسم مقدم الخدمة</th>
                            <th>مقدم الخدمة البلد/المنطقه/المدينة</th>
                            
                            <th>التفاصيل</th>

                            <th>اوامر</th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($orders as $order)
                            <tr  data-id="{{$order->id}}">

                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->country->name . ' / ' . $order->user->state->name . ' / ' . ($order->user->city!= null ?   $order->user->city->name  : 'لايوجد مدينة' )}}</td>
                                <td>{{ $order->provider->name }}</td>
                                <td>{{ $order->provider->country->name . ' / ' . $order->provider->state->name . ' / ' .  ($order->provider->city!= null ?   $order->provider->city->name  : 'لايوجد مدينة' ) }}</td>

                                <td>{{ $order->describe }}</td>

                                <td class="d-flex flex-row justify-content-between g-5"  style="gap: 10px">

                                  <a href="#" id="accept" class="accept" style="color: green;" data-id="{{$order->id}}" data-resource="orders/{{$order->id}}"><i class="fas fa-thumbs-up"></i></a>
                                  <a href="#" id="reject" class="reject" style="color: red;" data-id="{{$order->id}}" data-resource="orders/{{$order->id}}"> <i class="fas fa-thumbs-down"></i></a>
                                 
                                </td>
                                <td>{{ $order->created_at }}</td>


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
        var APP_URL = {!! json_encode(url('/dashboard/')) !!};



    // var module = { }; /*   <-----THIS LINE */

    </script>
        


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
  {{-- <script src="https://js.pusher.com/7.0/pusher-with-encryption.min.js"></script> --}}

    <script src="{{ asset('Dashboard_Assets/dist/js/pages/orders.js') }}" type="module"></script>


    
    <script type="module" >
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

 // import Echo from '{{asset('js/echo.js')}}'
//   import Pusher from 'pusher-js';

 // window.Pusher = require('pusher-js');


//   window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: '{{env("PUSHER_KEY")}}',
//   cluster: 'mt1',
//   forceTLS: true

//   //encrypted: true,
//  // authEndpoint: '{{env("APP_URL")}}/orders/1'
// });



    </script>

</body>

</html>
