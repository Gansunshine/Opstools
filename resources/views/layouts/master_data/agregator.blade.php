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
                    <h2>Get Data Agregator</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon" data-toggle="modal" data-target="#add_modal">
                <i class="fa fa-plus"></i> Add Agregator
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
                        <th scope="col">Kode Agregator</th>
                        <th scope="col">Nama Agregator</th>
                        <th scope="col">Alamat Agregator</th>
                        <th scope="col">Email Agregator</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Bank ID</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['kode_agregator'] }}</td>
                        <td>{{ $value['nama_agregator'] }}</td>
                        <td>{{ $value['alamat_agregator'] }}</td>
                        <td>{{ $value['email_agregator'] }}</td>
                        <td>{{ $value['contact_person'] }}</td>
                        <td>{{ $value['bank_id'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal"
                                    data-id="{{ $value['id_agregator'] }}"
                                    data-kode="{{ $value['kode_agregator'] }}" data-nama="{{ $value['nama_agregator'] }}"
                                    data-alamat="{{ $value['alamat_agregator'] }}" data-email="{{ $value['email_agregator'] }}"
                                    data-contact="{{ $value['contact_person'] }}" data-bankid="{{ $value['bank_id'] }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#view_modal"
                                    data-id="{{ $value['id_agregator'] }}"
                                    data-kode="{{ $value['kode_agregator'] }}" data-nama="{{ $value['nama_agregator'] }}"
                                    data-alamat="{{ $value['alamat_agregator'] }}" data-email="{{ $value['email_agregator'] }}"
                                    data-contact="{{ $value['contact_person'] }}" data-bankid="{{ $value['bank_id'] }}">
                                    <i class="bi bi-info-circle"></i> View
                                </button>
                                <form action="{{ url('getdata_agregator/hapus') }}" method="POST" id="delete_form">
                                    @csrf
                                    <input type="hidden" name="idagregatordlt" value="{{ $value['id_agregator'] }}">
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus" data-toggle="tooltip" data-placement="top" title="Hapus" id="btn_delete">
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i> Delete
                                    </button>
                                </form>
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
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Add Data Mitra
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_agregator/store') }}" method="POST" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatoradd">Kode Agregator</label>
                                    <input type="text" id="txt_kodeagregatoradd" name="txt_kodeagregatoradd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namaagregatoradd">Nama Agregator</label>
                                    <input type="text" id="txt_namaagregatoradd" name="txt_namaagregatoradd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_alamatagregatoradd">Alamat Agregator</label>
                                    <input type="text" id="txt_alamatagregatoradd" name="txt_alamatagregatoradd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailadd">Email Agregator</label>
                                    <input type="text" id="txt_emailadd" name="txt_emailadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactadd">Contact Person</label>
                                    <input type="text" id="txt_contactadd" name="txt_contactadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_bankidadd">Bank ID</label>
                                    <input type="text" id="txt_bankidadd" name="txt_bankidadd" class="form-control" required>
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
                        Update Agregator
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_agregator/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatormod">Kode Agregator</label>
                                    <input type="hidden" id="idmod" name="idmod" class="form-control" required>
                                    <input type="text" id="txt_kodeagregatormod" name="txt_kodeagregatormod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namaagregatormod">Nama Agregator</label>
                                    <input type="text" id="txt_namaagregatormod" name="txt_namaagregatormod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_alamatagregatormod">Alamat Agregator</label>
                                    <input type="text" id="txt_alamatagregatormod" name="txt_alamatagregatormod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailmod">Email Agregator</label>
                                    <input type="text" id="txt_emailmod" name="txt_emailmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactmod">Contact Person</label>
                                    <input type="text" id="txt_contactmod" name="txt_contactmod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_bankidmod">Bank ID</label>
                                    <input type="text" id="txt_bankidmod" name="txt_bankidmod" class="form-control" required>
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
                        View Data Mitra
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_agregator/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeagregatorview">Kode Agregator</label>
                                    <input type="hidden" id="idview" name="idview" class="form-control" readonly>
                                    <input type="text" id="txt_kodeagregatorview" name="txt_kodeagregatorview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namaagregatorview">Nama Agregator</label>
                                    <input type="text" id="txt_namaagregatorview" name="txt_namaagregatorview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_alamatagregatorview">Alamat Agregator</label>
                                    <input type="text" id="txt_alamatagregatorview" name="txt_alamatagregatorview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailview">Email Agregator</label>
                                    <input type="text" id="txt_emailview" name="txt_emailview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactview">Contact Person</label>
                                    <input type="text" id="txt_contactview" name="txt_contactview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_bankidview">Bank ID</label>
                                    <input type="text" id="txt_bankidview" name="txt_bankidview" class="form-control" readonly>
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
                id = btn.data('id'),
                kode = btn.data('kode'),
                nama = btn.data('nama')
                alamat = btn.data('alamat')
                email = btn.data('email')
                contact = btn.data('contact'),
                bankid = btn.data('bankid')

                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#txt_kodeagregatormod').val(kode);
                $('#edit_modal').find('#txt_namaagregatormod').val(nama);
                $('#edit_modal').find('#txt_alamatagregatormod').val(alamat);
                $('#edit_modal').find('#txt_emailmod').val(email);
                $('#edit_modal').find('#txt_contactmod').val(contact);
                $('#edit_modal').find('#txt_bankidmod').val(bankid);
            });
            
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                id = btn.data('id'),
                kode = btn.data('kode'),
                nama = btn.data('nama')
                alamat = btn.data('alamat')
                email = btn.data('email')
                contact = btn.data('contact'),
                bankid = btn.data('bankid')

                $('#view_modal').find('#idview').val(id);
                $('#view_modal').find('#txt_kodeagregatorview').val(kode);
                $('#view_modal').find('#txt_namaagregatorview').val(nama);
                $('#view_modal').find('#txt_alamatagregatorview').val(alamat);
                $('#view_modal').find('#txt_emailview').val(email);
                $('#view_modal').find('#txt_contactview').val(contact);
                $('#view_modal').find('#txt_bankidview').val(bankid);
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

    $('#btn_delete').click(function() {
        // Show SweetAlert2 confirmation modal for updating data
        Swal.fire({
            title: 'Yakin Menghapus Data?',
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
                        $('#delete_form').submit();
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