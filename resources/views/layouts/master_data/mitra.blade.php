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
                    <h2>Get Data Mitra</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon" data-toggle="modal" data-target="#add_modal">
                <i class="fa fa-plus"></i> Add Mitra
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
                        <th scope="col">Kode Mitra</th>
                        <th scope="col">kode Link Mitra</th>
                        <th scope="col">Kode Mapping Mitra</th>
                        <th scope="col">Nama Mitra</th>
                        <th scope="col">Email Mitra</th>
                        <th scope="col">User FTP</th>
                        <th scope="col">Pass FTP</th>
                        <th scope="col">Folder</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['kode_mitra'] }}</td>
                        <td>{{ $value['kode_link_dbmitra'] }}</td>
                        <td>{{ $value['kode_mapping_mitra'] }}</td>
                        <td>{{ $value['nama_mitra'] }}</td>
                        <td>{{ $value['email_mitra'] }}</td>
                        <td>{{ $value['user_ftp'] }}</td>
                        <td>{{ $value['pass_ftp'] }}</td>
                        <td>{{ $value['folder'] }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal"
                                    data-id="{{ $value['id_mitra'] }}" data-kode="{{ $value['kode_mitra'] }}"
                                    data-kodelink="{{ $value['kode_link_dbmitra'] }}" data-kodemapping="{{ $value['kode_mapping_mitra'] }}"
                                    data-nama="{{ $value['nama_mitra'] }}" data-alamat="{{ $value['alamat'] }}"
                                    data-emaill="{{ $value['email_mitra'] }}" data-userr="{{ $value['user_ftp'] }}"
                                    data-passs="{{ $value['pass_ftp'] }}" data-folder="{{ $value['folder'] }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#view_modal"
                                    data-id="{{ $value['id_mitra'] }}" data-kode="{{ $value['kode_mitra'] }}"
                                    data-kodelink="{{ $value['kode_link_dbmitra'] }}" data-kodemapping="{{ $value['kode_mapping_mitra'] }}"
                                    data-nama="{{ $value['nama_mitra'] }}" data-alamat="{{ $value['alamat'] }}"
                                    data-emaill="{{ $value['email_mitra'] }}" data-userr="{{ $value['user_ftp'] }}"
                                    data-passs="{{ $value['pass_ftp'] }}" data-folder="{{ $value['folder'] }}">
                                    <i class="bi bi-info-circle"></i> View
                                </button>
                                <form action="{{ url('getdata_mitra/hapusmitra') }}" method="POST" id="delete_form">
                                    @csrf
                                    <input type="hidden" name="idmitradlt" value="{{ $value['id_mitra'] }}">
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
                <form action="{{ URL::asset('/getdata_mitra/store') }}" method="POST" id="form_add">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemitraadd">Kode Mitra</label>
                                    <input type="text" id="txt_kodemitraadd" name="txt_kodemitraadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodelinkmitraadd">Kode Link Mitra</label>
                                    <input type="text" id="txt_kodelinkmitraadd" name="txt_kodelinkmitraadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemapadd">Kode Mapping Mitra</label>
                                    <input type="text" id="txt_kodemapadd" name="txt_kodemapadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namamitraadd">Nama Mitra</label>
                                    <input type="text" id="txt_namamitraadd" name="txt_namamitraadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_alamatadd">Alamat</label>
                                    <input type="text" id="txt_alamatadd" name="txt_alamatadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailmitraadd">Email Mitra</label>
                                    <input type="text" id="txt_emailmitraadd" name="txt_emailmitraadd" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_userftpadd">User FTP</label>
                                    <input type="text" id="txt_userftpadd" name="txt_userftpadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_passftpadd">Pass FTP</label>
                                    <div class="input-group-append">
                                    <input type="password" id="txt_passftpadd" name="txt_passftpadd" class="form-control" required>
                                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                        <span id="mybutton" onclick="changeadd()" class="input-group-text">
                                            <!-- icon mata bawaan bootstrap  -->
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_folderadd">Folder</label>
                                    <input type="text" id="txt_folderadd" name="txt_folderadd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ... existing code ... -->
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
                        Update Mitra
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_mitra/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemitramod">Kode Mitra</label>
                                    <input type="hidden" id="idmod" name="idmod" class="form-control" required>
                                    <input type="text" id="txt_kodemitramod" name="txt_kodemitramod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodelinkmitramod">Kode Link Mitra</label>
                                    <input type="text" id="txt_kodelinkmitramod" name="txt_kodelinkmitramod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemapmod">Kode Mapping Mitra</label>
                                    <input type="text" id="txt_kodemapmod" name="txt_kodemapmod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namamitramod">Nama Mitra</label>
                                    <input type="text" id="txt_namamitramod" name="txt_namamitramod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_alamatmod">Alamat</label>
                                    <input type="text" id="txt_alamatmod" name="txt_alamatmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailmitramod">Email Mitra</label>
                                    <input type="text" id="txt_emailmitramod" name="txt_emailmitramod" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_userftpmod">User FTP</label>
                                    <input type="text" id="txt_userftpmod" name="txt_userftpmod" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_passftpmod">Pass FTP</label>
                                    <div class="input-group-append">
                                    <input type="password" id="txt_passftpmod" name="txt_passftpmod" class="form-control" required>
                                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                        <span id="mybutton" onclick="change()" class="input-group-text">
                                            <!-- icon mata bawaan bootstrap  -->
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_foldermod">Folder</label>
                                    <input type="text" id="txt_foldermod" name="txt_foldermod" class="form-control" required>
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
                <form action="{{ URL::asset('/getdata_mitra/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemitraview">Kode Mitra</label>
                                    <input type="hidden" id="idview" name="idview" class="form-control" readonly>
                                    <input type="text" id="txt_kodemitraview" name="txt_kodemitraview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodelinkmitraview">Kode Link Mitra</label>
                                    <input type="text" id="txt_kodelinkmitraview" name="txt_kodelinkmitraview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_kodemapview">Kode Mapping Mitra</label>
                                    <input type="text" id="txt_kodemapview" name="txt_kodemapview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_namamitraview">Nama Mitra</label>
                                    <input type="text" id="txt_namamitraview" name="txt_namamitraview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_alamatview">Alamat</label>
                                    <input type="text" id="txt_alamatview" name="txt_alamatview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_emailmitraview">Email Mitra</label>
                                    <input type="text" id="txt_emailmitraview" name="txt_emailmitraview" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_userftpview">User FTP</label>
                                    <input type="text" id="txt_userftpview" name="txt_userftpview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_passftpview">Pass FTP</label>
                                    <div class="input-group-append">
                                    <input type="password" id="txt_passftpview" name="txt_passftpview" class="form-control" readonly>
                                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                        <span id="mybutton" onclick="changeview()" class="input-group-text">
                                            <!-- icon mata bawaan bootstrap  -->
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_folderview">Folder</label>
                                    <input type="text" id="txt_folderview" name="txt_folderview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ... existing code ... -->
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
            document.getElementById("txt_emailmitraadd").value = "";
            document.getElementById("txt_userftpadd").value = "";
            document.getElementById("txt_passftpadd").value = "";
            document.getElementById("txt_folderadd").value = "";

            $('#edit_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                id = btn.data('id'),
                kode = btn.data('kode'),
                kodelink = btn.data('kodelink')
                kodemapping = btn.data('kodemapping')
                nama = btn.data('nama'),
                alamat = btn.data('alamat'),
                email = btn.data('emaill'),
                user = btn.data('userr'),
                pass = btn.data('passs'),
                folder = btn.data('folder')

                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#txt_kodemitramod').val(kode);
                $('#edit_modal').find('#txt_kodelinkmitramod').val(kodelink);
                $('#edit_modal').find('#txt_kodemapmod').val(kodemapping);
                $('#edit_modal').find('#txt_namamitramod').val(nama);
                $('#edit_modal').find('#txt_alamatmod').val(alamat);
                $('#edit_modal').find('#txt_emailmitramod').val(email);
                $('#edit_modal').find('#txt_userftpmod').val(user);
                $('#edit_modal').find('#txt_passftpmod').val(pass);
                $('#edit_modal').find('#txt_foldermod').val(folder);
            });
            
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                id = btn.data('id'),
                kode = btn.data('kode'),
                kodelink = btn.data('kodelink')
                kodemapping = btn.data('kodemapping')
                nama = btn.data('nama')
                alamat = btn.data('alamat'),
                email = btn.data('emaill'),
                user = btn.data('userr'),
                pass = btn.data('passs'),
                folder = btn.data('folder')

                $('#view_modal').find('#idview').val(id);
                $('#view_modal').find('#txt_kodemitraview').val(kode);
                $('#view_modal').find('#txt_kodelinkmitraview').val(kodelink);
                $('#view_modal').find('#txt_kodemapview').val(kodemapping);
                $('#view_modal').find('#txt_namamitraview').val(nama);
                $('#view_modal').find('#txt_alamatview').val(alamat);
                $('#view_modal').find('#txt_emailmitraview').val(email);
                $('#view_modal').find('#txt_userftpview').val(user);
                $('#view_modal').find('#txt_passftpview').val(pass);
                $('#view_modal').find('#txt_folderview').val(folder);
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

    // membuat fungsi change
    function change() {
        
        // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
        var x = document.getElementById('txt_passftpmod').type;

        //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
        if (x == 'password') {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpmod').type = 'text';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
            </svg>`;
        }
        else {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpmod').type = 'password';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>`;
        }
    }
    // membuat fungsi change
    function changeview() {
        
        // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
        var x = document.getElementById('txt_passftpview').type;

        //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
        if (x == 'password') {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpview').type = 'text';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
            </svg>`;
        }
        else {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpview').type = 'password';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>`;
        }
    }
    // membuat fungsi change
    function changeadd() {
        
        // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
        var x = document.getElementById('txt_passftpadd').type;

        //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
        if (x == 'password') {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpadd').type = 'text';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
            </svg>`;
        }
        else {

            //ubah form input password menjadi text
            document.getElementById('txt_passftpadd').type = 'password';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = 
            `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>`;
        }
    }
</script>
    
@endsection