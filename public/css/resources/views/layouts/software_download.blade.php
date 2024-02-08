@extends('layouts.utama')
@section('menu_card')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-pink">
                <li style="font-size:18px;">
                    <a href="{{ url('/dashboard') }}">
                        <i class="material-icons">assignment_returned</i>
                        DOWNLOAD
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
                            LIST OF SOFTWARE
                            <!-- <small>With a bit of extra markup, it's possible to add any kind of HTML content like
                                headings, paragraphs, or buttons into thumbnails.</small> -->
                        </h4>

                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/alena-standar.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>Alena WB Standar</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/alena-multi.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>Alena Multi Indicator</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/alena-potongan.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>Alena WB + Potongan</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/aws.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>AWS Unmanned</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang I & II + Tap RFID, CAMERA PlateNo
                                                Recognition, FACE Recognition, Eksport Excel, Surat
                                                Timbang
                                            </li>
                                            <!-- <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li> -->
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div> <!--  tutup row pertamaa -->

                        <!-- Start row software ke2 -->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/ts7.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS SCALE TS7</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/tdi.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS SCALE Warehouse</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/isscale-ci200.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS SCALE CI200</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/isscale-cashdi.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS SCALE CAS HDI</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tutup row software ke2 -->

                        <!-- Start row software ke3 -->
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/iscube.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>ISCUBE Kubikasi</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/ismobile-x22.png')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS MOBILE X2</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>
                                            <li>
                                                Master (Barang, Supplier, Customer, Report, Surat Timbang)
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/x4.jpeg')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>IS MOBILE X4</h3>
                                        <ul type="square">
                                            <li>
                                                Software Jembatan timbang standar timbang I & II
                                            </li>

                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/software/x2api.jpeg')}}" class="img-responsive">
                                    <div class="caption">
                                        <h3>I-CLOUD PRO</h3>
                                        <ul type="square">
                                            <li>
                                                Software timbangan jarak jauh, Realtime via Cloud API
                                            </li>
                                        </ul>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect"
                                                role="button"><i class="material-icons">free_breakfast</i>
                                                <span>TRIAL</span></a>
                                            <a href="javascript:void(0);" class="btn bg-beureum waves-effect"
                                                role="button"><i class="material-icons">shopping_cart</i>
                                                <span>ORDER</span></a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tutup row software ke3 -->



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
<link rel="stylesheet" href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Notify Plugin Js -->
<script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}">
</script>
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
