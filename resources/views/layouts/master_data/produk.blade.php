@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
@include('_partial.flash_message')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Header -->
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Get Data Produk</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon" data-toggle="modal" data-target="#add_modal">
                <i class="fa fa-plus"></i> Add Produk
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
                        <th scope="col">Kode Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kode Produk SW</th>
                        <th scope="col">Biaya Admin</th>
                        <th scope="col">Kode Switching</th>
                        <th scope="col">Kode Agregator</th>
                        <th scope="col">Fee Mitra</th>
                        <th scope="col">Fee Biller</th>
                        <th scope="col">Fee Agregator</th>
                        <th scope="col">Fee Lim</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['kode_produk_lim'] }}</td>
                        <td>{{ $value['nama_produk_lim'] }}</td>
                        <td>{{ $value['kode_produk_sw'] }}</td>
                        <td>{{ $value['biaya_admin'] }}</td>
                        <td>{{ $value['kode_switching'] }}</td>
                        <td>{{ $value['kode_agregator'] }}</td>
                        <td>{{ $value['fee_mitra'] }}</td>
                        <td>{{ $value['fee_biller'] }}</td>
                        <td>{{ $value['fee_agregator'] }}</td>
                        <td>{{ $value['fee_lim'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal" data-idproduk="{{ $value['id_m_produk'] }}"
                                    data-kodeproduklim="{{ $value['kode_produk_lim'] }}" data-namaproduk="{{ $value['nama_produk_lim'] }}"
                                    data-kodeproduksw="{{ $value['kode_produk_sw'] }}" data-biayaadmin="{{ $value['biaya_admin'] }}"
                                    data-kodeswitching="{{ $value['kode_switching'] }}" data-kodeagregator="{{ $value['kode_agregator'] }}"
                                    data-feemitra="{{ $value['fee_mitra'] }}" data-feebiller="{{ $value['fee_biller'] }}"
                                    data-feeagregator="{{ $value['fee_agregator'] }}" data-feelim="{{ $value['fee_lim'] }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#view_modal" data-idproduk="{{ $value['id_m_produk'] }}"
                                    data-kodeproduklim="{{ $value['kode_produk_lim'] }}" data-namaproduk="{{ $value['nama_produk_lim'] }}"
                                    data-kodeproduksw="{{ $value['kode_produk_sw'] }}" data-biayaadmin="{{ $value['biaya_admin'] }}"
                                    data-kodeswitching="{{ $value['kode_switching'] }}" data-kodeagregator="{{ $value['kode_agregator'] }}"
                                    data-feemitra="{{ $value['fee_mitra'] }}" data-feebiller="{{ $value['fee_biller'] }}"
                                    data-feeagregator="{{ $value['fee_agregator'] }}" data-feelim="{{ $value['fee_lim'] }}">
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

    <!--Add Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Add Data Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_produk/store') }}" method="POST" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeproduklimadd">Kode Produk Lim</label>
                                    <input type="text" id="txt_kodeproduklimadd" name="txt_kodeproduklimadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeprodukswadd">Kode Produk SW</label>
                                    <input type="text" id="txt_kodeprodukswadd" name="txt_kodeprodukswadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaprodukadd">Nama Produk</label>
                                    <input type="text" id="txt_namaprodukadd" name="txt_namaprodukadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_biayaadminadd">Biaya Admin</label>
                                    <input type="text" id="txt_biayaadminadd" name="txt_biayaadminadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeswitchingadd">Kode Switching</label>
                                    <input type="text" id="txt_kodeswitchingadd" name="txt_kodeswitchingadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatoradd">Kode Agregator</label>
                                    <input type="text" id="txt_kodeagregatoradd" name="txt_kodeagregatoradd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feemitraadd">Fee Mitra</label>
                                    <input type="text" id="txt_feemitraadd" name="txt_feemitraadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feebilleradd">Fee Biller</label>
                                    <input type="text" id="txt_feebilleradd" name="txt_feebilleradd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feeagregatoradd">Fee Agregator</label>
                                    <input type="text" id="txt_feeagregatoradd" name="txt_feeagregatoradd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feelimadd">Fee Lim</label>
                                    <input type="text" id="txt_feelimadd" name="txt_feelimadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(session()->has('username'))
                        <button type="button" class="btn btn-primary text-white" id="btn_save">
                            <i class="fa fa-edit"></i> Add
                        </button>
                        @else
                        <button type="button" class="btn btn-primary text-white" id="btn_gagal">
                            <i class="fa fa-edit"></i> Add
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
                        Update Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_produk/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeproduklimmod">Kode Produk Lim</label>
                                    <input type="hidden" id="idmod" name="idmod" class="form-control" required>
                                    <input type="text" id="txt_kodeproduklimmod" name="txt_kodeproduklimmod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeprodukswmod">Kode Produk SW</label>
                                    <input type="text" id="txt_kodeprodukswmod" name="txt_kodeprodukswmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaprodukmod">Nama Produk</label>
                                    <input type="text" id="txt_namaprodukmod" name="txt_namaprodukmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_biayaadminmod">Biaya Admin</label>
                                    <input type="text" id="txt_biayaadminmod" name="txt_biayaadminmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeswitchingmod">Kode Switching</label>
                                    <input type="text" id="txt_kodeswitchingmod" name="txt_kodeswitchingmod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatormod">Kode Agregator</label>
                                    <input type="text" id="txt_kodeagregatormod" name="txt_kodeagregatormod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feemitramod">Fee Mitra</label>
                                    <input type="text" id="txt_feemitramod" name="txt_feemitramod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feebillermod">Fee Biller</label>
                                    <input type="text" id="txt_feebillermod" name="txt_feebillermod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feeagregatormod">Fee Agregator</label>
                                    <input type="text" id="txt_feeagregatormod" name="txt_feeagregatormod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feelimmod">Fee Lim</label>
                                    <input type="text" id="txt_feelimmod" name="txt_feelimmod" class="form-control" required>
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

    <!--View Modal -->
    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        View Data Produk
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeproduklimview">Kode Produk Lim</label>
                                    <input type="hidden" id="idview" name="idview" class="form-control" required>
                                    <input type="text" id="txt_kodeproduklimview" name="txt_kodeproduklimview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeprodukswview">Kode Produk SW</label>
                                    <input type="text" id="txt_kodeprodukswview" name="txt_kodeprodukswview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaprodukview">Nama Produk</label>
                                    <input type="text" id="txt_namaprodukview" name="txt_namaprodukview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_biayaadminview">Biaya Admin</label>
                                    <input type="text" id="txt_biayaadminview" name="txt_biayaadminview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeswitchingview">Kode Switching</label>
                                    <input type="text" id="txt_kodeswitchingview" name="txt_kodeswitchingview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatorview">Kode Agregator</label>
                                    <input type="text" id="txt_kodeagregatorview" name="txt_kodeagregatorview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feemitraview">Fee Mitra</label>
                                    <input type="text" id="txt_feemitraview" name="txt_feemitraview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feebillerview">Fee Biller</label>
                                    <input type="text" id="txt_feebillerview" name="txt_feebillerview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feeagregatorview">Fee Agregator</label>
                                    <input type="text" id="txt_feeagregatorview" name="txt_feeagregatorview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_feelimview">Fee Lim</label>
                                    <input type="text" id="txt_feelimview" name="txt_feelimview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                    id = btn.data('idproduk'),
                    kodeproduklim = btn.data('kodeproduklim'),
                    namaproduk = btn.data('namaproduk'),
                    kodeproduksw = btn.data('kodeproduksw'),
                    biayaadmin = btn.data('biayaadmin'),
                    kodeswitching = btn.data('kodeswitching'),
                    kodeagregator = btn.data('kodeagregator'),
                    feemitra = btn.data('feemitra'),
                    feebiller = btn.data('feebiller'),
                    feeagregator = btn.data('feeagregator'),
                    feelim = btn.data('feelim');

                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#txt_kodeproduklimmod').val(kodeproduklim);
                $('#edit_modal').find('#txt_namaprodukmod').val(namaproduk);
                $('#edit_modal').find('#txt_kodeprodukswmod').val(kodeproduksw);
                $('#edit_modal').find('#txt_biayaadminmod').val(biayaadmin);
                $('#edit_modal').find('#txt_kodeswitchingmod').val(kodeswitching);
                $('#edit_modal').find('#txt_kodeagregatormod').val(kodeagregator);
                $('#edit_modal').find('#txt_feemitramod').val(feemitra);
                $('#edit_modal').find('#txt_feebillermod').val(feebiller);
                $('#edit_modal').find('#txt_feeagregatormod').val(feeagregator);
                $('#edit_modal').find('#txt_feelimmod').val(feelim);
            });
            
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    id = btn.data('idproduk'),
                    kodeproduklim = btn.data('kodeproduklim'),
                    namaproduk = btn.data('namaproduk'),
                    kodeproduksw = btn.data('kodeproduksw'),
                    biayaadmin = btn.data('biayaadmin'),
                    kodeswitching = btn.data('kodeswitching'),
                    kodeagregator = btn.data('kodeagregator'),
                    feemitra = btn.data('feemitra'),
                    feebiller = btn.data('feebiller'),
                    feeagregator = btn.data('feeagregator'),
                    feelim = btn.data('feelim');

                $('#view_modal').find('#idview').val(id);
                $('#view_modal').find('#txt_kodeproduklimview').val(kodeproduklim);
                $('#view_modal').find('#txt_namaprodukview').val(namaproduk);
                $('#view_modal').find('#txt_kodeprodukswview').val(kodeproduksw);
                $('#view_modal').find('#txt_biayaadminview').val(biayaadmin);
                $('#view_modal').find('#txt_kodeswitchingview').val(kodeswitching);
                $('#view_modal').find('#txt_kodeagregatorview').val(kodeagregator);
                $('#view_modal').find('#txt_feemitraview').val(feemitra);
                $('#view_modal').find('#txt_feebillerview').val(feebiller);
                $('#view_modal').find('#txt_feeagregatorview').val(feeagregator);
                $('#view_modal').find('#txt_feelimview').val(feelim);
            });
        })

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
                        $('#add_modal form').submit();
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
</script>
    
@endsection