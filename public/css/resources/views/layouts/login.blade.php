<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Todolist</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{URL::asset('public/css/lim_material1.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('public/css/lim_material2.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('public/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{URL::asset('public/plugins/node-waves/waves.css')}}" rel="stylesheet" />
    <!-- Monsweet -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('public/js/monsweet/sweetalert2.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{URL::asset('public/js/monsweet/sweetalert2.min.css')}}" />


    <link type="text/css" rel="stylesheet" href="{{URL::asset('public/css/login/style_login.css')}}" />
    <style>
        .wadah-mengetik {
            font-size: 22px;
            width: 260px;
            white-space: nowrap;
            overflow: hidden;
            -webkit-animation: ketik 5s steps(50, end);
            animation: ketik 5s steps(50, end);
        }

        @keyframes ketik {
            from {
                width: 0;
            }
        }

        @-webkit-keyframes ketik {
            from {
                width: 0;
            }
        }

    </style>

</head>

<body>
    <div id="login-button">

        <img src="{{ URL::asset('public/images/icon_user.png') }}" alt="USER LOGIN PRODI"></img>
    </div>

    @include('_partial.flash_message')

    <div id="container">
        <img src="{{ URL::asset('public/images/logo_imi2.png') }}" alt="LOGIN PRODI">
        <h1 class="wadah-mengetik" style="font-size: 25px;">TASK MANAGEMENT</h1>
        <span class="close-btn">
            <img src="{{ URL::asset('public/images/close.png') }}" alt="CLOSE LOGIN">
        </span><br>


        {{Form::open(['url'=>'dashboard', 'class'=>'form-horizontal', 'id'=>'sign_in'])}}
        {{ csrf_field() }}

        <input type="text" class="form-control" name="txt_userid" placeholder="Username"
            style="font-size: 16px; font-weight: bold" required autofocus>

        <input type="password" class="form-control" name="txt_pass" placeholder="Password"
            style="font-size: 16px; font-weight: bold" required>


        <button class="btn btn-block waves-effect" type="submit" style="background-color:#E10220; color:white;">SIGN
            IN</button>
        <div id="remember-container">
            <!-- <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/>
            <span id="remember">Remember me</span> -->
            <span id="forgotten">
                <h5 class="text-primary" style="font-size: 14px; font-weight: bold">Forgotten password</h5>
            </span>
        </div>
        {{ Form::close() }}
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
        <h1>Forgotten</h1>
        <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
        </span>

        <form>
            <input type="email" name="email" placeholder="E-mail" style="font-size: 14px; font-weight: bold">
            <a href="#" class="orange-btn">Get new password</a>
        </form>

    </div>
    <!-- Jquery Core Js -->
    <script src="{{URL::asset('public/plugins/jquery/jquery.min.js')}}"></script>


    <script src="{{URL::asset('public/js/cloudfare/tweenmax.js')}}"></script>
    <script src="{{URL::asset('public/js/cloudfare/jquery213.js')}}"></script>

    <script src="{{URL::asset('public/js/index.js')}}"></script>
    <!-- ////////////////////////////////////// -->



    <!-- Bootstrap Core Js -->
    <script src="{{URL::asset('public/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{URL::asset('public/plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{URL::asset('public/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{URL::asset('public/js/admin.js')}}"></script>
    <script src="{{URL::asset('public/js/pages/examples/sign-in.js')}}"></script>

    <!--  monsweet -->
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.all.js')}}"></script>

</body>

</html>
