<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  @include('Dashboard.globalElements.meta')


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Dashboard_Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Dashboard_Assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>{{\App\Models\WebsiteConfig::where(['isActive' => 1])->first()->website_name}}</b>HZ</a>
  </div>
  <!-- /.login-logo -->



  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">تسجيل الدخول</p>

      <form action="{{ route('adminLoginPost') }}" method="post">
        {!! csrf_field() !!}


        @if(\Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif

        {{ \Session::forget('success') }}
        @if(\Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ \Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif       


        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('email'))
          <span class="help-block font-red-mint">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif

        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          @if ($errors->has('password'))
          <span class="help-block font-red-mint">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif

        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"> الدخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      
    </div>
    <!-- /.login-card-body -->
  </div>


  </div>



</div>
<!-- /.login-box -->

<script src="{{ asset('Dashboard_Assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Dashboard_Assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Dashboard_Assets/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
