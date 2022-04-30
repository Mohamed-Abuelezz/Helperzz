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

        <br>
        <br>
        <div class="container">
            <form method="POST" action="{{ route('sendMail.store') }}" enctype="multipart/form-data">

                @csrf

        <div class="form-group">
            <label for="exampleInputPassword1">البريد الاليكتروني</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputPassword1" placeholder="البريد الاليكتروني"
                name="email"  value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">

                    {{ $message }}

                </div>
            @enderror

        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1 " class="form-label">Message</label>
            <textarea class="form-control shadow-none  custome-textFiled @error('message') is-invalid @enderror"
                id="exampleFormControlTextarea1" rows="3" maxlength="500" name="message"></textarea>
            <div id="emailHelp" class="form-text">maximan 500 charachter.</div>

        </div>
        <button type="submit" class="btn btn-primary">ارسال</button>

    </form>
        <br>

    
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>البريد الاليكتروني</th>
    
                    <th>الرسالة</th>
                    <th>تاريخ الانشاء</th>
                </tr>
            </thead>
    
            <tbody>
    
                @foreach ($mails as $mail)
                    <tr  data-id="{{$mail->id}}">
                        <td>{{ $mail->id }}</td>
                        <td>{{ $mail->email }}</td>
                        <td>{{ $mail->message }}</td>
    
    
    
                        <td>{{ $mail->created_at }}</td>
                    </tr>
                @endforeach
    
    
    
            </tbody>
            <tfoot>
    
            </tfoot>
        </table>

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
    <script src="{{ asset('Dashboard_Assets/dist/js/pages/termsAndConditions.js') }}"></script>
    <script src="{{ asset('Dashboard_Assets/dist/js/global.js') }}"></script>


    @if(session()->has('msg'))

<script>

        toastr.success( {!! json_encode(session()->get('msg')) !!})

</script>
@endif
    
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
