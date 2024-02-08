@extends('layouts.utama')
@section('menu_card')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-pink">
                <li style="font-size:18px;">
                    <a href="{{ url('/dashboard') }}">
                        <i class="material-icons">assignment_returned</i>
                        GENERATE LICENCE KEY
                    </a>
                </li>
            </ol>
        </div>
        <!-- Widgets -->
        <div class="row clearfix">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            </div>
            <!-- #END# Widgets -->
        </div>
</section>
@endsection

@section('konten')
<section class="content" style="margin-top: -130px;">
    <div class="container-fluid">
        @include('_partial.flash_message')


        <!-- Custom Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="col-blue">
                            AKTIVASI -->
                            <a href="https://rndinterscales.com/aktivasi/"> Klik disini</a>
                            <!-- <small>With a bit of extra markup, it's possible to add any kind of HTML content like
                                headings, paragraphs, or buttons into thumbnails.</small> -->
                        </h4>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                <div class="panel-group full-body" id="accordion_19" role="tablist"
                                    aria-multiselectable="true">
                                    <div class="panel panel-col-pink">
                                        <div class="panel-heading" role="tab" id="headingOne_19">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_19"
                                                    aria-expanded="true" aria-controls="collapseOne_19">
                                                    <i class="material-icons">perm_contact_calendar</i> Aktivasi ID PC /
                                                    Laptop #1
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne_19">
                                            <div class="panel-body">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="txt_kodemitra">Serial Number</label>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                                                    <div class="form-line">
                                                        <input type="text" name="txt_sono" id="txt_sono"
                                                            class="form-control" required="required"
                                                            style="text-transform:uppercase" value=""> <br>
                                                        <button type="submit" id="btn_update"
                                                            class="btn bg-blue waves-effect">
                                                            <i class="material-icons">save</i>
                                                            <span>Proses</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-col-cyan">
                                        <div class="panel-heading" role="tab" id="headingTwo_19">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapseTwo_19" aria-expanded="false"
                                                    aria-controls="collapseTwo_19">
                                                    <i class="material-icons">cloud_download</i> Aktivasi MAC ADDRESS #2
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo_19" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingTwo_19">
                                            <div class="panel-body">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="txt_kodemitra">Serial Number</label>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                                                    <div class="form-line">
                                                        <input type="text" name="txt_sono" id="txt_sono"
                                                            class="form-control" required="required"
                                                            style="text-transform:uppercase" value=""> <br>
                                                        <button type="submit" id="btn_update"
                                                            class="btn bg-blue waves-effect">
                                                            <i class="material-icons">save</i>
                                                            <span>Proses</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident.
                                                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table,
                                                raw denim aesthetic synth nesciunt you probably haven't heard of them
                                                accusamus labore sustainable VHS. -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-col-teal">
                                        <div class="panel-heading" role="tab" id="headingThree_19">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapseThree_19" aria-expanded="false"
                                                    aria-controls="collapseThree_19">
                                                    <i class="material-icons">contact_phone</i> Collapsible Item
                                                    #3
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree_19" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingThree_19">
                                            <div class="panel-body">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-col-orange">
                                        <div class="panel-heading" role="tab" id="headingFour_19">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapseFour_19" aria-expanded="false"
                                                    aria-controls="collapseFour_19">
                                                    <i class="material-icons">folder_shared</i> Collapsible Item
                                                    #4
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour_19" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingFour_19">
                                            <div class="panel-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Custom Content -->


    </div>
    </div>
    </div>
</section>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////LIBRARY JS//////////////////////////////////////////////////// -->
<!-- Jquery Core Js -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{URL::asset('plugins/morrisjs/morris.js')}}"></script>

<script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>

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
