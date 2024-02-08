@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Multibiller</h2>
                    <br>
                    <h2>Produk</h2>
                    </br>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row col-md-12 form-inline">
            <form action="{{ URL::asset('/compare_produk') }}" method="POST">
            @csrf
            </form>
        </div><br>
    </div>
    <div class="row">
        <div class="col-md-4" id="tanggal">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tanggal</h5>
                    <form action="{{ URL::asset('/compare_produk') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="txt_tanggalAdd">Keluhan</label>
                            <textarea name="txt_tanggalAdd" id="txt_tanggalAdd" rows="3" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-gear"></i> Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div><br>

    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover table-striped" id="myTable">
            <thead class="bg-maroon">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Lembar FTR</th>
            <th scope="col">Lembar Web</th>
            <th scope="col">Lembar Biller</th>
            <th scope="col">Jumlah FTR</th>
            <th scope="col">Jumlah WEB</th>
            <th scope="col">Jumlah Biller</th>
            <th scope="col">Selisih Lembar FTP WEB</th>
            <th scope="col">Selisih RPTAG FTP WEB</th>
            <th scope="col">Selisih Lembar FTP Biller</th>
            <th scope="col">Selisih Lembar RPTAG FTP Biller</th>
            <th scope="col">Selisih Lembar WEB Biller</th>
            <th scope="col">Selisih RPTAG WEB Biller</th>
            <!-- <th width="280px">Action</th> -->
        </tr>
        </thead>

        @foreach ($parsed_json as $value)
        <tr>
            <th scope="row">{{ $loop->iteration }} </th>
            <td>{{ $value['nama_produk_lim'] }}</td>
            <td>{{ $value['lembar_ftr'] }}</td>
            <td>{{ $value['lembar_web'] }}</td>
            <td>{{ $value['lbr_biller'] }}</td>
            <td>Rp. <?php echo number_format($value['amount_ftr'],2,',','.'); ?></td>
            <td>Rp. <?php echo number_format($value['amount_web'],2,',','.'); ?></td>
            <td>Rp. <?php echo number_format($value['amount_biller'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_lbr_ftp_web'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_rptag_ftp_web'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_lbr_ftp_biller'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_rptag_ftp_biller'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_lbr_web_biller'],2,',','.'); ?> </td>
            <td>Rp. <?php echo number_format($value['selisih_rptag_web_biller'],2,',','.'); ?> </td>
        </tr>
                @endforeach 
        </table>
    </div>
    
    {{-- Tutup Container-fluid --}}

<!-- M=======================================================================-->
<!-- M=======================================================================-->
<!-- M=======================================================================-->
<!-- M=======================================================================-->
<!-- M=======================================================================-->
<!-- Modal Add Complain -->
    <div class="modal fade" id="addTanggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        TANGGAL
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('compare_produk') }}" method="POST">
                    @csrf
                    <div class="form-group">
                            <label for="txt_tglAdd">Tanggal</label>
                            <input type="date" id="txt_tglAdd" name="txt_tglAdd" class="form-control">
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white" id="btn_save">
                            <i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->


@endsection