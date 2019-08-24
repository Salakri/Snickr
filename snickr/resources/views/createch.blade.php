<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Create Channel</title>
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
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="{{ url('/logout')}}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out"></i>Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</nav>
<!-- navigate end ######################################################################-->

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Create New Channel</div>
        <div class="card-body">
            <form method="POST" action="{{ action('ChannelController@check',['wid'=>$wid]) }}" role="form">
                {{csrf_field()}}

                <!-- name ######################################################################-->
                <div class="form-group">
                    <label for="channelname">Channel Name</label>
                    <input class="form-control" id="channelname" type="text" placeholder="Name" name="cname">
                </div>

                <!-- type ######################################################################-->
                <div class="form-group">
                    <label for="channeltype">Channel Type</label>
                    <select class="form-control" id="channeltype" name="ctype">
                        <option>private</option>
                        <option>public</option>
                        <option>direct</option>
                    </select>
                </div>


                <!-- invitation list ######################################################################-->
                <!--
                <p>Invitation List</p>
                <div class="form-group">
                    <input class="form-control" id="workspacedes1" type="text" placeholder="Email 1">
                </div>
                <div class="form-group">
                    <input class="form-control" id="workspacedes2" type="text" placeholder="Email 2">
                </div>
                <div class="form-group">
                    <input class="form-control" id="workspacedes3" type="text" placeholder="Email 3">
                </div>
                   -->
                <!-- buttons ######################################################################-->
                <input class="btn btn-primary btn-block" type="submit" value="Confirm">
            </form>
            <a class="btn btn-secondary btn-block" href="{{ url('/createch/back') }}">Cancel</a>
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
