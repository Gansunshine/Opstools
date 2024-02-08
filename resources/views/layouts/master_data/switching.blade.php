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
                    <h2>Get Data Switching</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon" data-toggle="modal" data-target="#add_modal">
                <i class="fa fa-plus"></i> Add Switching
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
                        <th scope="col">Kode Switching</th>
                        <th scope="col">Nama Switching</th>
                        <th scope="col">IP Rekon SW</th>
                        <th scope="col">Alamat Switching</th>
                        <th scope="col">Email Switching</th>
                        <th scope="col">No. Contact Switching</th>
                        <th scope="col">Bank ID</th>
                        <th scope="col">IP Destination</th>
                        <th scope="col">Web Monitoring</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['kode_switching'] }}</td>
                        <td>{{ $value['nama_switching'] }}</td>
                        <td>{{ $value['ip_rekon_sw'] }}</td>
                        <td>{{ $value['alamat_switching'] }}</td>
                        <td>{{ $value['email_switching'] }}</td>
                        <td>{{ $value['no_contact_switching'] }}</td>
                        <td>{{ $value['bank_id'] }}</td>
                        <td>{{ $value['ip_destination'] }}</td>
                        <td>{{ $value['web_monitoring'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal" data-idswitching="{{ $value['id_m_switching'] }}"
                                    data-kodeswitching="{{ $value['kode_switching'] }}" data-namaswitching="{{ $value['nama_switching'] }}"
                                    data-iprekon="{{ $value['ip_rekon_sw'] }}" data-alamatswitching="{{ $value['alamat_switching'] }}"
                                    data-emailswitching="{{ $value['email_switching'] }}" data-contact="{{ $value['no_contact_switching'] }}"
                                    data-bankid="{{ $value['bank_id'] }}" data-ipdestination="{{ $value['ip_destination'] }}"
                                    data-webmonitoring="{{ $value['web_monitoring'] }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#view_modal" data-idswitching="{{ $value['id_m_switching'] }}"
                                    data-kodeswitching="{{ $value['kode_switching'] }}" data-namaswitching="{{ $value['nama_switching'] }}"
                                    data-iprekon="{{ $value['ip_rekon_sw'] }}" data-alamatswitching="{{ $value['alamat_switching'] }}"
                                    data-emailswitching="{{ $value['email_switching'] }}" data-contact="{{ $value['no_contact_switching'] }}"
                                    data-bankid="{{ $value['bank_id'] }}" data-ipdestination="{{ $value['ip_destination'] }}"
                                    data-webmonitoring="{{ $value['web_monitoring'] }}">
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
                <form action="{{ URL::asset('/getdata_switching/store') }}" method="POST" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaswitchingadd">Nama Switching</label>
                                    <input type="text" id="txt_namaswitchingadd" name="txt_namaswitchingadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_emailswitchingadd">Email Switching</label>
                                    <input type="text" id="txt_emailswitchingadd" name="txt_emailswitchingadd" class="form-control" required>
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
                                    <label for="txt_alamatswitchingadd">Alamat Switching</label>
                                    <input type="text" id="txt_alamatswitchingadd" name="txt_alamatswitchingadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_iprekonadd">IP Rekon SW</label>
                                    <input type="text" id="txt_iprekonadd" name="txt_iprekonadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_ipdestinationadd">IP Destination</label>
                                    <input type="text" id="txt_ipdestinationadd" name="txt_ipdestinationadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactadd">No. Contact</label>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_webmonitoringadd">Web Monitoring</label>
                                    <input type="text" id="txt_webmonitoringadd" name="txt_webmonitoringadd" class="form-control" required>
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
                <form action="{{ URL::asset('/getdata_switching/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaswitchingmod">Nama Switching</label>
                                    <input type="hidden" id="idmod" name="idmod" class="form-control" required>
                                    <input type="text" id="txt_namaswitchingmod" name="txt_namaswitchingmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_emailswitchingmod">Email Switching</label>
                                    <input type="text" id="txt_emailswitchingmod" name="txt_emailswitchingmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodeswitchingmod">Kode Switching</label>
                                    <input type="text" id="txt_kodeswitchingmod" name="txt_kodeswitchingmod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_alamatswitchingmod">Alamat Switching</label>
                                    <input type="text" id="txt_alamatswitchingmod" name="txt_alamatswitchingmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_iprekonmod">IP Rekon SW</label>
                                    <input type="text" id="txt_iprekonmod" name="txt_iprekonmod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_ipdestinationmod">IP Destination</label>
                                    <input type="text" id="txt_ipdestinationmod" name="txt_ipdestinationmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactmod">No. Contact</label>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_webmonitoringmod">Web Monitoring</label>
                                    <input type="text" id="txt_webmonitoringmod" name="txt_webmonitoringmod" class="form-control" required>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_namaswitchingview">Nama Switching</label>
                                    <input type="hidden" id="idview" name="idview" class="form-control" required readonly>
                                    <input type="text" id="txt_namaswitchingview" name="txt_namaswitchingview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_emailswitchingview">Email Switching</label>
                                    <input type="text" id="txt_emailswitchingview" name="txt_emailswitchingview" class="form-control" required readonly>
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
                                    <label for="txt_alamatswitchingview">Alamat Switching</label>
                                    <input type="text" id="txt_alamatswitchingview" name="txt_alamatswitchingview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_iprekonview">IP Rekon SW</label>
                                    <input type="text" id="txt_iprekonview" name="txt_iprekonview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_ipdestinationview">IP Destination</label>
                                    <input type="text" id="txt_ipdestinationview" name="txt_ipdestinationview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_contactview">No. Contact</label>
                                    <input type="text" id="txt_contactview" name="txt_contactview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_bankidview">Bank ID</label>
                                    <input type="text" id="txt_bankidview" name="txt_bankidview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_webmonitoringview">Web Monitoring</label>
                                    <input type="text" id="txt_webmonitoringview" name="txt_webmonitoringview" class="form-control" required readonly>
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
                    idswitching = btn.data('idswitching'),
                    kodeswitching = btn.data('kodeswitching'),
                    namaswitching = btn.data('namaswitching'),
                    iprekon = btn.data('iprekon'),
                    alamatswitching = btn.data('alamatswitching'),
                    emailswitching = btn.data('emailswitching'),
                    contact = btn.data('contact'),
                    bankid = btn.data('bankid'),
                    ipdestination = btn.data('ipdestination'),
                    webmonitoring = btn.data('webmonitoring');

                $('#edit_modal').find('#idmod').val(idswitching);
                $('#edit_modal').find('#txt_namaswitchingmod').val(namaswitching);
                $('#edit_modal').find('#txt_emailswitchingmod').val(emailswitching);
                $('#edit_modal').find('#txt_kodeswitchingmod').val(kodeswitching);
                $('#edit_modal').find('#txt_alamatswitchingmod').val(alamatswitching);
                $('#edit_modal').find('#txt_iprekonmod').val(iprekon);
                $('#edit_modal').find('#txt_ipdestinationmod').val(ipdestination);
                $('#edit_modal').find('#txt_contactmod').val(contact);
                $('#edit_modal').find('#txt_bankidmod').val(bankid);
                $('#edit_modal').find('#txt_webmonitoringmod').val(webmonitoring);
            });

            
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    idswitching = btn.data('idswitching'),
                    kodeswitching = btn.data('kodeswitching'),
                    namaswitching = btn.data('namaswitching'),
                    iprekon = btn.data('iprekon'),
                    alamatswitching = btn.data('alamatswitching'),
                    emailswitching = btn.data('emailswitching'),
                    contact = btn.data('contact'),
                    bankid = btn.data('bankid'),
                    ipdestination = btn.data('ipdestination'),
                    webmonitoring = btn.data('webmonitoring');
                        
                $('#view_modal').find('#idview').val(idswitching);
                $('#view_modal').find('#txt_namaswitchingview').val(namaswitching);
                $('#view_modal').find('#txt_emailswitchingview').val(emailswitching);
                $('#view_modal').find('#txt_kodeswitchingview').val(kodeswitching);
                $('#view_modal').find('#txt_alamatswitchingview').val(alamatswitching);
                $('#view_modal').find('#txt_iprekonview').val(iprekon);
                $('#view_modal').find('#txt_ipdestinationview').val(ipdestination);
                $('#view_modal').find('#txt_contactview').val(contact);
                $('#view_modal').find('#txt_bankidview').val(bankid);
                $('#view_modal').find('#txt_webmonitoringview').val(webmonitoring);
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