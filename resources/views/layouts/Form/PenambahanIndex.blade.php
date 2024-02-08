@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/checkbox/checkbox.css') }}">
@include('_partial.flash_message')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Header -->
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Laporan Penambahan Produk</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon ml-3" data-toggle="modal" data-target="#addPengajuan">
                <i class="fa fa-plus"></i> Add Laporan
            </button>&nbsp;
        </div><br>
    </div>
    
    <div class="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Tabel Data -->
    <div class="col-md-12">
        <div class="table-responsive-sm">
            <table class="table table-bordered table-hover table-striped" id="myTable">
                <thead class="bg-maroon">
                    <tr class="even">
                        <th scope="col">No</th>
                        <th scope="col">No. Penambahan Produk</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Penambahan Produk</th>
                        <th scope="col">Nama Pelapor</th>
                        <th scope="col">Jenis Produk</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parsed_json as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $value['no_laporan'] }}</td>
                        @if ($value['status'] == 1)
                            <td style="background-color: rgba(249, 38, 38, 0.285);">
                                <span style="color: #e93a4b; font-weight: bold;">OPEN</span>
                            </td>
                        @else
                            <td>
                                <span>CLOSE</span>
                            </td>
                        @endif
                        <td>{{ $value['tgl_laporan'] }}</td>
                        <td>{{ $value['nama_pelapor'] }}</td>
                        <td>{{ $value['jenis_produk'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgl="{{ $value['tgl_laporan'] }}"
                                    data-nama="{{ $value['nama_pelapor'] }}" data-jenis="{{ $value['jenis_produk'] }}" 
                                    data-detail="{{ $value['detail_laporan'] }}" data-status="{{ $value['status'] }}" 
                                    data-keterangan="{{ $value['ket_laporan'] }}" data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}"
                                    data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}" data-userinput="{{ $value['user_input'] }}"
                                    data-userupdate="{{ $value['user_update'] }}"
                                    data-data-produk="{{ json_encode($value['data_produk']) }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm" data-toggle="modal"
                                    data-target="#view_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgal="{{ $value['tgl_laporan'] }}"
                                    data-nama="{{ $value['nama_pelapor'] }}" data-jenis="{{ $value['jenis_produk'] }}"
                                    data-detail="{{ $value['detail_laporan'] }}" data-status="{{ $value['status'] }}" 
                                    data-keterangan="{{ $value['ket_laporan'] }}" data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}"
                                    data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}" data-userinput="{{ $value['user_input'] }}"
                                    data-userupdate="{{ $value['user_update'] }}"
                                    data-data-produk="{{ json_encode($value['data_produk']) }}">
                                    <i class="fa bi-info-circle"></i> View
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Tutup Container-fluid -->

    <!-- Modal Add User -->
    <div class="modal fade" id="addPengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Add Laporan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Laporan</label>
                            <input type="date" name="txt_tglpengajuan" id="txt_tglpengajuan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelapor</label>
                            <input type="text" name="txt_namapelapor" id="txt_namapelapor" class="form-control" required>
                        </div>
                        <div class="form-group" id="prosesGroup">
                            <label>Produk</label>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem">
                                        <input type="checkbox" value="PLN" name="txt_jenis[]">
                                        <span class="checkmark"></span>PLN
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm ">
                                        <input type="checkbox" value="LEASING" name="txt_jenis[]">
                                        <span class="checkmark"></span>LEASING
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm ">
                                        <input type="checkbox" value="PBB" name="txt_jenis[]">
                                        <span class="checkmark"></span>PBB
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem ">
                                        <input type="checkbox" value="PDAM" name="txt_jenis[]">
                                        <span class="checkmark"></span>PDAM
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm ">
                                        <input type="checkbox" value="PULSA ELEKTRIK" name="txt_jenis[]">
                                        <span class="checkmark"></span>PULSA ELEKTRIK
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm ">
                                        <input type="checkbox" value="TV BERBAYAR" name="txt_jenis[]">
                                        <span class="checkmark"></span>TV BERBAYAR
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem ">
                                        <input type="checkbox" value="TELKOM" name="txt_jenis[]">
                                        <span class="checkmark"></span>TELKOM
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm ">
                                        <input type="checkbox" value="PGN" name="txt_jenis[]">
                                        <span class="checkmark"></span>PGN
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm ">
                                        <input type="checkbox" value="LAINNYA" name="txt_jenis[]">
                                        <span class="checkmark"></span>LAINNYA...
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detail Laporan</label>
                            <textarea name="txt_detail" id="txt_detail" class="form-control" required></textarea>
                        </div>
                    </div>
                    <!-- ... existing code ... -->
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-warning text-white" id="btn_save">
                            <i class="fa fa-save"></i> Save
                        </button>
                        @else
                        <button type="button" class="btn btn-primary text-white" id="btn_gagal">
                            <i class="fa fa-save"></i> Save
                        </button>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <div class="text-center">
        <div class="spinner-border" role="status" id="loadingSpinner">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

    <!--Update Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Update Laporan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input</label>
                                    <input type="text" name="txt_tgljaminputmod" id="txt_tgljaminputmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Laporan</label>
                                    <input type="hidden" name="idmod" id="idmod">
                                    <input type="text" name="txt_nomod" id="txt_nomod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Laporan</label>
                                    <input type="text" name="txt_tglmod" id="txt_tglmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="txt_namamod" id="txt_namamod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Produk</label>
                                    <input type="text" name="txt_jenismod" id="txt_jenismod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="txt_userinputmod" id="txt_userinputmod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="txt_userupdatemod" id="txt_userupdatemod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="tambahaplikasi" data-toggle="modal"
                                data-target="#tambah_produk" class="btn btn-primary mb-2">Tambah Data</button>
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nama Produk</th>
                                      <th scope="col">Biller ID</th>
                                      <th scope="col">Switching / Biller</th>
                                      <th scope="col">Rp. Admin</th>
                                    </tr>
                                  </thead>
                                  <tbody id="produk_tbodymod">
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="txt_statusmod" id="txt_statusmod" class="form-control" required>
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detail Laporan</label>
                                    <textarea type="text" name="txt_detailmod" id="txt_detailmod" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan Laporan</label>
                                    <textarea type="text" name="txt_keteranganmod" id="txt_keteranganmod" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-warning text-white" id="btn_update">
                            <i class="fa fa-edit"></i> Update
                        </button>
                        @else
                        <button type="button" class="btn btn-primary text-white" id="btn_gagal">
                            <i class="fa fa-edit"></i> Update
                        </button>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--View Modal -->
    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        View Laporan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input</label>
                                    <input type="text" name="txt_tgljaminputview" id="txt_tgljaminputview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Laporan</label>
                                    <input type="hidden" name="idview" id="idview">
                                    <input type="text" name="txt_noview" id="txt_noview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Laporan</label>
                                    <input type="text" name="txt_tglview" id="txt_tglview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="txt_namaview" id="txt_namaview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Produk</label>
                                    <input type="text" name="txt_jenisview" id="txt_jenisview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="txt_userinputview" id="txt_userinputview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="txt_userupdateview" id="txt_userupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Update</label>
                                    <input type="text" name="txt_tgljamupdateview" id="txt_tgljamupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nama Produk</th>
                                      <th scope="col">Biller ID</th>
                                      <th scope="col">Switching / Biller</th>
                                      <th scope="col">Rp. Admin</th>
                                    </tr>
                                  </thead>
                                  <tbody id="produk_tbodyview">
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="txt_statusview" id="txt_statusview" class="form-control" required readonly>
                                    <input type="hidden" name="produk_data" id="produk_data" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detail Laporan</label>
                                    <textarea type="text" name="txt_detailview" id="txt_detailview" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan Laporan</label>
                                    <textarea type="text" name="txt_keteranganview" id="txt_keteranganview" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" id="cetak-pdf-link" target="_blank">Cetak PDF</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Add Aplikasi Modal -->
    <div class="modal fade" id="tambah_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Tambah Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/tambahProduk') }}" method="POST" id="tambah_produk">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="aplikasi_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Biller ID</th>
                                        <th scope="col">Switching / Biller</th>
                                        <th scope="col">Rp. Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="hidden" name="txt_idlaporanadd" id="txt_idlaporanadd" class="form-control">
                                                <input type="text" name="txt_namaprodukadd" id="txt_namaprodukadd" class="form-control"></td>
                                            <td><input type="text" name="txt_billeradd" id="txt_billeradd" class="form-control"></td>
                                            <td>
                                                <select name="txt_switchingadd" id="txt_switchingadd" class="form-control">
                                                    <option value="Not Selected"> Choose Switching</option>
                                                    @foreach ($dataswitching as $item)
                                                        <option value="{{ $item['kode_switching'] }}">{{ $item['kode_switching'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="txt_adminadd" id="txt_adminadd" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-primary text-white" id="btn_saveproduk">
                            <i class="fa fa-plus"></i> Add
                        </button>
                        @else
                        <button type="button" class="btn btn-primary text-white" id="btn_gagal">
                            <i class="fa fa-plus"></i> Add
                        </button>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Update Aplikasi Modal -->
    <div class="modal fade" id="update_produk_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Update Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/updateProduk') }}" method="POST" id="update_produk_modal">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Biller ID</th>
                                        <th scope="col">Switching / Biller</th>
                                        <th scope="col">Rp. Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <input type="hidden" name="txt_idlaporanmod" id="txt_idlaporanmod" class="form-control">
                                              <input type="text" name="txt_namaprodukmod" id="txt_namaprodukmod" class="form-control">
                                            </td>
                                            <td><input type="text" name="txt_billermod" id="txt_billermod" class="form-control"></td>
                                            <td><input type="text" name="txt_switchingmod" id="txt_switchingmod" class="form-control"></td>
                                            <td><input type="text" name="txt_adminmod" id="txt_adminmod" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-warning text-white" id="btn_updateproduk">
                            <i class="fa fa-edit"></i> Update
                        </button>
                        @else
                        <button type="button" class="btn btn-warning text-white" id="btn_gagalup">
                            <i class="fa fa-edit"></i> Update
                        </button>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Delete Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Delete Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_penambahan_produk/hapusProduk') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="txt_idlaporandlt" id="txt_idlaporandlt">
                                <h4>Hapus Produk?</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">
                            <i class="fa fa-minus-circle"></i> Delete
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="{{ URL::asset('public/js/index.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

   <script>
        $(document).ready(function() {
            $('#edit_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                id = btn.data('id'),
                no = btn.data('no'),
                tgl = btn.data('tgl'),
                nama = btn.data('nama'),
                jenis = btn.data('jenis'),
                detail = btn.data('detail'),
                status = btn.data('status'),
                keterangan = btn.data('keterangan'),
                tgljaminput = btn.data('tgljaminput'),
                userinput = btn.data('userinput'),
                userupdate = btn.data('userupdate'),
                dataproduk = btn.data('data-produk');
                var statusText = (status == 1) ? "OPEN" : "CLOSE";

                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#txt_nomod').val(no);
                $('#edit_modal').find('#txt_tglmod').val(tgl);
                $('#edit_modal').find('#txt_namamod').val(nama);
                $('#edit_modal').find('#txt_jenismod').val(jenis);
                $('#edit_modal').find('#txt_statusmod').val(status);
                $('#edit_modal').find('#txt_detailmod').val(detail);
                $('#edit_modal').find('#txt_keteranganmod').val(keterangan);
                $('#edit_modal').find('#txt_tgljaminputmod').val(tgljaminput);
                $('#edit_modal').find('#txt_userinputmod').val(userinput);
                $('#edit_modal').find('#txt_userupdatemod').val(userupdate);
                
                $('#tambah_produk').find('#txt_idlaporanadd').val(id);

                // Kosongkan tbody dan isi ulang dengan data update_aplikasi
                $('#produk_tbodymod').empty();

                for (var i = 0; i < dataproduk.length; i++) {
                    var updateItem = dataproduk[i];
                    var row = `
                        <tr>
                            <td>${updateItem.nama_produk_lim}</td>
                            <td>${updateItem.kode_produk_sw}</td>
                            <td>${updateItem.kode_switching}</td>
                            <td>${updateItem.biaya_admin}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btn-update" data-toggle="modal"
                                  data-target="#update_produk_modal" title="Update"
                                    data-id="${updateItem.id_produk}"
                                    data-namaproduk="${updateItem.nama_produk_lim}"
                                    data-kodproduk="${updateItem.kode_produk_sw}"
                                    data-kodesw="${updateItem.kode_switching}"
                                    data-biaya="${updateItem.biaya_admin}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                            </td> 
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                  data-target="#delete_modal" title="Delete"
                                    data-id="${updateItem.id_produk}">
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    $('#produk_tbodymod').append(row);
                }
            });
        });

        $(document).ready(function() {
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('id'),
                    no = btn.data('no'),
                    tgal = btn.data('tgal'),
                    nama = btn.data('nama'),
                    jenis = btn.data('jenis'),
                    detail = btn.data('detail'),
                    status = btn.data('status'),
                    keterangan = btn.data('keterangan'),
                    tgljaminput = btn.data('tgljaminput'),
                    tgljamupdate = btn.data('tgljamupdate'),
                    userinput = btn.data('userinput'),
                    userupdate = btn.data('userupdate'),
                    dataproduk = btn.data('data-produk');
                
                if (tgljamupdate === tgljaminput) {
                    $('#txt_tgljamupdateview').val("Belum Ada Update");
                } else {
                    $('#txt_tgljamupdateview').val(tgljamupdate);
                }
            
                var statusText = (status == 1) ? "OPEN" : "CLOSE";
                
                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#idview').val(id);
                $('#txt_noview').val(no);
                $('#txt_tglview').val(tgal);
                $('#txt_namaview').val(nama);
                $('#txt_jenisview').val(jenis);
                $('#txt_statusview').val(statusText);
                $('#txt_detailview').val(detail);
                $('#txt_keteranganview').val(keterangan);
                $('#txt_tgljaminputview').val(tgljaminput);
                $('#txt_userinputview').val(userinput);
                $('#txt_userupdateview').val(userupdate);

                // Kosongkan tbody dan isi ulang dengan data update_aplikasi
                $('#produk_tbodyview').empty();
                var produkData = [];
                for (var i = 0; i < dataproduk.length; i++) {
                    var updateItem = dataproduk[i];
                    var produkItem = {
                        nama_produk_lim: updateItem.nama_produk_lim,
                        kode_produk_sw: updateItem.kode_produk_sw,
                        kode_switching: updateItem.kode_switching,
                        biaya_admin: updateItem.biaya_admin
                    };
                    produkData.push(produkItem);
                    // Ubah data produk menjadi string JSON
                    var produkDataJSON = JSON.stringify(produkData);
                    // Isikan nilai produkDataJSON ke elemen input tersembunyi
                    document.getElementById('produk_data').value = produkDataJSON;
                    var row = `
                        <tr>
                            <td>${updateItem.nama_produk_lim}</td>
                            <td>${updateItem.kode_produk_sw}</td>
                            <td>${updateItem.kode_switching}</td>
                            <td>${updateItem.biaya_admin}</td>
                        </tr>
                    `;
                    $('#produk_tbodyview').append(row);
                }
            });
        });
        $(document).ready(function() {
            $('#update_produk_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('id'),
                    namaproduk = btn.data('namaproduk'),
                    kodproduk = btn.data('kodproduk'),
                    kodesw = btn.data('kodesw'),
                    biaya = btn.data('biaya');

                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#txt_idlaporanmod').val(id);
                $('#txt_namaprodukmod').val(namaproduk);
                $('#txt_billermod').val(kodproduk);
                $('#txt_switchingmod').val(kodesw);
                $('#txt_adminmod').val(biaya);
            });
            $('#delete_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('id');

                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#txt_idlaporandlt').val(id);
            });
        });


        // Event saat seluruh konten halaman selesai dimuat
        window.onload = function() {
            $(".loading-screen").hide();
        };

        $('#myTable').DataTable({
            "pageLength" : 50
        });

    $('#btn_save').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Anda Yakin Menyimpan?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
                if (result.isConfirmed) {
                    // Menampilkan loading screen saat tombol "Ya" ditekan
                    $(".loading-screen").show();

                    // Jeda sementara (simulasi loading)
                    setTimeout(function() {
                        // Jika user klik "Ya", submit the form for saving data
                        $('#addPengajuan form').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    $('#btn_update').click(function() {
        // Show SweetAlert2 confirmation modal for updating data
        Swal.fire({
            title: 'Yakin Mengubah Data?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                    // Menampilkan loading screen saat tombol "Ya" ditekan
                    $(".loading-screen").show();

                    // Jeda sementara (simulasi loading)
                    setTimeout(function() {
                        // Jika user klik "Ya", submit the form for saving data
                        $('#form_edit').submit();
                    }, 2000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    $('#btn_saveproduk').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Anda Yakin Menyimpan?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
                if (result.isConfirmed) {
                    // Menampilkan loading screen saat tombol "Ya" ditekan
                    $(".loading-screen").show();

                    // Jeda sementara (simulasi loading)
                    setTimeout(function() {
                        // Jika user klik "Ya", submit the form for saving data
                        $('#tambah_produk form').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });
    $('#btn_updateproduk').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Anda Yakin Menyimpan?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
                if (result.isConfirmed) {
                    // Menampilkan loading screen saat tombol "Ya" ditekan
                    $(".loading-screen").show();

                    // Jeda sementara (simulasi loading)
                    setTimeout(function() {
                        // Jika user klik "Ya", submit the form for saving data
                        $('#update_produk_modal form').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    $('#btn_gagal').click(function() {
        swal("Input Gagal!", "Anda Belum Login ", "error");
    });
    $('#btn_gagalup').click(function() {
        swal("Update Gagal!", "Anda Belum Login ", "error");
    });

    document.addEventListener('DOMContentLoaded', function() {
        var dateinput = document.getElementById('txt_tglpengajuan');
        
        // Mendapatkan tanggal saat ini
        var currentDate = new Date();
        
        // Mendapatkan string nilai tanggal dalam format "yyyy-mm-dd"
        var currentFormattedDate = currentDate.toISOString().slice(0, 10);
        
        // Set nilai tanggal saat ini ke input
        dateinput.value = currentFormattedDate;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tangkap elemen-elemen input dari modal
        var namaviewInput = document.getElementById('txt_namaview');
        var tglviewInput = document.getElementById('txt_tglview');
        var noviewInput = document.getElementById('txt_noview');
        var jenisviewInput = document.getElementById('txt_jenisview');
        var detailviewInput = document.getElementById('txt_detailview');
        var produk_data = document.getElementById('produk_data');
        // Ambil nilai-nilai dari elemen <td>
        var cetakPdfLink = document.getElementById('cetak-pdf-link');

        // Saat tautan "Cetak PDF" diklik
        cetakPdfLink.addEventListener('click', function (event) {
            event.preventDefault();
    
            // Ambil nilai-nilai dari input
            var namaviewValue = namaviewInput.value;
            var tglviewValue = tglviewInput.value;
            var noviewValue = noviewInput.value;
            var jenisviewValue = jenisviewInput.value;
            var detailviewValue = detailviewInput.value;
            var produk_dataval = produk_data.value;
    
            // Buat URL dengan parameter nilai
            var pdfUrl = "{{ route('PDFpenambahan', ['namaview' => 'PLACEHOLDER_NAMAVIEW', 'tglview' => 'PLACEHOLDER_TGLVIEW', 'noview' => 'PLACEHOLDER_NOVIEW', 'jenisview' => 'PLACEHOLDER_JENISVIEW', 'detailview' => 'PLACEHOLDER_DETAILVIEW', 'produk_data' => 'PLACEHOLDER_PRODUKDATA']) }}"
            .replace('PLACEHOLDER_NAMAVIEW', encodeURIComponent(namaviewValue))
            .replace('PLACEHOLDER_TGLVIEW', encodeURIComponent(tglviewValue))
            .replace('PLACEHOLDER_NOVIEW', encodeURIComponent(noviewValue))
            .replace('PLACEHOLDER_JENISVIEW', encodeURIComponent(jenisviewValue))
            .replace('PLACEHOLDER_DETAILVIEW', encodeURIComponent(detailviewValue))
            .replace('PLACEHOLDER_PRODUKDATA', encodeURIComponent(produk_dataval));

    
            // Buka tautan PDF di tab baru
            window.open(pdfUrl, '_blank');
        });
    });
</script>

    
@endsection