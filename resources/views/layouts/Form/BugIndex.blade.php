@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/checkbox/checkbox.css') }}">
@include('_partial.flash_message')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        #myTable {
        position: relative;
        z-index: 1; /* Atur z-index pada tabel untuk mengatur konteks stacking */
    }
    /* CSS untuk membuat kolom "Action" menempel */
    #myTable th:nth-child(15) {
        position: sticky;
        right: 0;
        background-color: #d81b60;
        z-index: 2; /* Pastikan nilai z-index lebih besar dari tabel untuk menghindari tumpang tindih dengan isi tabel */
    }
    #myTable td:nth-child(15) {
        position: sticky;
        right: 0;
        background-color: rgb(232, 231, 231);
        z-index: 2; /* Pastikan nilai z-index lebih besar dari tabel untuk menghindari tumpang tindih dengan isi tabel */
    }
    .modal-lg {
        max-width: 1140px;
    }
    .modal-m {
        max-width: 800px;
    }
    </style>
    <!-- Header -->
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Laporan Kesalahan Sistem</h2>
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
                        <th scope="col">No. Bug Report</th>
                        <th scope="col">Status Laporan</th>
                        <th scope="col">Tanggal Bug Report</th>
                        <th scope="col">Nama Pelapor</th>
                        <th scope="col">Jenis Modul</th>
                        <th scope="col">Proses Bug</th>
                        <th scope="col">Status Bug</th>
                        <th scope="col">Nama Pelapor Solving</th>
                        <th scope="col">Tanggal Terima Bug</th>
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
                        <td>{{ $value['jenis_modul'] }}</td>
                        <td>{{ $value['proses_bug'] }}</td>
                        <td>{{ $value['status_bug'] }}</td>
                        <td>{{ $value['nama_penerima_laporan'] }}</td>
                        <td>{{ $value['tgl_terima_laporan'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}" data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgl="{{ $value['tgl_laporan'] }}"
                                    data-nama="{{ $value['user_input'] }}" data-jenis="{{ $value['jenis_modul'] }}"
                                    data-proses="{{ $value['proses_bug'] }}" data-status="{{ $value['status_bug'] }}"
                                    data-statuslaporan="{{ $value['status'] }}" data-tglterima="{{ $value['tgl_terima_laporan'] }}"
                                    data-namapelaporsolving="{{ $value['nama_penerima_laporan'] }}" data-namaupdater="{{ $value['user_update'] }}"
                                    data-kronologis="{{ $value['ket_laporan'] }}" data-penyebab="{{ $value['ket_permasalahan'] }}"
                                    data-namapelapor="{{ $value['nama_pelapor'] }}"
                                    data-update-aplikasi="{{ json_encode($value['update_aplikasi']) }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm btn-view" data-toggle="modal"
                                    data-target="#view_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}" data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgl="{{ $value['tgl_laporan'] }}"
                                    data-nama="{{ $value['user_input'] }}" data-jenis="{{ $value['jenis_modul'] }}"
                                    data-proses="{{ $value['proses_bug'] }}" data-status="{{ $value['status_bug'] }}"
                                    data-statuslaporan="{{ $value['status'] }}" data-tglterima="{{ $value['tgl_terima_laporan'] }}"
                                    data-namapelaporsolving="{{ $value['nama_penerima_laporan'] }}" data-namaupdater="{{ $value['user_update'] }}"
                                    data-kronologis="{{ $value['ket_laporan'] }}" data-penyebab="{{ $value['ket_permasalahan'] }}"
                                    data-namapelapor="{{ $value['nama_pelapor'] }}"
                                    data-update-aplikasi="{{ json_encode($value['update_aplikasi']) }}">
                                    <i class="bi bi-info-circle"></i> View
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

    <!-- Modal Add -->
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
                <form action="{{ URL::asset('/form_bug/store') }}" method="POST">
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
                        <div class="form-group">
                            <label>Modul</label>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label>
                                        <input type="checkbox" value="PPOB" id="PPOB" name="modul[]">
                                        <span class="checkmark"></span>PPOB
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label>
                                        <input type="checkbox" value="PPOB ALFA" id="PPOBALFA" name="modul[]">
                                        <span class="checkmark"></span>PPOB ALFA
                                    </label>
                                </div>
                                <div class="container">
                                    <label>
                                        <input type="checkbox" value="H2H" id="H2H" name="modul[]">
                                        <span class="checkmark"></span>H2H
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="prosesGroup">
                            <label>Proses</label>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Transaksi" name="proses[]">
                                        <span class="checkmark"></span>Transaksi
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm hidden">
                                        <input type="checkbox" value="Transaksi" name="proses[]">
                                        <span class="checkmark"></span>Transaksi
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm hidden">
                                        <input type="checkbox" value="Transaksi" name="proses[]">
                                        <span class="checkmark"></span>Transaksi
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Saldo Loket" name="proses[]">
                                        <span class="checkmark"></span>Saldo Loket
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm hidden">
                                        <input type="checkbox" value="Web Akios" name="proses[]">
                                        <span class="checkmark"></span>Web Akios
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm hidden">
                                        <input type="checkbox" value="Saldo" name="proses[]">
                                        <span class="checkmark"></span>Saldo
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Saldo Mitra" name="proses[]">
                                        <span class="checkmark"></span>Saldo Mitra
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm hidden">
                                        <input type="checkbox" value="Rekonsiliasi" name="proses[]">
                                        <span class="checkmark"></span>Rekonsiliasi
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm hidden">
                                        <input type="checkbox" value="CRM" name="proses[]">
                                        <span class="checkmark"></span>CRM
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Web CRM" name="proses[]">
                                        <span class="checkmark"></span>Web CRM
                                    </label>
                                </div>
                                <div class="container mr-1">
                                    <label class=" prosesItemm hidden">
                                        <input type="checkbox" value="Web Monitoring" name="proses[]">
                                        <span class="checkmark"></span>Web Monitoring
                                    </label>
                                </div>
                                <div class="container">
                                    <label class=" prosesItemmm hidden">
                                        <input type="checkbox" value="Rekonsiliasi" name="proses[]">
                                        <span class="checkmark"></span>Rekonsiliasi
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Rekonsiliasi" name="proses[]">
                                        <span class="checkmark"></span>Rekonsiliasi
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Web Monitoring" name="proses[]">
                                        <span class="checkmark"></span>Web Monitoring
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="container mr-1">
                                    <label class=" prosesItem hidden">
                                        <input type="checkbox" value="Web Threasury" name="proses[]">
                                        <span class="checkmark"></span>Web Threasury
                                      </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kronologis Permasalahan</label>
                            <textarea name="txt_kronologis" id="txt_kronologis" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="container">
                                <input type="checkbox" value="Penambahan Fitur" name="status[]">
                                <span class="checkmark"></span>Penambahan Fitur (tidak terjadi kesalahan, hanya pengajuan penambahan fitur sistem)
                              </label>
                              
                              <label class="container">
                                <input type="checkbox" value="Informasi" name="status[]">
                                <span class="checkmark"></span>Informasi (tidak terjadi kesalahan, hanya informasi pemberitahuan)
                              </label>
                              
                              <label class="container">
                                <input type="checkbox" value="Peringatan" name="status[]">
                                <span class="checkmark"></span>Peringatan (terjadi kesalahan, namun masih ada solusi lainnya)
                              </label>
                              
                              <label class="container">
                                <input type="checkbox" value="Fatal Error" name="status[]">
                                <span class="checkmark"></span>Fatal Error (terjadi kesalahan fatal dan mempengaruhi terhadap data)
                              </label>
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
                <form action="{{ URL::asset('/form_bug/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input Laporan</label>
                                    <input type="text" name="txt_tgljaminputmod" id="txt_tgljaminputmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Bug</label>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="txt_namapelapormod" id="txt_namapelapormod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="txt_namamod" id="txt_namamod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="txt_namaupdatemod" id="txt_namaupdatemod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Modul</label>
                                    <input type="text" name="txt_modulmod" id="txt_modulmod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Proses</label>
                                    <input type="text" name="txt_prosesmod" id="txt_prosesmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Laporan</label>
                                    <select name="txt_statuslaporanmod" id="txt_statuslaporanmod" class="form-control" required>
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Bug</label>
                                    <input type="text" name="txt_statusbugmod" id="txt_statusbugmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kronologis Permasalahan</label>
                                    <textarea name="txt_kronologismod" id="txt_kronologismod" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pelapor Penyelesaian</label>
                                    <input type="text" name="txt_penyelesaimod" id="txt_penyelesaimod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Terima Bug</label>
                                    <input type="date" name="txt_tglterimamod" id="txt_tglterimamod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Penyebab Permasalahan</label>
                                    <textarea name="txt_penyebabmod" id="txt_penyebabmod" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="tambahaplikasi" data-toggle="modal"
                                data-target="#tambah_aplikasi" class="btn btn-primary mb-2">Tambah Data</button>
                                <table class="table table-striped" id="aplikasi_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nama Aplikasi</th>
                                        <th scope="col">Keterangan Perubahan Aplikasi</th>
                                        <th scope="col">Tanggal Solving</th>
                                        <th scope="col">Update Versi</th>
                                        <th scope="col">Tanggal Live</th>
                                        <th scope="col" colspan="3">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="aplikasi_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-warning text-white" id="btn_update">
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

    <!--Add Aplikasi Modal -->
    <div class="modal fade" id="tambah_aplikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Tambah Aplikasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_bug/tambahAplikasi') }}" method="POST" id="tambah_aplikasi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="aplikasi_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nama Aplikasi</th>
                                        <th scope="col">Keterangan Perubahan Aplikasi</th>
                                        <th scope="col">Tanggal Solving</th>
                                        <th scope="col">Update Versi</th>
                                        <th scope="col">Tanggal Live</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="txt_idlaporanadd" id="txt_idlaporanadd" class="form-control">
                                                <input type="text" name="txt_namaaplikasiadd" class="form-control"></td>
                                            <td><textarea name="txt_perubahanadd" class="form-control"></textarea></td>
                                            <td><input type="date" name="txt_tglsolvingadd" id="txt_tglsolvingadd" class="form-control"></td>
                                            <td><input type="text" name="txt_versiadd" class="form-control"></td>
                                            <td><input type="date" name="txt_tglliveadd" id="txt_tglliveadd" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-primary text-white" id="btn_saveaplikasi">
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
    <div class="modal fade" id="update_aplikasi_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Update Aplikasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_bug/updateAplikasi') }}" method="POST" id="update_aplikasi_modal">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nama Aplikasi</th>
                                        <th scope="col">Keterangan Perubahan Aplikasi</th>
                                        <th scope="col">Tanggal Solving</th>
                                        <th scope="col">Update Versi</th>
                                        <th scope="col">Tanggal Live</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <input type="hidden" name="txt_idlaporanmod" id="txt_idlaporanmod" class="form-control">
                                              <input type="text" name="txt_namaaplikasimod" id="txt_namaaplikasimod" class="form-control">
                                            </td>
                                            <td><textarea name="txt_perubahanmod" id="txt_perubahanmod" class="form-control"></textarea></td>
                                            <td><input type="date" name="txt_tglsolvingmod" id="txt_tglsolvingmod" class="form-control"></td>
                                            <td><input type="text" name="txt_versimod" id="txt_versimod" class="form-control"></td>
                                            <td><input type="date" name="txt_tgllivemod" id="txt_tgllivemod" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-warning text-white" id="btn_updateaplikasi">
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
                        Delete Aplikasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_bug/hapusAplikasi') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="txt_idlaporandlt" id="txt_idlaporandlt">
                                <h4>Hapus Aplikasi?</h4>
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
                <form>
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input Laporan</label>
                                    <input type="text" name="txt_tgljaminputview" id="txt_tgljaminputview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Bug</label>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="txt_namapelaporview" id="txt_namapelaporview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="txt_namaview" id="txt_namaview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="txt_namaupdateview" id="txt_namaupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Modul</label>
                                    <input type="text" name="txt_modulview" id="txt_modulview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Proses</label>
                                    <input type="text" name="txt_prosesview" id="txt_prosesview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Update Laporan</label>
                                    <input type="text" name="txt_tgljamupdateview" id="txt_tgljamupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Laporan</label>
                                    <input type="text" name="txt_statuslaporanview" id="txt_statuslaporanview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Bug</label>
                                    <input type="hidden" name="aplikasi_data" id="aplikasi_data" class="form-control" required readonly>
                                    <input type="text" name="txt_statusbugview" id="txt_statusbugview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kronologis Permasalahan</label>
                                    <textarea name="txt_kronologisview" id="txt_kronologisview" class="form-control" required readonly>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pelapor Penyelesaian</label>
                                    <input type="text" name="txt_penyelesaiview" id="txt_penyelesaiview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Terima Bug</label>
                                    <input type="text" name="txt_tglterimaview" id="txt_tglterimaview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Penyebab Permasalahan</label>
                                    <textarea name="txt_penyebabview" id="txt_penyebabview" class="form-control" required readonly>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="aplikasi_view">
                                    <thead>
                                      <tr>
                                        <th scope="col">Nama Aplikasi</th>
                                        <th scope="col">Keterangan Perubahan Aplikasi</th>
                                        <th scope="col">Tanggal Solving</th>
                                        <th scope="col">Update Versi</th>
                                        <th scope="col">Tanggal Live</th>
                                      </tr>
                                    </thead>
                                    <tbody id="viewaplikasi_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="dropdown show">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Print PDF
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="#" class="dropdown-item" id="cetak-pdf-link" target="_blank">Cetak Laporan</a>
                                <a href="#" class="dropdown-item" id="cetak-pdf-kosong" target="_blank">Cetak Form Solving</a>
                                <a href="#" class="dropdown-item" id="cetak-pdf-solved" target="_blank">Cetak Data Update</a>
                            </div>
                          </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                    tgljaminput = btn.data('tgljaminput'),
                    namapelapor = btn.data('namapelapor'),
                    nama = btn.data('nama'),
                    namaupdater = btn.data('namaupdater'),
                    modul = btn.data('jenis'),
                    proses = btn.data('proses'),
                    statuslaporan = btn.data('statuslaporan'),
                    statusbug = btn.data('status'),
                    kronologis = btn.data('kronologis'), // Mengganti data-detail menjadi data-kronologis
                    penyelesai = btn.data('namapelaporsolving'), // Mengganti data-namapelaporsolving menjadi data-penyelesaiview
                    penyebab = btn.data('penyebab'); // Mengganti data-keterangan menjadi data-penyebabview
                
                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#txt_nomod').val(no);
                $('#edit_modal').find('#txt_tglmod').val(tgl);
                $('#edit_modal').find('#txt_tgljaminputmod').val(tgljaminput);
                $('#edit_modal').find('#txt_namapelapormod').val(namapelapor);
                $('#edit_modal').find('#txt_namamod').val(nama);
                $('#edit_modal').find('#txt_namaupdatemod').val(namaupdater);
                $('#edit_modal').find('#txt_modulmod').val(modul);
                $('#edit_modal').find('#txt_prosesmod').val(proses);
                $('#edit_modal').find('#txt_statuslaporanmod').val(statuslaporan);
                $('#edit_modal').find('#txt_statusbugmod').val(statusbug);
                $('#edit_modal').find('#txt_kronologismod').val(kronologis);
                $('#edit_modal').find('#txt_penyelesaimod').val(penyelesai);
                $('#edit_modal').find('#txt_penyebabmod').val(penyebab);
                
                $('#tambah_aplikasi').find('#txt_idlaporanadd').val(id);

                var updateAplikasiData = btn.data('update-aplikasi'); // Ganti dengan sesuai properti data Anda

                // Kosongkan tbody dan isi ulang dengan data update_aplikasi
                $('#aplikasi_tbody').empty();

                for (var i = 0; i < updateAplikasiData.length; i++) {
                    var updateItem = updateAplikasiData[i];
                    var row = `
                        <tr>
                            <td>${updateItem.nama_aplikasi}</td>
                            <td>${updateItem.ket_perubahan_aplikasi}</td>
                            <td>${updateItem.tgl_solving}</td>
                            <td>${updateItem.update_versi}</td>
                            <td>${updateItem.tgl_live}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm btn-update" data-toggle="modal"
                                  data-target="#update_aplikasi_modal" title="Update"
                                    data-id="${updateItem.id_aplikasi}"
                                    data-nama="${updateItem.nama_aplikasi}"
                                    data-perubahan="${updateItem.ket_perubahan_aplikasi}"
                                    data-tglsolving="${updateItem.tgl_solving}"
                                    data-versi="${updateItem.update_versi}"
                                    data-tgllive="${updateItem.tgl_live}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                  data-target="#delete_modal" title="Delete"
                                    data-id="${updateItem.id_aplikasi}">
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    $('#aplikasi_tbody').append(row);
                }
            });
        });

        $(document).ready(function() {
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('id'),
                    no = btn.data('no'),
                    tgl = btn.data('tgl'),
                    tgljaminput = btn.data('tgljaminput'),
                    tgljamupdate = btn.data('tgljamupdate'),
                    namapelapor = btn.data('namapelapor'),
                    nama = btn.data('nama'),
                    namaupdater = btn.data('namaupdater'),
                    modul = btn.data('jenis'), // Mengganti data-proses menjadi data-modul
                    proses = btn.data('proses'),
                    statuslaporan = btn.data('statuslaporan'),
                    statusbug = btn.data('status'),
                    kronologis = btn.data('kronologis'), // Mengganti data-detail menjadi data-kronologis
                    penyelesai = btn.data('namapelaporsolving'), // Mengganti data-namapelaporsolving menjadi data-penyelesaiview
                    tglterima = btn.data('tglterima'),
                    penyebab = btn.data('penyebab'), // Mengganti data-keterangan menjadi data-penyebabview
                    updateAplikasiData = btn.data('update-aplikasi');;

                var statusText = (statuslaporan == 1) ? "OPEN" : "CLOSE";

                //Menampilkan keterangan BELUM ADA UPDATE jika data tidak memiliki value tgljamupdate
                if (tgljamupdate === tgljaminput) {
                    $('#txt_tgljamupdateview').val("Belum Ada Update");
                } else {
                    $('#txt_tgljamupdateview').val(tgljamupdate);
                }
                
                if (tglterima === tgl) {
                    $('#txt_tglterimaview').val("Belum Ada Update");
                } else {
                    $('#txt_tglterimaview').val(tglterima);
                }
                 
                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#idview').val(id);
                $('#txt_noview').val(no);
                $('#txt_tglview').val(tgl);
                $('#txt_tgljaminputview').val(tgljaminput);
                $('#txt_namapelaporview').val(namapelapor);
                $('#txt_namaview').val(nama);
                $('#txt_namaupdateview').val(namaupdater);
                $('#txt_modulview').val(modul);
                $('#txt_prosesview').val(proses);
                $('#txt_statuslaporanview').val(statusText);
                $('#txt_statusbugview').val(statusbug);
                $('#txt_kronologisview').val(kronologis);
                $('#txt_penyelesaiview').val(penyelesai);
                $('#txt_penyebabview').val(penyebab);

                // Kosongkan tbody dan isi ulang dengan data update_aplikasi
                $('#viewaplikasi_tbody').empty();
                var aplikasiData = []; // Buat array kosong

                for (var i = 0; i < updateAplikasiData.length; i++) {
                    var updateItem = updateAplikasiData[i];
                    var aplikasiItem = {
                        nama_aplikasi: updateItem.nama_aplikasi,
                        ket_perubahan_aplikasi: updateItem.ket_perubahan_aplikasi,
                        tgl_solving: updateItem.tgl_solving,
                        update_versi: updateItem.update_versi,
                        tgl_live: updateItem.tgl_live
                    };
                    aplikasiData.push(aplikasiItem);
                    // Ubah data produk menjadi string JSON
                    var aplikasiDataJSON = JSON.stringify(aplikasiData);
                    // Isikan nilai produkDataJSON ke elemen input tersembunyi
                    document.getElementById('aplikasi_data').value = aplikasiDataJSON;
                    var row = `
                        <tr>
                            <td>${updateItem.nama_aplikasi}</td>
                            <td>${updateItem.ket_perubahan_aplikasi}</td>
                            <td>${updateItem.tgl_solving}</td>
                            <td>${updateItem.update_versi}</td>
                            <td>${updateItem.tgl_live}</td>
                        </tr>
                    `;
                    $('#viewaplikasi_tbody').append(row);
                }
            });
        });
        $(document).ready(function() {
            $('#update_aplikasi_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('id'),
                    nama = btn.data('nama'),
                    perubahan = btn.data('perubahan'),
                    tglsolving = btn.data('tglsolving'),
                    versi = btn.data('versi'),
                    tgllive = btn.data('tgllive');

                // Mengisi nilai-nilai ke dalam input elemen modal
                $('#txt_idlaporanmod').val(id);
                $('#txt_namaaplikasimod').val(nama);
                $('#txt_perubahanmod').val(perubahan);
                $('#txt_tglsolvingmod').val(tglsolving);
                $('#txt_versimod').val(versi);
                $('#txt_tgllivemod').val(tgllive);
            });
        });
        $(document).ready(function() {
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
    
    $('#btn_saveaplikasi').click(function() {
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
                        $('#tambah_aplikasi form').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });
    $('#btn_updateaplikasi').click(function() {
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
                        $('#update_aplikasi_modal form').submit();
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

    $('#btn_gagal').click(function() {
        swal("Input Gagal!", "Anda Belum Login ", "error");
    });
    $('#btn_gagalup').click(function() {
        swal("Update Gagal!", "Anda Belum Login ", "error");
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        var dateinput1 = document.getElementById('txt_tglpengajuan');
        var dateinput2 = document.getElementById('txt_tglterimamod');
        var dateinput3 = document.getElementById('txt_tglsolvingmod');
        var dateinput4 = document.getElementById('txt_tgllivemod');
        var dateinput5 = document.getElementById('txt_tglsolvingadd');
        var dateinput6 = document.getElementById('txt_tglliveadd');
        
        // Mendapatkan tanggal saat ini
        var currentDate = new Date();
        
        // Mendapatkan string nilai tanggal dalam format "yyyy-mm-dd"
        var currentFormattedDate = currentDate.toISOString().slice(0, 10);
        
        // Set nilai tanggal saat ini ke input
        dateinput1.value = currentFormattedDate;
        dateinput2.value = currentFormattedDate;
        dateinput3.value = currentFormattedDate;
        dateinput4.value = currentFormattedDate;
        dateinput5.value = currentFormattedDate;
        dateinput6.value = currentFormattedDate;
    });
    
</script>
<script>
    document.getElementById("PPOB").addEventListener("change", function() {
      var prosesItems = document.querySelectorAll(".prosesItem");
    
      for (var i = 0; i < prosesItems.length; i++) {
        if (this.checked) {
          prosesItems[i].classList.remove("hidden");
        } else {
          prosesItems[i].classList.add("hidden");
        }
      }
    });
    document.getElementById("PPOBALFA").addEventListener("change", function() {
      var prosesItemm = document.querySelectorAll(".prosesItemm");
    
      for (var i = 0; i < prosesItemm.length; i++) {
        if (this.checked) {
            prosesItemm[i].classList.remove("hidden");
        } else {
            prosesItemm[i].classList.add("hidden");
        }
      }
    });
    document.getElementById("H2H").addEventListener("change", function() {
      var prosesItemmm = document.querySelectorAll(".prosesItemmm");
    
      for (var i = 0; i < prosesItemmm.length; i++) {
        if (this.checked) {
            prosesItemmm[i].classList.remove("hidden");
        } else {
            prosesItemmm[i].classList.add("hidden");
        }
      }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tangkap elemen-elemen input dari modal
        var txt_namapelaporview = document.getElementById('txt_namapelaporview');
        var txt_tglview = document.getElementById('txt_tglview');
        var txt_noview = document.getElementById('txt_noview');
        var txt_modulview = document.getElementById('txt_modulview');
        var txt_prosesview = document.getElementById('txt_prosesview');
        var txt_kronologisview = document.getElementById('txt_kronologisview');
        var txt_statusbugview = document.getElementById('txt_statusbugview');
        var cetakPdfLink = document.getElementById('cetak-pdf-link');
        
        // Saat tautan "Cetak PDF" diklik
        cetakPdfLink.addEventListener('click', function (event) {
            event.preventDefault();
    
            // Ambil nilai-nilai dari input
            var txt_namapelaporviewValue = txt_namapelaporview.value;
            var txt_tglviewValue = txt_tglview.value;
            var txt_noviewValue = txt_noview.value;
            var txt_modulviewValue = txt_modulview.value;
            var txt_prosesviewValue = txt_prosesview.value;
            var txt_kronologisviewValue = txt_kronologisview.value;
            var txt_statusbugviewValue = txt_statusbugview.value;
    
            // Buat URL dengan parameter nilai
            var pdfUrl = "{{ route('bugPDF', ['txt_namapelaporview' => 'PLACEHOLDER_NAMAVIEW', 'txt_tglview' => 'PLACEHOLDER_TGLVIEW', 'txt_noview' => 'PLACEHOLDER_NOVIEW', 'txt_modulview' => 'PLACEHOLDER_MODULVIEW', 'txt_prosesview' => 'PLACEHOLDER_PROSESVIEW', 'txt_kronologisview' => 'PLACEHOLDER_KRONOLOGISVIEW', 'txt_statusbugview' => 'PLACEHOLDER_STATUSVIEW']) }}"
            .replace('PLACEHOLDER_NAMAVIEW', encodeURIComponent(txt_namapelaporviewValue))
            .replace('PLACEHOLDER_TGLVIEW', encodeURIComponent(txt_tglviewValue))
            .replace('PLACEHOLDER_NOVIEW', encodeURIComponent(txt_noviewValue))
            .replace('PLACEHOLDER_MODULVIEW', encodeURIComponent(txt_modulviewValue))
            .replace('PLACEHOLDER_PROSESVIEW', encodeURIComponent(txt_prosesviewValue))
            .replace('PLACEHOLDER_KRONOLOGISVIEW', encodeURIComponent(txt_kronologisviewValue))
            .replace('PLACEHOLDER_STATUSVIEW', encodeURIComponent(txt_statusbugviewValue));
    
            // Buka tautan PDF di tab baru
            window.open(pdfUrl, '_blank');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tangkap elemen-elemen input dari modal
        var txt_noview = document.getElementById('txt_noview');
        var cetakPdfLink = document.getElementById('cetak-pdf-kosong');
        
        // Saat tautan "Cetak PDF" diklik
        cetakPdfLink.addEventListener('click', function (event) {
            event.preventDefault();
    
            // Ambil nilai-nilai dari input
            var txt_noviewValue = txt_noview.value;
    
            // Buat URL dengan parameter nilai
            var pdfUrl = "{{ route('bugkosongPDF', ['txt_noview' => 'PLACEHOLDER_NOVIEW']) }}"
            .replace('PLACEHOLDER_NOVIEW', encodeURIComponent(txt_noviewValue));
    
            // Buka tautan PDF di tab baru
            window.open(pdfUrl, '_blank');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tangkap elemen-elemen input dari modal
        var txt_namapelaporview = document.getElementById('txt_namapelaporview');
        var txt_tglview = document.getElementById('txt_tglview');
        var txt_noview = document.getElementById('txt_noview');
        var txt_penyebabview = document.getElementById('txt_penyebabview');
        var aplikasi_data = document.getElementById('aplikasi_data');
        var cetakPdfLink = document.getElementById('cetak-pdf-solved');
        
        // Saat tautan "Cetak PDF" diklik
        cetakPdfLink.addEventListener('click', function (event) {
            event.preventDefault();
    
            // Ambil nilai-nilai dari input
            var txt_namapelaporviewValue = txt_namapelaporview.value;
            var txt_tglviewValue = txt_tglview.value;
            var txt_noviewValue = txt_noview.value;
            var txt_penyebabviewValue = txt_penyebabview.value;
            var aplikasi_dataval = aplikasi_data.value;
    
            // Buat URL dengan parameter nilai
            var pdfUrl = "{{ route('bugsolvedPDF', ['txt_namapelaporview' => 'PLACEHOLDER_NAMAVIEW', 'txt_tglview' => 'PLACEHOLDER_TGLVIEW', 'txt_noview' => 'PLACEHOLDER_NOVIEW', 'txt_penyebabview' => 'PLACEHOLDER_PENYEBABVIEW', 'aplikasi_data' => 'PLACEHOLDER_APLIKASIDATA']) }}"
            .replace('PLACEHOLDER_NAMAVIEW', encodeURIComponent(txt_namapelaporviewValue))
            .replace('PLACEHOLDER_TGLVIEW', encodeURIComponent(txt_tglviewValue))
            .replace('PLACEHOLDER_NOVIEW', encodeURIComponent(txt_noviewValue))
            .replace('PLACEHOLDER_PENYEBABVIEW', encodeURIComponent(txt_penyebabviewValue))
            .replace('PLACEHOLDER_APLIKASIDATA', encodeURIComponent(aplikasi_dataval));
    
            // Buka tautan PDF di tab baru
            window.open(pdfUrl, '_blank');
        });
    });
</script>
    
@endsection