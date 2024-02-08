@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
@include('_partial.flash_message')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    /* CSS untuk membuat kolom "Action" menempel */
    #myTable th:nth-child(14) {
        position: sticky;
        right: 0;
        background-color: #d81b60;
        z-index: 2; /* Pastikan nilai z-index lebih besar dari tabel untuk menghindari tumpang tindih dengan isi tabel */
    }
    #myTable td:nth-child(14) {
        position: sticky;
        right: 0;
        background-color: rgb(232, 231, 231);
        z-index: 2; /* Pastikan nilai z-index lebih besar dari tabel untuk menghindari tumpang tindih dengan isi tabel */
    }
    /* CSS untuk membuat elemen sticky hanya di dalam tabel */
    #myTable {
        position: relative;
        z-index: 1; /* Atur z-index pada tabel untuk mengatur konteks stacking */
    }
</style>
    
    <!-- Header -->
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Complain</h2>
                </div>
            </div>
        </div>
    
        <form action="{{ URL::asset('/complain/periode') }}" method="POST" id="complainForm">
            @csrf
            <div class="row">
                <div class="form-group ml-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn bg-maroon mb-2 btn-block" data-toggle="modal" data-target="#addComplain">
                        <i class="fa fa-plus"></i> Add Complain
                    </button>
                </div> 
                <div class="form-group ml-2">
                    <label for="periode">Periode:</label>
                    <select id="periode" name="periode" class="form-control" required>
                        <option value="none">Select Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_week">Minggu Lalu</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="last_year">Tahun Lalu</option>
                        <option value="all">Semua Periode</option>
                    </select>
                </div>
                <div class="form-group ml-2">
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" class="form-control" placeholder="First Date">
                </div>
                <div class="form-group ml-2">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate" class="form-control" placeholder="Last Date">
                </div>
                <div class="form-group ml-2">
                    <label for="kategori">Kategori:</label>
                    <!-- Mengambil Data Dari Complain -->
                <select id="kategori" name="kategori" class="form-control" style="margin-left: 5px" required>
                    <option value="all"> Pilih Kategori </option>
                    <option value="all" {{ $kategori == 'all' ? 'selected' : ''}}>All</option>
                    <option value="complain" {{ $kategori == 'complain' ? 'selected' : ''}}>Complain</option>
                    <option value="request" {{ $kategori == 'request' ? 'selected' : ''}}>Request</option>
                </select>
                </div>
                <div class="form-group ml-2">
                    <label for="status">Status:</label>
                    <!-- Mengambil Data Dari Complain -->
                    <select id="status" name="status" class="form-control" required>
                        <option value="all">Pilih Status</option>
                        <option value="all">All</option>
                        <option value="1" selected>Open</option>
                        <option value="0">Close</option>
                    </select>
                </div>
                <div class="form-group ml-2">
                    <label for="klasifikasi">Klasifikasi:</label>
                    <select id="klasifikasi" name="klasifikasi" class="form-control" required>
                        <option value="all">Pilih Klasifikasi</option>
                        <option value="all">All</option>
                        @foreach ($dataKlasifikasi as $value )
                            <option value="{{ $value['klasifikasi_complain'] }}">{{ $value['klasifikasi_complain'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ml-2">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-gear"></i> Proses
                    </button>
                </div> 
        </form>
                <div class="form-group ml-2">
                    <label>&nbsp;</label>
                    <form action="{{ URL::asset('/complain/downloadkategori') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="kategori_print" value="{{$kategori}}">
                        <button class="btn btn-primary">
                            <i class="fa fa-download"></i> Print
                        </button>
                    </form>
                </div>
                <div class="form-group ml-2">
                    <label>&nbsp;</label>
                    <a href="{{ url('/complain') }}" id="refreshLink" class="btn btn-success btn-block refresh-link">
                        <i class="fa fa-refresh"></i> Refresh
                        <div class="loading-screen">
                            <div class="loading-spinner"></div>
                        </div>
                    </a>
                </div>
            </div>
    </div>

    <!-- Tabel Data -->
    <div class="col-md-12">
        <div class="table-responsive-sm">
            <table class="table table-bordered table-hover table-striped" id="myTable">
                <thead class="bg-maroon">
                    <tr class="even">
                        <th scope="col" class="text-center">Action</th>
                        <th scope="col">No</th>
                        <th scope="col">No Tiketing</th>
                        <th scope="col">Status</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mitra</th>
                        <th scope="col">Klasifikasi</th>
                        <th scope="col">Requester</th>
                        <th scope="col">Order By</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- Isi tabel dengan data -->
                    @foreach ($parsed_json as $value)
                    <tr>
                        <td class="d-flex justify-content-around p-1">
                            <div class="btn-group mr-0" role="group">
                                <button type="button" class="btn btn-info btn-sm text-white mr-2" 
                                        data-toggle="modal" data-target="#view_modal" 
                                        data-notiketing="{{ $value['no_tiketing'] }}" data-tgljam="{{ $value['tgl_jam_input'] }}" 
                                        data-update="{{ $value['tgl_jam_update'] }}" data-tgllaporan="{{ $value['tgl_laporan'] }}" 
                                        data-jamlaporan="{{ $value['jam_laporan'] }}" data-mitra="{{ $value['kode_mitra'] }}" 
                                        data-periode="{{ $value['periode_complain'] }}" data-keluhan="{{ $value['keluhan'] }}" 
                                        data-solving="{{ $value['solving'] }}" data-kategori="{{ $value['kategori'] }}" 
                                        data-klasifikasi="{{ $value['klasifikasi'] }}" data-status="{{ $value['status'] }}" 
                                        data-userinput="{{ $value['user_input'] }}" data-userupdate="{{ $value['user_update'] }}" 
                                        data-requester="{{ $value['requester'] }}" data-order="{{ $value['order_by'] }}" 
                                        data-userid="{{ Session::get('username') }}">
                                    <i class="bi bi-info-circle"></i> View
                                </button>
                                <button type="button" class="btn btn-warning btn-sm text-white" 
                                        data-toggle="modal" data-target="#edit_modal" 
                                        data-tgljam="{{ $value['tgl_jam_input'] }}" data-userinput="{{ $value['user_input'] }}"
                                        data-idcomplain="{{ $value['id_complain'] }}" data-mitra="{{ $value['kode_mitra'] }}" 
                                        data-keluhan="{{ $value['keluhan'] }}" data-solving="{{ $value['solving'] }}" 
                                        data-kategori="{{ $value['kategori'] }}" data-klasifikasi="{{ $value['klasifikasi'] }}" 
                                        data-status="{{ $value['status'] }}" data-userid="{{ Session::get('username') }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </div>
                        </td>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['no_tiketing'] }}</td>
                        @if ($value['status'] == 1)
                            <td style="background-color: rgba(249, 38, 38, 0.285);">
                                <span style="color: #e93a4b; font-weight: bold;">OPEN</span>
                            </td>
                        @else
                            <td>
                                <span>CLOSE</span>
                            </td>
                        @endif
                        <td class="text-truncate">{{ $value['kategori'] }}</td>
                        <td class="text-truncate">{{ $value['tgl_laporan'] }}</td>
                        <td class="text-truncate">{{ $value['jam_laporan'] }}</td>
                        <td class="text-truncate">{{ $value['kode_mitra'] }}</td>
                        <td class="text-truncate">{{ $value['klasifikasi'] }}</td>
                        <td class="text-truncate">{{ $value['requester'] }}</td>
                        <td class="text-truncate">{{ $value['order_by'] }}</td>                                     
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>
    </div>
    <!-- Tutup Container-fluid -->

    <!-- Modal Add Complain -->
    <div class="modal fade" id="addComplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Add Complain
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/complain') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="txt_mitraAdd">Kode Mitra</label>
                            <select id="txt_mitraAdd" name="txt_mitraAdd" class="form-control" required>
                                <option> Choose Mitra </option>
                                @foreach ($dataMitra as $value )
                                <option value="{{ $value['kode_link_dbmitra'] }}">{{ $value['kode_link_dbmitra'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_tglAdd">Tanggal Laporan</label>
                            <input type="date" id="txt_tglAdd" name="txt_tglAdd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_jamAdd">Jam Laporan</label>
                            <input type="time" id="txt_jamAdd" name="txt_jamAdd" class="form-control" required> 
                        </div>
                        <div class="form-group">
                            <label for="txt_requesterAdd">Requester</label>
                            <input type="text" id="txt_requesterAdd" name="txt_requesterAdd" class="form-control" required> 
                        </div>
                        <div class="form-group">
                            <label for="txt_orderAdd">Order By</label>
                            <select id="txt_orderAdd" name="txt_orderAdd" class="form-control" required>
                                <option> Choose Order </option>
                                <option value="WA1">WA 1</option>
                                <option value="WA2">WA 2</option>
                                <option value="WAGRUP1">WA GRUP 1</option>
                                <option value="WAGRUP2">WA GRUP 2</option>
                                <option value="EMAIL">EMAIL</option>
                                <option value="BY PHONE">BY PHONE</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="txt_kategoriAdd">Kategori</label>
                        <select id="txt_kategoriAdd" name="txt_kategoriAdd" class="form-control" required>
                            <option> Choose Kategori </option>
                            <option value="complain">complain</option>
                            <option value="request">request</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txt_klasifikasiAdd">Klasifikasi</label>
                        <select id="txt_klasifikasiAdd" name="txt_klasifikasiAdd" class="form-control" required>
                            <option> Choose Klasifikasi </option>
                            @foreach ($dataKlasifikasi as $value )
                            <option value="{{ $value['klasifikasi_complain'] }}">{{ $value['klasifikasi_complain'] }}</option>
                            @endforeach
                        </select>
                    </div>                      
                    <div class="form-group">
                        <label for="txt_keluhanAdd">Keluhan</label>
                        <textarea name="txt_keluhanAdd" id="txt_keluhanAdd" rows="3" class="form-control" required></textarea>
                    </div>
                </div>
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

    <!-- Modal download  -->
    <div class="modal fade" id="downloadComplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Download Complain Periode
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/complain/downloadperiode') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="txt_startdate">Tanggal Laporan</label>
                            <input type="date" id="txt_startdate" name="txt_startdate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_enddate">Tanggal Laporan</label>
                            <input type="date" id="txt_enddate" name="txt_enddate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_kategoriprnt">Kategori</label>
                            <select id="txt_kategoriprnt" name="txt_kategoriprnt" class="form-control" required>
                                <option> Choose Kategori </option>
                                <option value="all">All</option>
                                <option value="complain">complain</option>
                                <option value="request">request</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_statusprnt">Status</label>
                            <select id="txt_statusprnt" name="txt_statusprnt" class="form-control" required>
                                <option value="all"> Pilih Status </option>
                                <option value="all">All</option>
                                <option value="1">Open</option>
                                <option value="0">Close</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning text-white" id="btn_download">
                            <i class="fa fa-edit"></i> Print
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <!-- Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Update Status
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/complain/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_tgljaminputMod">Tanggal & Jam Input</label>
                                    <input type="text" id="txt_tgljaminputMod" name="txt_tgljaminputMod" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_userMod">User Input</label>
                                    <input type="text" id="txt_userMod" name="txt_userMod" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_mitraMod">Kode Mitra</label>
                                    <input type="hidden" id="txt_idMod" name="txt_idMod" class="form-control" readonly>
                                    <input type="hidden" id="txt_tglMod" name="txt_tglMod" class="form-control" readonly>
                                    <input type="hidden" id="txt_jamMod" name="txt_jamMod" class="form-control" readonly>
                                    <input type="text" id="txt_mitraMod" name="txt_mitraMod" class="form-control" readonly>
                                    <input type="hidden" id="txt_periodeMod" name="txt_periodeMod" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kategoriMod">Kategori</label>
                                    <input type="text" id="txt_kategoriMod" name="txt_kategoriMod" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_klasifikasiMod">Klasifikasi</label>
                                    <input type="text" id="txt_klasifikasiMod" name="txt_klasifikasiMod" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="txt_keluhanMod">Keluhan</label>
                            <textarea name="txt_keluhanMod" id="txt_keluhanMod" rows="3" class="form-control" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_solvingMod">Solving</label>
                                <textarea name="txt_solvingMod" id="txt_solvingMod" rows="3" class="form-control" required></textarea>
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
                        <button type="button" class="btn btn-primary text-white" id="btn_gagalup">
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

        <!-- Modal View-->
    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                    View All
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ URL::asset('/Complain/update') }}" method="POST" id="form_view">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txt_tgljamView">Tgl & Jam Input:</label>
                                <input type="text" name="txt_tgljamView" id="txt_tgljamView" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                    <label for="txt_tgljamupdateView">Tgl & Jam Update:</label>
                                    <input type="text" name="txt_tgljamupdateView" id="txt_tgljamupdateView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_tanggalView">Tanggal Laporan:</label>
                                    <input type="text" id="txt_tanggalView" name="txt_tanggalView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_jamView">Jam Laporan:</label>
                                    <input type="text" id="txt_jamView" name="txt_jamView" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_userinputView">User Input:</label>
                                    <input type="text" id="txt_userinputView" name="txt_userinputView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_userupdateView">User Update:</label>
                                    <input type="text" id="txt_userupdateView" name="txt_userupdateView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_requesterView">Requester:</label>
                                    <input type="text" id="txt_requesterView" name="txt_requesterView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_orderView">Order By:</label>
                                    <input type="text" id="txt_orderView" name="txt_orderView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_tiketingView">No-Tiket:</label>
                                    <input type="text" id="txt_tiketingView" name="txt_tiketingView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_mitraView">Mitra:</label>
                                    <input type="text" id="txt_mitraView" name="txt_mitraView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_klasifikasiView">Klasifikasi:</label>
                                    <input type="text" id="txt_klasifikasiView" name="txt_klasifikasiView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_periodeView">Periode:</label>
                                    <input type="text" id="txt_periodeView" name="txt_periodeView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_statusView">Status:</label>
                                    <input type="text" id="txt_statusView" name="txt_statusView" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txt_kategoriView">Kategori:</label>
                                    <input type="text" id="txt_kategoriView" name="txt_kategoriView" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_keluhanView">Keluhan:</label>
                                    <textarea name="txt_keluhanView" id="txt_keluhanView" rows="3" class="form-control" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_solvingView">Solving:</label>
                                    <textarea name="txt_solvingView" id="txt_solvingView" rows="3" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>  
                </form>          
                <div class="modal-footer">
                    <form action="{{ URL::asset('/complain/downloadselected') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" id="txt_kategoriPrint" name="txt_kategoriPrint" class="form-control" readonly>
                        <input type="hidden" id="txt_tiketingPrint" name="txt_tiketingPrint" class="form-control" readonly>
                        <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                            <i class="fa fa-download"></i> Print
                        </button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
        <script src="{{ URL::asset('public/js/index.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
        <script>
            $(document).ready(function() {
    
                //Menampilkan value data ke editmodal
                $('#edit_modal').on('show.bs.modal', function(event) {
                    //Memanggil data dari database
                    var btn = $(event.relatedTarget),
                        idcomplain = btn.data('idcomplain'),
                        tgljam = btn.data('tgljam'),
                        userinput = btn.data('userinput'),
                        tgllaporan = btn.data('tgllaporan'),
                        jamlaporan = btn.data('jamlaporan'),
                        mitra = btn.data('mitra'),
                        periode = btn.data('periode'),
                        keluhan = btn.data('keluhan'),
                        solving = btn.data('solving'),
                        kategori = btn.data('kategori'),
                        klasifikasi = btn.data('klasifikasi'),
                        status = btn.data('status')
    
                    //Menampilkan data yang telah diambil ke Update modal
                    $('#edit_modal').find('#txt_idMod').val(idcomplain);
                    $('#edit_modal').find('#txt_tgljaminputMod').val(tgljam);
                    $('#edit_modal').find('#txt_userMod').val(userinput);
                    $('#edit_modal').find('#txt_tglMod').val(tgllaporan);
                    $('#edit_modal').find('#txt_jamMod').val(jamlaporan);
                    $('#edit_modal').find('#txt_mitraMod').val(mitra);
                    $('#edit_modal').find('#txt_periodeMod').val(periode);
                    $('#edit_modal').find('#txt_keluhanMod').val(keluhan);
                    $('#edit_modal').find('#txt_solvingMod').val(solving);
                    $('#edit_modal').find('#txt_kategoriMod').val(kategori);
                    $('#edit_modal').find('#txt_klasifikasiMod').val(klasifikasi);
                    $('#edit_modal').find('#status').val(status);
    
                })
                
                //Menampilkan value data ke view modal
                $('#view_modal').on('show.bs.modal', function(event) {
                    //Memanggil data dari database
                    var btn = $(event.relatedTarget),
                        notiketing = btn.data('notiketing'),
                        tgljam = btn.data('tgljam'),
                        tglJamUpdate = btn.data('update'),
                        tgllaporan = btn.data('tgllaporan'),
                        jamlaporan = btn.data('jamlaporan'),
                        mitra = btn.data('mitra'),
                        periode = btn.data('periode'),
                        keluhan = btn.data('keluhan'),
                        solving = btn.data('solving'),
                        kategori = btn.data('kategori'),
                        klasifikasi = btn.data('klasifikasi'),
                        userinput = btn.data('userinput'),
                        userupdate = btn.data('userupdate'),
                        requester = btn.data('requester'),
                        order_by = btn.data('order'),
                        status = btn.data('status')
                        
                        //Mengubah value status yang berupa numerik 1/0 menjadi OPEN/CLOSE
                        var statusText = (status == 1) ? "OPEN" : "CLOSE";
    
                    //Menampilkan data yang telah diambil ke view modal
                    $('#view_modal').find('#txt_tiketingView').val(notiketing);
                    $('#view_modal').find('#txt_tiketingPrint').val(notiketing);
                    $('#view_modal').find('#txt_tgljamView').val(tgljam);
                    $('#txt_tgljamupdateView').val(tglJamUpdate);
    
                    //Menampilkan keterangan BELUM ADA UPDATE jika data tidak memiliki value tgljamupdate
                    if (tgljam === tglJamUpdate) {
                        $('#txt_tgljamupdateView').val("Belum Ada Update");
                    } else {
                        $('#txt_tgljamupdateView').val(tglJamUpdate);
                    }
    
                    $('#view_modal').find('#txt_tanggalView').val(tgllaporan);
                    $('#view_modal').find('#txt_jamView').val(jamlaporan);
                    $('#view_modal').find('#txt_mitraView').val(mitra);
                    $('#view_modal').find('#txt_periodeView').val(periode);
                    $('#view_modal').find('#txt_userinputView').val(userinput);
                    $('#view_modal').find('#txt_userupdateView').val(userupdate);
                    $('#view_modal').find('#txt_requesterView').val(requester);
                    $('#view_modal').find('#txt_orderView').val(order_by);
                    $('#view_modal').find('#txt_keluhanView').val(keluhan);
                    $('#view_modal').find('#txt_solvingView').val(solving);
                    $('#view_modal').find('#txt_kategoriView').val(kategori);
                    $('#view_modal').find('#txt_kategoriPrint').val(kategori);
                    $('#view_modal').find('#txt_klasifikasiView').val(klasifikasi);
                    $('#view_modal').find('#txt_statusView').val(statusText);
    
                })
            })
    
            $('#myTable').DataTable({
                order: [[1, 'asc']],
                "pageLength" : 50
            });
            $('#div_tanggal').hide(true);
    
            // Event saat seluruh konten halaman selesai dimuat
            window.onload = function() {
                $(".loading-screen").hide();
            };
            
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("complainForm");
                const loadingScreen = document.querySelector(".loading-screen");
                
                form.addEventListener("submit", function() {
                    // Tampilkan loading screen saat form disubmit
                    loadingScreen.style.display = "block";
                });
                
                form.addEventListener("load", function() {
                    // Sembunyikan loading screen setelah form selesai diproses
                    loadingScreen.style.display = "none";
                });
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
                        $('#addComplain form').submit();
                    }, 2000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
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
                        $('#edit_modal form').submit();
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
            var dateinput = document.getElementById('txt_tglAdd');
            
            // Mendapatkan tanggal saat ini
            var currentDate = new Date();
            
            // Mendapatkan string nilai tanggal dalam format "yyyy-mm-dd"
            var currentFormattedDate = currentDate.toISOString().slice(0, 10);
            
            // Set nilai tanggal saat ini ke input
            dateinput.value = currentFormattedDate;
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            var jamAddInput = document.getElementById('txt_jamAdd');
            // Mendapatkan waktu saat ini
            
            var currentTime = new Date();
            
            // Mendapatkan string nilai waktu dalam format "HH:mm"
            var currentFormattedTime = currentTime.toTimeString().slice(0, 5);
            
            // Set nilai waktu saat ini ke input
            jamAddInput.value = currentFormattedTime;
        });
        // Mendapatkan elemen input "Status"
        var statusInput = document.getElementById("txt_statusView");
        
        // Mendapatkan nilai dari elemen input "Status"
        var statusValue = statusInput.value;
    
        // Mengubah nilai "Status" menjadi teks yang sesuai
        if (statusValue === "1") {
            statusInput.innerHTML = "OPEN";
        } else{
            statusInput.innerHTML = "CLOSE";
        }

        document.getElementById("periode").addEventListener("change", function () {
        const today = new Date();
        const startDateInput = document.getElementById("startDate");
        const endDateInput = document.getElementById("endDate");

        const selectedValue = this.value;
        let startDate, endDate;

        switch (selectedValue) {
            case "today":
                startDate = today.toISOString().split("T")[0];
                endDate = startDate;
                break;
            case "this_week":
                startDate = new Date(today.setDate(today.getDate() - today.getDay())).toISOString().split("T")[0];
                endDate = new Date(today.setDate(today.getDate() - today.getDay() + 6)).toISOString().split("T")[0];
                break;
            case "this_month":
                startDate = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split("T")[0];
                endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0).toISOString().split("T")[0];
                break;
            case "last_week":
                startDate = new Date(today.setDate(today.getDate() - today.getDay() - 7)).toISOString().split("T")[0];
                endDate = new Date(today.setDate(today.getDate() - today.getDay() - 1)).toISOString().split("T")[0];
                break;
            case "last_month":
                startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1).toISOString().split("T")[0];
                endDate = new Date(today.getFullYear(), today.getMonth(), 0).toISOString().split("T")[0];
                break;
            case "this_year":
                startDate = new Date(today.getFullYear(), 0, 1).toISOString().split("T")[0];
                endDate = new Date(today.getFullYear(), 11, 31).toISOString().split("T")[0];
                break;
            case "last_year":
                startDate = new Date(today.getFullYear() - 1, 0, 1).toISOString().split("T")[0];
                endDate = new Date(today.getFullYear() - 1, 11, 31).toISOString().split("T")[0];
                break;
            case "all":
                startDate = "2021-01-01";
                endDate = "2023-12-31";
                break;
        }

        startDateInput.value = startDate;
        endDateInput.value = endDate;
    });

    document.getElementById("periode").dispatchEvent(new Event("change"));
        </script>
    @endsection
