<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('test/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('test/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('test/css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
           {{csrf_field()}}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="exampleInputEmail1">Email address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email"  required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="exampleInputPassword1">Password</label>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Login"></input>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{url('/register')}}">Register an Account</a>
          <a class="d-block small" href="{{ url('/password/reset') }}">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('test/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('test/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('test/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
</body>

</html>
