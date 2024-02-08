@extends('layouts.utama')
@section('menu_card')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-green">
                <li style="font-size:18px;">
                    <a href="{{ url('/dashboard') }}">
                        <i class="material-icons">home</i>
                        Dashboard Alarm Freezer - Medika
                    </a>
                </li>
            </ol>
        </div>
        <!-- Widgets -->
        <div class="row clearfix">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">ALARM SUHU</div>
                        <div class="number count-to" data-from="0" data-to="-20" data-speed="1000"
                            data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">ALARM PINTU</div>
                        <div class="number count-to" data-from="0" data-to="0" data-speed="1000"
                            data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">RESET ALL</div>
                        <div class="number count-to" data-from="0" data-to="0" data-speed="1000"
                            data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">ALARM EMERGENCY</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15"
                            data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Widgets -->
    </div>
</section>
@endsection

@section('konten')
<section class="content" style="margin-top: -130px;">
    <div class="container-fluid">
        @include('_partial.flash_message')




        <!-- Real-Time Chart -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="col-pink">REALTIME TEMPERATURE FREEZER DM11</h2>
                        <!-- <div class="pull-right">
                            <div class="switch panel-switch-btn">
                                <span class="m-r-10 font-12">REAL TIME</span>
                                <label>OFF<input type="checkbox" id="realtime" checked><span
                                        class="lever switch-col-cyan"></span>ON</label>
                            </div>
                        </div> -->
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="real_time_chart" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Real-Time Chart -->

        <!-- Real-Time Chart -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="col-pink">TEMPERATURE TRACKING</h2>

                        <div class="table-responsive" id="tbl_maintrack">
                            <table id="tbl_track"
                                class="table table-hover table-bordered table-striped table-responsive display nowrap"
                                style="width:100%">
                                <thead class="bg-interskala" width="100%">
                                    <tr>
                                        <th>No</th>
                                        <th>Suhu</th>
                                        <th>AP</th>
                                        <th>Status</th>
                                        <th>Date & Time</th>
                                        <th width="18%" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button type="button" id="btn_view" class="btn bg-blue waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </button>

                                            <button type="button" id="btn_update" class="btn bg-orange waves-effect">
                                                <i class="material-icons">border_color</i>
                                            </button>

                                            <button type="button" id="btn_delete" class="btn bg-beureum waves-effect">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- #END# Real-Time Chart -->


    </div>
    </div>
    </div>
</section>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////LIBRARY JS//////////////////////////////////////////////////// -->
<!-- Jquery Core Js -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Notify Plugin Js -->
<script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
<!-- Custom Js -->
<script src="{{URL::asset('js/pages/ui/notifications.js')}}"></script>
<script src="{{URL::asset('js/demo.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#tbl_track').DataTable();
    });

</script>




<script>
    $(document).ready(function () {
        $('#btn_status').click(function (event) {
            var el = document.getElementById('label_status');
            text = (el.innerText || el.textContent);

            alert(text);


        });
    });

</script>

<style>
    th {
        white-space: nowrap;
    }

    td {
        white-space: nowrap;
    }

    .table-bordered tbody tr th {
        padding: 5px;
        border: 1px solid #eee;
        font-family: 'Roboto', Arial, Tahoma, sans-serif;
    }

</style>


<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
