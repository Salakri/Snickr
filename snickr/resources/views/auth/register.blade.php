<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Register</title>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('test/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('test/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('test/css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form role="form" method="POST" action="{{ url('/register') }}">
          {{csrf_field()}}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"">
              <div class="mb-3">
                <label for="name">UserName</label>
                <input class="form-control" id="name" type="text" aria-describedby="nameHelp" placeholder="Enter username" name="name" value="{{old('username')}}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}"">
              <div class="mb-3">
                <label for="name">Nickname</label>
                <input class="form-control" id="nickname" type="text" aria-describedby="nameHelp" placeholder="Enter nickname" name="nickname" value="{{old('nickname')}}" required autofocus>
                @if ($errors->has('nickname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nickname') }}</strong>
                    </span>
                @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="mb-3">
            <label for="email">Email address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="control-label">Password</label>

              <div class="mb-3">
                  <input id="password" type="password" class="form-control" name="password" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <label for="password-confirm" class="control-label">Confirm Password</label>

              <div class="mb-3">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block">
                      Register
                  </button>
              </div>
          </div>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{url('/login')}}">Login Page</a>
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
