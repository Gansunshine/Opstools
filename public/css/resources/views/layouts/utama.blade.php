<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Main Page CRM</title>
    <!-- Favicon-->
    <link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <!--     <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

    <link href="{{URL::asset('css/lim_material1.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('css/lim_material2.css')}}" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Datattable Css -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('js/datatables/dataTables.bootstrap.css')}}" />

    <!-- Waves Effect Css -->
    <link href="{{URL::asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{URL::asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="{{ URL::asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ URL::asset('plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ URL::asset('plugins/jquery-spinner/css/bootstrap-spinner.css')}}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ URL::asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ URL::asset('plugins/nouislider/nouislider.min.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{URL::asset('plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{URL::asset('css/themes/all-themes.css')}}" rel="stylesheet" />

    <!-- Monsweet -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('js/monsweet/sweetalert2.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{URL::asset('js/monsweet/sweetalert2.min.css')}}" />

    <!-- Custom styles material-datetimepicker -->
    <link href="{{URL::asset('css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

    <!-- timepicker -->
    <!-- <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/> -->
    <!-- datereangetimepicker -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/daterangepicker.css')}}" />

    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/select2.css')}}" />

    <style>
        #divneon {
            padding: 1px;
        }

        .neon {
            text-align: center;
            margin: 1px auto;
            font-family: "Museo";
            text-transform: uppercase;
            color: #fff;
            text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #C30F42, 0 0 70px #C30F42, 0 0 80px #C30F42, 0 0 100px #C30F42, 0 0 150px #C30F42;
        }

        .wadah-mengetik {
            font-size: 22px;
            width: 900px;
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

<body class="theme-beureum">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Harap Tunggu...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <div id="divneon">
                    <a class="navbar-brand neon font-10 wadah-mengetik" href="#">To Do List - TASK MANAGEMENT - PRODI PT
                        INTERSKALA MANDIRI INDONESIA</a><br>
                </div>

            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i
                                class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown" id="btn_hide">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">visibility</i>
                            <span class="label-count"></span>
                        </a>

                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                                class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image" id="img-left-sidebar">
                    <img src="{{URL::asset('images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WELCOME
                        <br>{{ Session::get('userid') }} {{ Session::get('password') }} RAMON SHABO</div>
                    <!-- <div class="email">lim@layananimedia.com</div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li id="btn_hide"><a href="javascript:void(0);"><i class="material-icons">person</i>Hide</a>
                            </li>
                            <li role="seperator" class="divider"></li>
                            <li id="btn_logout"><a href="javascript:void(0);"><i class="material-icons">input</i>Sign
                                    Out</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="{{url('/dashboard-medika')}}">
                            <i class="material-icons" style="color:green">home</i>
                            <span style="color:green">Dashboard Medika</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{url('/dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard Mandiri</span>
                        </a>
                    </li>


                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Task Management</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    IceBox / Brainstrom <span class="badge bg-blue"><b class="col-white">1</b></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Backlog <span class="badge bg-blue"><b
                                            class="col-white">2</b></span></a>
                            </li>
                            <li>
                                <a href="{{ url('/region-trx') }}">To do <span class="badge bg-blue"><b
                                            class="col-white">3</b></span></a>
                            </li>
                            <li>
                                <a href="{{ url('/driver-trx') }}">In Progress / Doing <span class="badge bg-blue"><b
                                            class="col-white">4</b></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Pending <span class="badge bg-blue"><b
                                            class="col-white">5</b></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Blocked / Rejected <span class="badge bg-blue"><b
                                            class="col-white">6</b></span></a>
                            </li>
                            <li>
                                <a href="{{ url('/region-trx') }}">Staging <span class="badge bg-blue"><b
                                            class="col-white">7</b></span></a>
                            </li>
                            <li>
                                <a href="{{ url('/driver-trx') }}">Done <span class="badge bg-blue"><b
                                            class="col-white">8</b></span></a>
                            </li>
                        </ul>

                    </li>

                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">assignment</i>
                            <span>IceBox / Brainstrom</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>Backlog</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>To Do</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>In Progress / Doing</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>Pending</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>Blocked / Rejected</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>Staging</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">local_shipping</i>
                            <span>Done</span>
                        </a>
                    </li> -->

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class=" material-icons">assessment</i>
                            <span>Report Prodi</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('/driver-trx') }}">Periodic <span class="badge bg-blue"><b
                                            class="col-white">21</b></span></a>
                            </li>
                            <li>
                                <a href="{{ url('/software-download') }}">Work Plan <span class="badge bg-blue"><b
                                            class="col-white">9</b></span></a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>User Sistem</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('/add-user') }}/{{ Session::get('mitra_id') }}">Add New User</a>
                            </li>
                            <li>
                                <a
                                    href="{{ url('/change-user') }}/{{ Session::get('userid') }}/{{ Session::get('password') }}">Change
                                    Password</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/software-download') }}">
                            <i class=" material-icons">devices</i>
                            <span>Software Download</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/genlickey') }}">
                            <i class=" material-icons">enhanced_encryption</i>
                            <span>Genlickey (Aktivasi)</span>
                        </a>
                    </li>



                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2022 POWERED BY<a href="javascript:void(0);"> - PRODI TEAM</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>

    @yield('menu_card')
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////TEMPLATE YIELD CONTENT//////////////////////////////////////////////////// -->
    <!--
        /////////////////////////////////////////////////////////////////////////
        //////////     MAIN SHOW CONTENT     //////////
        //////////////////////////////////////////////////////////////////////
    -->
    <div id="main">

        <!--   <ol class="breadcrumb">
          @yield('breadcrumb')
      </ol> -->
        <!-- //breadcrumb-->

        <div id="content">
            @yield('konten')
        </div>
        <!-- //content-->
    </div>
    <!-- //main-->


    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////LIBRARY JS//////////////////////////////////////////////////// -->



    <!-- Jquery Core Js -->
    <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="{{URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

    <!-- Dropzone Plugin Js -->
    <script src="{{URL::asset('plugins/dropzone/dropzone.js')}}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{URL::asset('plugins/multi-select/js/jquery.multi-select.js')}}"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{URL::asset('plugins/node-waves/waves.js')}}"></script>


    <!-- Jquery CountTo Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{URL::asset('plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{URL::asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <!-- noUISlider Plugin Js -->
    <script src="{{URL::asset('plugins/nouislider/nouislider.js')}}"></script>

    <script src="{{URL::asset('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{URL::asset('plugins/morrisjs/morris.js')}}"></script>

    <script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>


    <!-- Flot Charts Plugin Js -->
    <script src="{{URL::asset('plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{URL::asset('js/admin.js')}}"></script>
    <script src="{{URL::asset('js/pages/index.js')}}"></script>
    <script src="{{URL::asset('js/pages/forms/advanced-form-elements.js')}}"></script>

    <script src="{{URL::asset('js/select2.js')}}"></script>

    <!-- jquery datepicker -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>



    <!-- {{-- data tables --}} -->
    <script src="{{URL::asset('js/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('js/datatables/dataTables.bootstrap.js')}}"></script>


    <!--  monsweet -->
    <script type="text/javascript" src="{{URL::asset('js/monsweet/sweetalert2.all.js')}}"></script>
    <!--  aktifbersih -->
    <script src="{{URL::asset('js/enab_disab.js')}}"></script>

    <script src="{{URL::asset('js/timepicker.js')}}"></script>

    <!-- format mata uang rupiah -->
    <script src="{{URL::asset('js/format_matauang.js')}}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{URL::asset('js/pages/ui/notifications.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{URL::asset('js/demo.js')}}"></script>






    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script>
        $('#btn_logout').click(function (event) {
            swal({
                title: 'Sure you want to sign out?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Sign Out !',
                cancelButtonText: 'No, Cancel !',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    window.open("{{ url('/logout') }}", '_self');

                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Batal Sign Out :)',
                        'error'
                    )
                }
            });
        });

    </script>

    <script>
        $('#btn_hide').click(function (event) {
            $('#leftsidebar').toggle(1000);
        });

    </script>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////PHP GET Redirect Passing Data//////////////////////////////////////////////////// -->
    <!-- ///////////////////////////////////  SUBMITRA  //////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////ANGULAR JS//////////////////////////////////////////////////// -->
    <!--  <script>
       //module
       var mod_crm = angular.module('crmApp',['ngRoute']);
   
       //route
       mod_crm.config(function($routeProvider){
           $routeProvider
           .when('/dashboard',{
               templateUrl : 'dashboard.php'
           })
   
           // .when('/addmitra',{
           //     templateUrl : 'mitra/v_add_mitra.php'
           // })
   
           .when('/mitra',{
               templateUrl : 'api/api_mitra/get_mitra.php'
           })
           .when('/topup-mitra',{
               templateUrl : 'mitra/v_topupmitra.php'
           })
           .when('/pinjaman-mitra',{
               templateUrl : 'mitra/v_pinjaman_mitra.php'
           })
           .when('/koreksi-mitra',{
               templateUrl : 'mitra/v_koreksi_topupmitra.php'
           })
           .when('/koreksi-pinjamanmitra',{
               templateUrl : 'mitra/v_koreksi_pinjamanmitra.php'
           })
   
           /////////////////////////////////////////////////////
           .when('/submitra',{
               templateUrl : 'api/api_submitra/get_submitra.php'
           })
           .when('/topup-submitra',{
               templateUrl : 'submitra/v_topup_submitra.php'
           })
           .when('/pinjaman-submitra',{
               templateUrl : 'submitra/v_pinjaman_submitra.php'
           })
           .when('/koreksi-submitra',{
               templateUrl : 'submitra/v_koreksi_topupsubmitra.php'
           })
            .when('/koreksi-pinjamansubmitra',{
               templateUrl : 'submitra/v_koreksi_pinjamansubmitra.php'
           })
   
           ////////////////////////////////////////////////////
           .when('/koor',{
               templateUrl : 'api/api_koordinator/get_koor.php'
           })
           .when('/topup-koor',{
               templateUrl : 'koordinator/v_topup_koor.php'
           })
           .when('/koreksi-koor',{
               templateUrl : 'koordinator/v_koreksi_koor.php'
           })
          
   
           .when('/koreksi-koor2',{
               templateUrl : 'koordinator/v_koreksi_koor.php?saldo='
                                
           })
           /////////////////////////////////////////////////////
           .otherwise({redirectTo : '/'})
       })
   </script> -->

    <script>
        function cektotal_order(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            // $.ajax({
            //      url: "",
            //      type: "GET"

            //  })
            //  .done(function(data) {
            //     console.log("success");

            //  })
            //  .fail(function() {
            //      console.log("error");

            //  })
            //  .always(function() {
            //      console.log("complete");
            //  });
        }

    </script>

    <meta name="_token" content="{!! csrf_token() !!}" />
</body>

</html>
