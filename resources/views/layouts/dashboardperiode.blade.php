@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                    {{-- {{ Session::get('status') }} --}}
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    @include('_partial.flash_message')


    <!-- row Informasi Saldo Biller -->
    <div class="row column1 social_media_section">
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons fb margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-comments-o"></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Complain</strong></span>
                        </li>
                        <li>
                            <span><strong>{{ $jumlahdatacomplain }}</strong></span>

                        </li>
                    </ul>
                    <ul>
                        <li>
                            <span>Open</span>
                        </li>
                        <li>
                            <span>{{ $jumlahdataopen_complain }}</span>
                        </li>
                    </ul><ul>
                        <li>
                            <span>Close</span>
                        </li>
                        <li>
                            <span>{{ $jumlahdataclose_complain }}</span>
                        </li>
                    </ul>
                </div>
                <center>
                    <button class="btn btn-primary" id="btn_periode" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 10px">
                        <i class="fa fa-calendar"></i> Periode
                    </button>
                    &nbsp;
                    <a href="{{ url('/dashboard') }}" class="btn btn-success" style="margin-left: 5px;margin-bottom: 10px"">
                        <i class="fa fa-refresh"></i> Refresh
                    </a>
                </center>
                <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <h5 class="card-title">Tanggal</h5>
                    <form action="{{ URL::asset('/dashboard/periodecomplain') }}" method="POST">
                        @csrf
                        Periode : 
                        <input  type="date" id="startDate" name="startDate" class="tm form-control" 
                        style="margin-left: 5px" placeholder="First Date" value="{{$first_date}}" required>
                        <center>-</center>
                        <input type="date" id="endDate" name="endDate" class="form-control"
                        style="margin-left: 5px" placeholder="Last Date" value="{{$last_date}}" required>
                                
                        Status :
                        <select id="status" name="status" class="form-control" style="margin-left: 5px" required>
                            <option value="all"> Pilih Status </option>
                            <option value="all" {{ $status == 'all' ? 'selected' : ''}}>All</option>
                            <option value="1" {{ $status == '1' ? 'selected' : ''}}>Open</option>
                            <option value="0" {{ $status == '0' ? 'selected' : ''}}>Close</option>
                        </select>
                
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary ml-2">
                                <i class="fa fa-gear"></i> Proses
                            </button>
                            <button type="submit" class="btn btn-primary ml-2" name="keperiode" formnovalidate>
                                <i class="fa fa-gear"></i> Tampilkan Data
                            </button>
                        </div>
                    </form> 
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons tw margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Request</strong></span>
                        </li>
                        <li>
                            <span><strong>{{ $jumlahdatarequest }}</strong></span>

                        </li>
                    </ul>
                    <ul>
                        <li>
                            <span>Open</span>
                        </li>
                        <li>
                            <span>{{ $jumlahdataopen_request }}</span>
                        </li>
                    </ul><ul>
                        <li>
                            <span>Close</span>
                        </li>
                        <li>
                            <span>{{ $jumlahdataclose_request }}</span>
                        </li>
                    </ul>
                </div>
                <center>
                    <button class="btn btn-primary" id="btn_periode" type="button" data-toggle="collapse" data-target="#collapseRequest" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 10px">
                        <i class="fa fa-calendar"></i> Periode
                    </button>
                    &nbsp;
                    <a href="{{ url('/dashboard') }}" class="btn btn-success" style="margin-left: 5px;margin-bottom: 10px"">
                        <i class="fa fa-refresh"></i> Refresh
                    </a>
                </center>
                <div class="collapse" id="collapseRequest">
                    <div class="card card-body">
                        <h5 class="card-title">Tanggal</h5>
                        <form action="{{ URL::asset('/dashboard/perioderequest') }}" method="POST">
                            @csrf
                            Periode : 
                            <input  type="date" id="startDate" name="startDate" class="tm form-control" 
                            style="margin-left: 5px" placeholder="First Date" value="{{$first_date}}" required>
                            <center>-</center>
                            <input type="date" id="endDate" name="endDate" class="form-control"
                            style="margin-left: 5px" placeholder="Last Date" value="{{$last_date}}" required>
                                    
                            Status :
                            <select id="status" name="status" class="form-control" style="margin-left: 5px" required>
                                <option value="all"> Pilih Status </option>
                                <option value="all" {{ $status == 'all' ? 'selected' : ''}}>All</option>
                                <option value="1" {{ $status == '1' ? 'selected' : ''}}>Open</option>
                                <option value="0" {{ $status == '0' ? 'selected' : ''}}>Close</option>
                            </select>
                    
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary ml-2">
                                    <i class="fa fa-gear"></i> Proses
                                </button>
                                <button type="submit" class="btn btn-primary ml-2" name="keperiode" formnovalidate>
                                    <i class="fa fa-gear"></i> Tampilkan Data
                                </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons linked margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-money"></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Saldo</strong></span>

                        </li>
                        
                        <span><strong>
                        </strong></span>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-file-text "></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Selisih</strong></span>

                        </li>
                        <li>
                            <span><strong>-</strong></span>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end row column1 -->

    <!-- Menu Mitra COmplaint & Request -->
    <div class="row column3">
        <!-- testimonial -->
        <div class="col-md-6">
            <div class="dark_bg full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Complaint & Request</h2>
                    </div>
                </div>
                <div class="full graph_revenue">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content testimonial">
                                <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <div class="item carousel-item active">
                                            <div class="img-box"><img
                                                    src="{{ URL::asset('public/images/logo/profile.png') }}" alt="">
                                            </div>
                                            <p class="testimonial">Test</p>
                                            <p class="overview"><b>Test</b>Test</p>
                                        </div>
                                        <div class="item carousel-item">
                                            <div class="img-box"><img
                                                    src="{{ URL::asset('public/images/logo/splashscreen-black.png') }}"
                                                    alt=""></div>
                                            <p class="testimonial">Test</p>
                                            <p class="overview"><b>Test</b>Test</p>
                                        </div>
                                        <div class="item carousel-item">
                                            <div class="img-box"><img
                                                    src="{{ URL::asset('public/images/logo/splashscreen.png') }}"
                                                    alt=""></div>
                                            <p class="testimonial">Test</p>
                                            <p class="overview"><b>Test</b>Test</p>
                                        </div>
                                    </div>
                                    <!-- Carousel controls -->
                                    <a class="carousel-control left carousel-control-prev" href="#testimonial_slider"
                                        data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control right carousel-control-next" href="#testimonial_slider"
                                        data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end testimonial -->
        <!-- progress bar -->
        <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Progress Bar</h2>
                    </div>
                </div>
                <div class="full progress_bar_inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress_bar">
                                <!-- Skill Bars -->
                                <span class="skill" style="width:73%;">Complaint Solved <span
                                        class="info_valume">73%</span></span>
                                <div class="progress skill-bar ">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                                        aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%;">
                                    </div>
                                </div>
                                <span class="skill" style="width:62%;">Request Provided <span
                                        class="info_valume">62%</span></span>
                                <div class="progress skill-bar">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                                        aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;">
                                    </div>
                                </div>
                                <span class="skill" style="width:54%;">Produk PLN PREPAID <span
                                        class="info_valume">54%</span></span>
                                <div class="progress skill-bar">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                                        aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">
                                    </div>
                                </div>
                                <span class="skill" style="width:82%;">Produk PLN POSTPAID <span
                                        class="info_valume">82%</span></span>
                                <div class="progress skill-bar">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped"
                                        role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 82%;">
                                    </div>
                                </div>
                                <span class="skill" style="width:48%;">PLN NON TAGLIS <span
                                        class="info_valume">48%</span></span>
                                <div class="progress skill-bar">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped"
                                        role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 48%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end progress bar -->
    </div>
    <!--  END Menu Mitra COmplaint & Request  -->
    </div>
    </div> <!-- end iiner container -->
    <script>
        $('#div_tanggal').hide(true);
        $('#btn_periode').click(function() {
            $('#div_tanggal').toggle("slow");
        });
    </script>
    
@endsection
