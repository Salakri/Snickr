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


    <style>
            /*web background*/
            .container{
                display:table;
                height:100%;
            }

            .row{
                display: table-cell;
                vertical-align: middle;
            }
            /* centered columns styles */
            .row-centered {
                text-align:center;
            }
            .col-centered {
                display:inline-block;
                float:none;
                text-align:left;
                margin-right:-4px;
            }
    </style>

</head>

<body class="bg-dark">
            <!--- one card #######################-->
        <div class="container">
            <div class="row row-centered">
                <div class ="col col-centered">
                <div class="card text-center mx-auto bg-light border-primary m-4 w-75" style="background-image:url('/img/bg.jpg')">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Workspace1</h5>
                    <a href="#" class="btn btn-secondary">Go to this workspace</a>
                    <p class="card-text"></p>
                </div>
                </div>

                <!--- end #######################-->
                <div class="card text-center mx-auto bg-light border-primary m-4 w-75" style="background-image:url('/img/bg.jpg')">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">Workspace1</h5>
                        <a href="#" class="btn btn-secondary">Go to this workspace</a>
                        <p class="card-text"></p>
                    </div>
                </div>
                <div class="card text-center mx-auto bg-light border-primary m-4 w-75" style="background-image:url('/img/bg.jpg')">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">Workspace1</h5>
                        <a href="#" class="btn btn-secondary">Go to this workspace</a>
                        <p class="card-text"></p>
                    </div>
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
