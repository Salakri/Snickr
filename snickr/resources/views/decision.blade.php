<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <div class="card mx-auto ">
        <img class="card-img-top img-fluid" src="/img/14.jpg" alt="image">
        <div class="card-img-overlay text-center ">
            <p></p>
            @if($type === 'ws')
            <h5 class="card-title text-dark">{{$sender}} invites you to Workspace</h5>
            <p>{{$name}}</p>
            @else
            <h5 class="card-title text-dark">{{$sender}} invites you to Channel</h5>
            <p>{{$name}}</p>
            @endif
            <!--sender cname/wname cid/wid-->
            <p class="card-text text-dark">Do you accept this invitation?</p>
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <a href="{{action('InviteController@join',['sender'=>$sender,'senderid'=>$senderid,'type'=>$type,'name'=>$name, 'id'=>$id,'time'=>$time])}}" type="button" class="btn btn-outline-secondary col-6"><i class="fa fa-fw fa-check"></i></a>
                    <a href="{{action('InviteController@refuse',['defaultwid'=>$defaultwid,'defaultwname'=>$defaultwname,'defaultch'=>$defaultch,'defaultde'=>$defaultde, 'sender'=>$sender,'type'=>$type,'name'=>$name, 'id'=>$id,'time'=>$time])}}" type="button" class="btn btn-outline-secondary col-6"><i class="fa fa-fw fa-times"></i></a>
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