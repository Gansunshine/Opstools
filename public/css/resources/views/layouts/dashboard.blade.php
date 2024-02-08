@extends('layouts.utama')
@section('menu_card')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-pink">
                <li style="font-size:18px;"><a href="{{ url('/dashboard') }}"><i class="material-icons">home</i>
                        Dashboard Task Management - Mandiri</a></li>
            </ol>
        </div>

        <!-- Counter Examples -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-beureum hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content" id="btn_entryso">
                        <div class="text">Ice Box / Brainstrom</div>
                        <div class="number count-to" data-from="0" data-to="12" data-speed="2000"
                            data-fresh-interval="20"></div>

                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">widgets</i>
                    </div>
                    <div class="content" id="btn_relsales">
                        <div class="text">Backlog</div>
                        <div class="number count-to" data-from="0" data-to="44" data-speed="2000"
                            data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-brown hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">account_balance</i>
                    </div>
                    <div class="content" id="btn_accwho">
                        <div class="text">To Do</div>
                        <div class="number count-to" data-from="0" data-to="2" data-speed="2000"
                            data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <div class="content" id="btn_relwho">
                        <div class="text">In Progress / Doing</div>
                        <div class="number count-to" data-from="0" data-to="2" data-speed="2000"
                            data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">bookmark</i>
                    </div>
                    <div class="content" id="btn_acclog">
                        <div class="text">Pending</div>
                        <div class="number count-to" data-from="0" data-to="12" data-speed="1000"
                            data-fresh-interval="20">125</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-indigo hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">devices</i>
                    </div>
                    <div class="content" id="btn_rellog">
                        <div class="text">Blocked / Rejected</div>
                        <div class="number count-to" data-from="0" data-to="22" data-speed="1000"
                            data-fresh-interval="20">257</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">shopping_cart</i>
                    </div>
                    <div class="content" id="btn_assdriver">
                        <div class="text">Staging</div>
                        <div class="number count-to" data-from="0" data-to="1" data-speed="1000"
                            data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <div class="content" id="btn_ondelivery">
                        <!-- <a href="{{ url('/ondelivery-trx') }}"> -->
                        <div class="text">Done</div>
                        <div class="number count-to" data-from="0" data-to="1" data-speed="2000"
                            data-fresh-interval="20"></div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
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
                        <h2 class="col-pink">TASK TRACKING</h2>

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


        <!-- Large Size -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-beureum">
                        <h4 class="modal-title" id="largeModalLabel">NOTED STATUS</h4>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                        <button type="button" class="btn btn-link waves-effect bg-blue"
                            data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <!-- Visitors -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-pink">
                        <h3 align="center">PROJECT</h3>
                        <ul class="dashboard-stat-list">
                            <li>
                                #socialtrends
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>
                                #materialdesign
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>#adminbsb</li>
                            <li>#freeadmintemplate</li>
                            <li>#bootstraptemplate</li>
                            <li>
                                #freehtmltemplate
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>


            </div>
            <!-- #END# Visitors -->
            <!-- Latest Social Trends -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-cyan">
                        <h3 align="center">PRODUCT</h3>
                        <ul class="dashboard-stat-list">
                            <li>
                                #socialtrends
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>
                                #materialdesign
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                            <li>#adminbsb</li>
                            <li>#freeadmintemplate</li>
                            <li>#bootstraptemplate</li>
                            <li>
                                #freehtmltemplate
                                <span class="pull-right">
                                    <i class="material-icons">trending_up</i>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Latest Social Trends -->
            <!-- Answered Tickets -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <h3 align="center">CONSUMABLE</h3>
                        <ul class="dashboard-stat-list">
                            <li>
                                TODAY
                                <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                YESTERDAY
                                <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST WEEK
                                <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST MONTH
                                <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                LAST YEAR
                                <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                            </li>
                            <li>
                                ALL
                                <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Answered Tickets -->
        </div>

        <!-- Bar Chart -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="col-pink">HAVE BEEN COMPLETED</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!-- #END# Bar Chart -->
    </div>
    </div>
    </div>
</section>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////LIBRARY JS//////////////////////////////////////////////////// -->
<!-- Jquery Core Js -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>

<script src="{{URL::asset('js/Chart.js')}}"></script>
<!-- Bootstrap Notify Plugin Js -->
<script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
<!-- Custom Js -->
<script src="{{URL::asset('js/pages/ui/notifications.js')}}"></script>
<script src="{{URL::asset('js/demo.js')}}"></script>
<!-- Morris Plugin Js -->



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

<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Project", "Product", "Consumable", "Medika"],
            datasets: [{
                label: ' #Amount ',
                data: [6, 4, 3, 1, ],
                backgroundColor: [
                    'rgba(199,0,57)',
                    'rgba(55,71,159)',
                    'rgba(254,161,3)',
                    'rgba(76,175,80)'

                ],
                borderColor: [
                    'rgba(199,0,57,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(254,161,3, 1)',
                    'rgba(76,175,80, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
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
