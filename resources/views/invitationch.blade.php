<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Invitation</title>
    <!-- Bootstrap core CSS-->
    <link href="{{asset('test/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{asset('test/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset('test/css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="bg-dark fixed-nav">

<!-- navigate bar ######################################################################-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <h1 class="navbar-brand" href="index.html">Snickr</h1>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
    </ul>
</nav>
<!-- navigate end ######################################################################-->

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Invitation</div>
        <div class="card-body">
            <form role="form" method="POST" action="{{ action('InviteController@insertch',['cid'=>$cid,'num'=> 3]) }}"><!--TODO: change num-->
            {{csrf_field()}}
                <!-- invitation list ######################################################################-->
                <p>Invitation List</p>
                @if($ctype === 'private')
                    <div class="form-group">
                        <input class="form-control" id="workspacedes1" type="text" placeholder="Email 1" name="email1">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="workspacedes2" type="text" placeholder="Email 2" name="email2">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="workspacedes3" type="text" placeholder="Email 3" name="email3">
                    </div>
                @else
                    <div class="form-group">
                        <input class="form-control" id="workspacedes1" type="text" placeholder="Email 1" name="email1">
                    </div>
                @endif
                <!-- buttons ######################################################################-->
                <input class="btn btn-primary btn-block" type="submit" value="Invite">
                <p></p>

            </form>
            <a class="btn btn-secondary btn-block" href="#">Cancel</a>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
