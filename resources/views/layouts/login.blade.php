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
    <!-- <link href="{{URL::asset('public/plugins/node-waves/waves.css')}}" rel="stylesheet" /> -->

    <!-- <link type="text/css" rel="stylesheet" href="public/css/login/style_login.css" /> -->
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    <style>
        html {
            /*background: url(http://cdn.magdeleine.co/wp-content/uploads/2014/05/3jPYgeVCTWCMqjtb7Dqi_IMG_8251-1400x933.jpg) no-repeat center center fixed; */
            background: url('public/images/bglogin.png') no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        img {
            display: block;
            margin: auto;
            width: 100%;
            height: auto;
        }

        #login-button {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 30px;
            margin: auto;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(3, 3, 3, .8);
            overflow: hidden;
            opacity: 0.4;
            box-shadow: 10px 10px 30px #000;
            display: none;
        }

        /* Login container */
        #container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 260px;
            height: 260px;
            border-radius: 5px;
            background: rgba(3, 3, 3, 0.25);
            box-shadow: 1px 1px 50px #000;
        }

        .close-btn {
            position: absolute;
            cursor: pointer;
            font-family: 'Open Sans Condensed', sans-serif;
            line-height: 18px;
            top: 3px;
            right: 3px;
            width: 20px;
            height: 20px;
            text-align: center;
            border-radius: 10px;
            opacity: .2;
            -webkit-transition: all 2s ease-in-out;
            -moz-transition: all 2s ease-in-out;
            -o-transition: all 2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        .close-btn:hover {
            opacity: .5;
        }

        /* Heading */
        h1 {
            font-family: 'Open Sans Condensed', sans-serif;
            position: relative;
            margin-top: 0px;
            text-align: center;
            font-size: 40px;
            color: #ddd;
            text-shadow: 3px 3px 10px #000;
        }

        /* Inputs */
        a,
        input {
            font-family: 'Open Sans Condensed', sans-serif;
            text-decoration: none;
            position: relative;
            width: 80%;
            display: block;
            margin: 9px auto;
            font-size: 17px;
            color: #000;
            padding: 8px;
            border-radius: 6px;
            border: none;
            background: rgba(3, 3, 3, .1);
            -webkit-transition: all 2s ease-in-out;
            -moz-transition: all 2s ease-in-out;
            -o-transition: all 2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        input:focus {
            outline: none;
            box-shadow: 3px 3px 10px #333;
            background: white;
        }

        /* Placeholders */
        ::-webkit-input-placeholder {
            color: #ddd;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            color: red;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: red;
        }

        :-ms-input-placeholder {
            color: #333;
        }

        /* Link */
        a {
            font-family: 'Open Sans Condensed', sans-serif;
            text-align: center;
            padding: 4px 8px;
            /*background: rgba(107,255,3,0.3);*/
            background: #875E3B
        }

        a:hover {
            opacity: 0.7;
        }

        #remember-container {
            position: relative;
            margin: -5px 20px;
        }

        .checkbox {
            position: relative;
            cursor: pointer;
            -webkit-appearance: none;
            padding: 5px;
            border-radius: 4px;
            background: rgba(3, 3, 3, .2);
            display: inline-block;
            width: 16px;
            height: 15px;
        }

        .checkbox:checked:active {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .checkbox:checked {
            background: rgba(3, 3, 3, .4);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05), inset 15px 10px -12px rgba(255, 255, 255, 0.5);
            color: #fff;
        }

        .checkbox:checked:after {
            content: '\2714';
            font-size: 10px;
            position: absolute;
            top: 0px;
            left: 4px;
            color: #fff;
        }

        #remember {
            position: absolute;
            font-size: 13px;
            font-family: 'Hind', sans-serif;
            color: rgba(255, 255, 255, .5);
            top: 7px;
            left: 20px;
        }

        #forgotten {
            position: absolute;
            font-size: 12px;
            font-family: 'Hind', sans-serif;
            color: rgba(255, 255, 255, .2);
            right: 0px;
            top: 8px;
            cursor: pointer;
            -webkit-transition: all 2s ease-in-out;
            -moz-transition: all 2s ease-in-out;
            -o-transition: all 2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        #forgotten:hover {
            color: rgba(255, 255, 255, .6);
        }

        #forgotten-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 260px;
            height: 180px;
            border-radius: 10px;
            background: rgba(3, 3, 3, 0.25);
            box-shadow: 1px 1px 50px #000;
            display: none;
        }

        .orange-btn {
            background: rgba(87, 198, 255, .5);
        }

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

        <img src="{{ URL::asset('public/images/icon_user.png') }}" alt="USER LOGIN OPERASIONAL"></img>
    </div>

    @include('_partial.flash_message')

    <div id="container">
        <img src="{{ URL::asset('public/images/logo_lim.png') }}" alt="LOGIN OPERASIONAL">
        <h1 class="wadah-mengetik" style="font-size: 20px;">OPERASIONAL TOOL</h1>
        <span class="close-btn">
            <img src="{{ URL::asset('public/images/close.png') }}" alt="CLOSE LOGIN">
        </span><br>


        {{Form::open(['url'=>'loginPost', 'class'=>'form-horizontal', 'id'=>'sign_in'])}}
        {{ csrf_field() }}

        <input type="text" class="form-control" name="txt_username" placeholder="Username"
            style="font-size: 16px; font-weight: bold" required autofocus>

        <input type="password" class="form-control" name="txt_password" placeholder="Password"
            style="font-size: 16px; font-weight: bold" required>


        <button class="btn btn-block waves-effect" type="submit" style="background-color:#E10220; color:white;">SIGN
            IN</button>
        <div id="remember-container">
            <!-- <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/>
            <span id="remember">Remember me</span> -->
            <span id="forgotten">
                <h5 class="text-primary" style="font-size: 14px; font-weight: bold">Reset Session</h5>
            </span>
        </div>
        {{ Form::close() }}
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
        <h1>Reset Session</h1>
        <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
        </span>

        <form action="{{ URL('logout') }}" method="POST">
            @csrf
            <input type="text" name="txt_username" placeholder="Your Username" style="font-size: 14px; font-weight: bold">
            <input type="password" name="txt_password" placeholder="Your Password" style="font-size: 14px; font-weight: bold">
            <button class="btn btn-block waves-effect" type="submit" style="background-color:#067981; color:white;">
                <i class="fas fa-undo"></i>Reset
            </button>
        </form>

    </div>
    <!-- Jquery Core Js -->
    <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>

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
    <script src="{{URL::asset('public/js/examples/sign-in.js')}}"></script>



</body>

</html>
