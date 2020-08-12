<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{asset('test/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="{{asset('test/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="{{asset('test/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{asset('test/css/sb-admin.css')}}" rel="stylesheet">

        <!-- Styles -->
        <!--style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style-->
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-image:url('/img/homebg.jpg')">
            @if (Route::has('login'))
                @if (Auth::check())
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle mr-lg-2" id="dropdownMenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h7 class ="text-light" >{{Auth::user()->name}}</h7>
                                        <b class="caret"></b>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                        <h6 class="dropdown-header">My Workspaces:</h6>
                                        @if(count($ws) > 0)
                                            @foreach($ws as $wsi)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{action('HomeController@index',['wsid'=>$wsi->wid,'wsname'=>$wsi->wname, 'default'=>-1])}}">
                                                <strong>{{$wsi->wname}}</strong>
                                            </a>
                                            @endforeach
                                        @endif
                                </li>
                                <!--TODO:add invitation message-->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-fw fa-envelope"></i>
                                        <span class="d-lg-none">Invitations
                                        </span>
                                        @if(count($winv) > 0 || count($winv) > 0)

                                        @endif
                                    </a>

                                    <!-- Invitation Messages#################################################################################-->
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">New Invitations:</h6>
                                        @foreach($winv as $wsi)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{action('InviteController@showDecision',['defaultwid'=>-1,'defaultwname'=>-1,'defaultch'=>-1,'defaultde'=>-1,'sender'=>$wsi->name,'senderid'=>$wsi->id,'type'=>'ws','name'=>$wsi->wname, 'id'=>$wsi->wid, 'time'=>$wsi->iwtimedate])}}">
                                                <strong>{{$wsi->name}}</strong>
                                                <span class="small float-right text-muted">{{$wsi->iwtimedate}}</span>
                                                <!--div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div-->
                                            </a>
                                        @endforeach
                                        @foreach($cinv as $ci)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{action('InviteController@showDecision',['defaultwid'=>-1,'defaultwname'=>-1,'defaultch'=>-1,'defaultde'=>-1,'sender'=>$ci->name,'senderid'=>$ci->id,'type'=>'ch','name'=>$ci->cname, 'id'=>$ci->cid,'time'=>$ci->ictimedate])}}">
                                            <strong>{{$ci->name}}</strong>
                                            <span class="small float-right text-muted">{{$ci->ictimedate}}</span>
                                            <!--div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div-->
                                            </a>
                                        @endforeach
                                        @if(count($winv) > 0 || count($winv) > 0)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item small" href="#">View all Invitations</a>
                                        @endif
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{action('WorkspaceController@create')}}">
                                        <i class="fa fa-fw fa-plus"></i>Create Workspace</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/logout')}}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                    </nav>
                    @else
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">
                                <i class="fa fa-fw fa-sign-in"></i>Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">
                                <i class="fa fa-fw fa-arrow-circle-o-up"></i>Register</a>
                        </li>
                    </ul>
                    </nav>
                    <!--
                    <div class="top-right nav-link">
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    </div>
                    -->
                    @endif
            @endif


        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('test/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('test/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('test/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- Page level plugin JavaScript-->
        <script src="{{asset('test/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('test/vendor/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('test/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{asset('test/js/sb-admin.min.js')}}"></script>
        <!-- Custom scripts for this page-->
        <script src="{{asset('test/js/sb-admin-datatables.min.js')}}"></script>
        <script src="{{asset('test/js/sb-admin-charts.min.js')}}"></script>
      </div>
    </div>
    </body>
</html>