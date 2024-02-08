<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>IT OPERATIONS | TOOLS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="{{ URL::asset('public/images/logo/profile.png') }}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ URL::asset('public/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ URL::asset('public/css/responsive.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap-select.css') }}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ URL::asset('public/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css') }}" />
    {{-- <link rel="stylesheet" href="{{ URL::asset('public/css/ramoncolors.min.css') }}" /> --}}
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>/* Add CSS for the loading screen */
        .loading-screen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.167);
            z-index: 9999;
        }
        
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid #fff;
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        </style>
</head>

<body class="dashboard dashboard_1">

    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="javascript:void()"><img class="logo_icon img-responsive" src="{{ URL::asset('public/images/logo/profile.png') }}"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive" src="{{ URL::asset('public/images/logo/profile.png') }}" alt="logo-lim" />
                            </div>
                            <div class="user_info">
                                <h6>Operational LIM</h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="sidebar_blog_2">
                    <h4>General</h4>
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="{{ URL('/dashboard') }}" id="dashboardLink" class="dashboard-link"><i class="fa fa-dashboard red_color"></i>
                                <span>Dashboard</span><!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#getDataReconcile" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-database orange_color"></i> <span>Get Data
                                    Reconcile</span></a>
                            <ul class="collapse list-unstyled" id="getDataReconcile">
                                <li><a href="{{ URL('/getdata_ftr') }}" class="refresh-link"><i class="fa fa-database orange_color"></i><span>Rekapitulasi Data FTR</span>
                                    <!-- Loading screen -->
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                                <li><a href="{{ URL('/getdata_web') }}" class="refresh-link"><i class="fa fa-database orange_color"></i> <span>Get Data WEB</span>
                                    <!-- Loading screen -->
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                                <li> <a href="{{ URL('rekapitulasi/biller') }}" class="refresh-link"><i class="fa fa-database orange_color"></i>
                                    <span>Rekapitulasi Data Biller</span>
                                    <!-- Loading screen -->
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div></a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#compare" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-object-group blue2_color"></i> <span>Compare</span></a>
                            <ul class="collapse list-unstyled" id="compare">
                                <li> <a href="{{ URL('compare/mitra') }}" class="refresh-link"><i class="fa fa-object-group blue2_color"></i>
                                        <span>Multibiller Mitra</span>
                                        <!-- Loading screen -->
                                        <div class="loading-screen">
                                            <div class="loading-spinner"></div>
                                        </div></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-object-group blue2_color"></i>
                                        <span>PLN</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-object-group blue2_color"></i>
                                        <span>PDAM</span></a></li>
                               
                            </ul>
                        </li>
                        
                        <li><a href="#reconcile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-table purple_color2"></i> <span>Reconcile</span></a>
                            <ul class="collapse list-unstyled" id="reconcile">
                                <li><a href="javascript:void(0)"><i class="fa fa-table purple_color2"></i> <span>Force
                                            Suspect</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-table purple_color2"></i>
                                        <span>Reconcile Multibiller</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-table purple_color2"></i>
                                        <span>Reconcile
                                            PLN</span></a></li>
                                <li> <a href="{{ URL('compare/produk') }}" class="refresh-link"><i class="fa fa-table purple_color2"></i>
                                        <span>Multibiller Produk</span></a></li>
                                <li> <a href="{{ URL('compare/recon') }}" class="refresh-link"><i class="fa fa-table purple_color2"></i>
                                        <span>Get Compare Reconcile</span>
                                        <!-- Loading screen -->
                                        <div class="loading-screen">
                                            <div class="loading-spinner"></div>
                                        </div></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#tools" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-gears white_color"></i> <span>Tools</span></a>
                            <ul class="collapse list-unstyled" id="tools">
                                <li><a href="javascript:void(0)"><i class="fa fa-gears white_color"></i> <span>Cek
                                            Log</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-gears white_color"></i> <span>Kroscek
                                            Data LIM</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-gears white_color"></i>
                                        <span>Labs</span></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-gears white_color"></i> <span>Selisih
                                            Saldo Harian</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ URL('/complain') }}" id="complainLink" class="complain-link">
                                <i class="fa fa-comments red_color"></i> <span>Complain</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                            </a>
                        </li>
                        
                        <!-- Form -->
                        <li>
                            <a href="#form" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-envelope" aria-hidden="true" style="color: Dodgerblue"></i>
                                <span>Form</span></a>
                            <ul class="collapse list-unstyled" id="form">
                                <li><a href="{{ URL('/form_pengajuan') }}" class="refresh-link"><i class="fa fa-envelope" aria-hidden="true" id="pengajuan" style="color: Dodgerblue"></i><span>Form Pengajuan</span>
                                    {{-- !-- Loading screen --> --}}
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                                <li><a href="{{ URL('/form_penambahan_produk') }}" class="refresh-link"><i class="fa fa-envelope" aria-hidden="true" id="penambahan" style="color: Dodgerblue"></i><span>Form Penambahan Produk</span>
                                    {{-- !-- Loading screen --> --}}
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                                <li><a href="{{ URL('/form_bug') }}" class="refresh-link"><i class="fa fa-envelope" aria-hidden="true" id="issues" style="color: Dodgerblue"></i><span>Form Bug Issues</span>
                                    {{-- !-- Loading screen --> --}}
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                            </ul>
                        </li>

                        <!-- Master data -->
                        <li>
                            <a href="#masterdata" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-database orange_color"></i> <span>Master Data</span></a>
                            <ul class="collapse list-unstyled" id="masterdata">
                                <li><a href="{{ URL('/getdata_produk') }}"><i  id="refresh-link" class="fa fa-database orange_color refresh-link"></i><span>Produk</span>
                                    {{-- !-- Loading screen --> --}}
                                    <div class="loading-screen">
                                        <div class="loading-spinner"></div>
                                    </div>
                                </a></li>
                                <li>
                                    <a href="{{ URL('/getdata_user') }}" id="refresh-link" class="refresh-link">
                                        <i class="fa fa-database orange_color refresh-link"></i> <span>User Management</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                                </a></li>
                                <li>
                                    <a href="{{ URL('/getdata_mitra') }}" id="refresh-link" class="refresh-link">
                                        <i class="fa fa-database orange_color refresh-link"></i> <span>Mitra</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                                </a></li>
                                <li>
                                    <a href="{{ URL('/getdata_agregator') }}" id="refresh-link" class="refresh-link">
                                        <i class="fa fa-database orange_color refresh-link"></i> <span>Agregator</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                                </a></li>
                                <li>
                                    <a href="{{ URL('/getdata_bank') }}" id="refresh-link" class="refresh-link">
                                        <i class="fa fa-database orange_color refresh-link"></i> <span>Bank</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                                </a></li>
                                <li>
                                    <a href="{{ URL('/getdata_switching') }}" id="refresh-link" class="refresh-link">
                                        <i class="fa fa-database orange_color refresh-link"></i> <span>Switching</span>
                                <!-- Loading screen -->
                                <div class="loading-screen">
                                    <div class="loading-spinner"></div>
                                </div>
                                </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="logo_section">
                                <!-- <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a> -->
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a>
                                        </li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                    class="img-responsive rounded-circle"
                                                    src="{{ URL::asset('public/images/layout_img/jew.png') }}" alt="User Profile" /><span
                                                    class="name_user">{{ Session::get('username') }}</span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ URL('getdata_user') }}">Settings</a>
                                                <a class="dropdown-item" href="{{ URL('logoutotomatis') }}"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->
                
                <!-- dashboard inner -->
                <div class="midde_cont">
                    @yield('content')
        

                </div>
                <!-- end dashboard inner -->
            </div>
        </div> <!-- end iiner container -->
        <!-- footer -->
        <div class="container-fluid">
            {{-- 
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0D6EFD" fill-opacity="1"
               d="M0,192L48,202.7C96,213,192,235,288,245.3C384,256,480,256,576,234.7C672,213,768,171,864,170.7C960,171,1056,213,1152,208C1248,203,1344,149,1392,122.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
         </svg> --}}
            <footer class="navbar-dark shadow-lg bg-blue1 text-white text-center p-3">Made with <svg
                    viewBox="0 0 1792 1792" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                    style="height: 0.8rem;">
                    <path
                        d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"
                        fill="#e25555"></path>
                </svg> By Layanan i-Media @2023</footer>
        </div>
        <!-- end footer -->

    </div> <!-- end full container -->

    <!-- jQuery -->
    <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>

    <!-- wow animation -->
    <script src="{{ URL::asset('public/js/animate.js') }}"></script>
    <!-- select country -->
    <script src="{{ URL::asset('public/js/bootstrap-select.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ URL::asset('public/js/owl.carousel.js') }}"></script>
    <!-- chart js -->
    <script src="{{ URL::asset('public/js/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/utils.js') }}"></script>
    <script src="{{ URL::asset('public/js/analyser.js') }}"></script>

    <!-- nice scrollbar -->
    <script src="{{ URL::asset('public/js/perfect-scrollbar.min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ URL::asset('public/js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Bind click event to the links with class "complain-link" or "dashboard-link"
            $(".complain-link, .dashboard-link, .refresh-link, .produk-link, .refresh-link").on("click", function(e) {
                e.preventDefault();
    
                // Show the loading screen
                $(this).find(".loading-screen").show();
    
                // Get the URL from the clicked link
                var linkUrl = $(this).attr("href");
                var form = $(this).closest("form");

    
                // Delay for a short period (e.g., 1 second) to simulate loading time
                setTimeout(function() {
                    // Navigate to the target page after the delay
                    window.location.href = linkUrl;
                }, 1000);
            });
        });
    </script>
    <script>
        let logoutTimer;

        function startLogoutTimer() {
            logoutTimer = setTimeout(function() {
                window.location.href = "{{ route('logoutotomatis') }}"; // Ganti dengan rute logout Anda
            }, 3600000); // 1 menit dalam milidetik
        }

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            startLogoutTimer();
        }

        // Panggil fungsi saat pengguna bergerak (misalnya, saat ada aktivitas mouse atau keyboard)
        document.addEventListener("mousemove", resetLogoutTimer);
        document.addEventListener("keypress", resetLogoutTimer);

        // Mulai timer ketika halaman dimuat
        startLogoutTimer();
    </script>


</html>