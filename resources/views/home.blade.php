<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Snickr</title>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('test/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('test/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{asset('test/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('test/css/sb-admin.css')}}" rel="stylesheet">
</head>

<!-- Navigate Bar ##############################################################################################-->

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <h1 class="navbar-brand" href="index.html">Snickr</h1>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <!-- Workspace Columns##############################################################################################-->
    <div class="collapse navbar-collapse" id="navbarResponsive">



      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li>
          <div>
            <p></p>
            <h4 class="text-center text-light">{{ Auth::user()->name }}</h4>
            <p class="text-center text-light">{{ Auth::user()->email }}</p>
            <p class="text-center text-secondary">{{$workspacename}}</p>
            <textarea hidden id="cid">{{$ch}}</textarea>
            <textarea hidden id="uid">{{Auth::user()->id}}</textarea>
            <textarea hidden id="wid">{{$workspaceid}}</textarea>
          </div>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="public">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-users"></i>
              <span class="nav-link-text">Public Channels</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              @foreach($channels as $cha)
                @if($cha->ctype === 'public')
              <li>
                <a href="{{action('HomeController@index',['wsid'=>$workspaceid,'wsname'=>$workspacename,'ch'=>$cha->cid,'default'=> 0])}}">{{$cha->cname}}</a>
              </li>
                @endif
              @endforeach
            </ul>
          </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="private">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-handshake-o"></i>
            <span class="nav-link-text">Private Channels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents1">
            @foreach($channels as $cha)
              <!--p></p-->
              @if($cha->ctype === 'private')
              <li>
                <a href="{{action('HomeController@index',['wsid'=>$workspaceid,'wsname'=>$workspacename,'ch'=>$cha->cid,'default'=> 0])}}">{{$cha->cname}}</a>
              </li>
              @endif
            @endforeach
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="direct">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user-o"></i>
            <span class="nav-link-text">Direct Channels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents2">
            @foreach($channels as $cha)
              @if($cha->ctype === 'direct')
              <li>
                <a href="{{action('HomeController@index',['wsid'=>$workspaceid,'wsname'=>$workspacename,'ch'=>$cha->cid,'default'=> 0])}}">{{$cha->cname}}</a>
              </li>
              @endif
            @endforeach
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="more">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class="nav-link-text">More</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents3">
            <li>
              <a id="changeWs">Change Workspace</a>
            </li>
            <li>
              <a id="listusers">Users in Workspace</a>
            </li>
            <li>
              <a id="">Manage Users</a>
            </li>
          </ul>
        </li>

      </ul>

      <!-- Top Navigators##############################################################################################-->
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>


      <!-- Invitations##############################################################################################-->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="InviteDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="d-lg-none">Invite to Workspace/Channel
            </span>
            <span class="indicator text-primary d-none d-lg-block">
            </span>
          </a>

          <div class="dropdown-menu" aria-labelledby="InviteDropdown">
            <a class="dropdown-item" href="{{action('InviteController@checkws',['wid'=>$workspaceid])}}">
              <strong>Invite to Workspace</strong>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{action('InviteController@checkch',['chid'=>$ch])}}">
              <strong class>Invite to Channel</strong>
            </a>
          </div>
        </li>

        <!-- create#############################################################################################-->

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="CreateDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="d-lg-none">Create Workspace/Channel
            </span>
            <span class="indicator text-primary d-none d-lg-block">
            </span>
          </a>

          <div class="dropdown-menu" aria-labelledby="CreateDropdown">
            <a class="dropdown-item" href="{{action('WorkspaceController@create',['wid'=>$workspaceid])}}">
              <strong>Create Workspace</strong>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{action('ChannelController@create',['wid'=>$workspaceid])}}">
              <strong>Create Channel</strong>
            </a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Invitations
            </span>
            @if(count($winv) > 0 || count($cinv) > 0)
              <span class="indicator text-primary d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
              </span>
            @endif
          </a>

          <!-- Invitation Messages#################################################################################-->
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Invitations:</h6>
            @foreach($winv as $wsi)
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{action('InviteController@showDecision',['defaultwid'=>$workspaceid,'defaultwname'=>$workspacename,'defaultch'=>$ch,'defaultde'=>$default,'sender'=>$wsi->name,'senderid'=>$wsi->id,'type'=>'ws','name'=>$wsi->wname, 'id'=>$wsi->wid,'time'=>$wsi->iwtimedate])}}">
              <strong>{{$wsi->name}}</strong>
              <span class="small float-right text-muted">{{$wsi->iwtimedate}}</span>
              <!--div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div-->
            </a>
            @endforeach
            @foreach($cinv as $ci)
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{action('InviteController@showDecision',['defaultwid'=>$workspaceid,'defaultwname'=>$workspacename,'defaultch'=>$ch,'defaultde'=>$default,'sender'=>$ci->name,'senderid'=>$ci->id,'type'=>'ch','name'=>$ci->cname,'id'=>$ci->cid,'time'=>$ci->ictimedate])}}">
                <strong>{{$ci->name}}</strong>
                <span class="small float-right text-muted">{{$ci->ictimedate}}</span>
                <!--div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div-->
              </a>
            @endforeach
            @if(count($winv) === 0 && count($cinv) === 0)
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all Invitations</a>
            </div>
            @endif

        </li>

        <!-- Search Box#################################################################################-->
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>

        <!-- Log out button#################################################################################-->
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Message Chart ##############################################################################################-->

  <div class="content-wrapper">

      <div class="container-fluid">
      <!-- Message Section-->
        <div class="container" id="changesection">
        <div class="row">

        <div class="col-lg-12">
          <!-- Example Notifications Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-comment-o"></i> 
              <strong>{{$cname}}</strong>
            </div>
            <div class="list-group list-group-flush small" id = "messageBox">
              @if($message <> NULL)
                @foreach($message as $m)
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                    <div class="media-body">
                      <strong>{{$m->name}}</strong> {{$m->mtimedate}}
                      <!--strong>David Miller Website</strong-->.
                      <div class="text-muted smaller">{{$m->content}}</div>
                    </div>
                  </div>
                </a>
                @endforeach
              @endif
            </div>

            <!-- Post box ##############################################################################################-->
            <div class="card-header">
              <div class="form-group">
                <textarea class="form-control mb-3" rows="5" id="message" placeholder="Say something..."></textarea>
                <button class="btn btn-secondary btn-block" type="button" id="submit1">Post</button>
              </div>
            </div>
          </div>
        </div>
      </div>
        </div>


      <!-- Message Chart ##############################################################################################-->


    <!-- Scroll to Top Button ###########################################################################################-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a href="{{ url('/logout')}}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>
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

    <script type="text/javascript">
      $('#submit1').on('click',function() {
                var content = $('#message').val();
                var cid=$('#cid').val();
                var uid=$('#uid').val();
                $('#message').val("");
                 $.ajaxSetup({
                      headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                });
                $.ajax({
                  method:"GET",
                  url:"{{ url('home') }}/"+ uid + "/" + cid + "/" + content,
                  dataType:"html",
                  //async:false,
                  success: function(data){
                    //alert(data.Info);
                    $('#messageBox').html(data);
                    //window:window.location.href
                    //location.reload(true);
                    //document.URL=window.location.href;
                  }
                });
                
            });
      $('#changeWs').on('click',function(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              method:"GET",
              url:"{{ url('home') }}/"+ "changeworkspace",
              dataType:"html",
              success: function(data){
                $('#changesection').html(data);
              }
            });
      });

      $('#listusers').on('click',function () {
          var wid=$('#wid').val();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
          method:"GET",
          url:"{{ url('home') }}/"+ "listusrinfo/" + wid ,
          dataType:"html",
          success: function(data){
            $('#changesection').html(data);
          }
        });
      })
      </script>
      </div>
    </div>


</body>

</html>
