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
                    <h2>User Management</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">
            <button class="btn bg-maroon" data-toggle="modal" data-target="#addUser">
                <i class="fa fa-plus"></i> Add User
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
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Hak Akses</th>
                        <th scope="col">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parsed_json as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
                        <td>{{ $value['username'] }}</td>
                        <td>{{ $value['nama'] }}</td>
                        <td>{{ $value['hak_akses'] }}</td>
                        @if ($value['status'] == 1)
                            <td >
                                <span>Aktif</span>
                            </td>
                        @else
                            <td>
                                <span>Non-Aktif</span>
                            </td>
                        @endif
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white" data-toggle="modal"
                                    data-target="#edit_modal"
                                    data-username="{{ $value['username'] }}" data-nama="{{ $value['nama'] }}"
                                    data-password="{{ $value['password'] }}" data-divisi="{{ $value['divisi'] }}"
                                    data-hakakses="{{ $value['hak_akses'] }}" data-status="{{ $value['status'] }}">
                                    <i class="fa fa-edit"></i> Edit
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
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Add User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_kategoriAdd">Divisi</label>
                            <select name="divisi" class="form-control" required>
                                <option> Choose Divisi </option>
                                <option value="ADMINISTRASI">ADMINISTRASI</option>
                                <option value="DEVEL">DEVEL</option>
                                <option value="HELPDESK">HELPDESK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_kategoriAdd">Status</label>
                            <select name="status" class="form-control" required>
                                <option> Choose Status </option>
                                <option value=1>Aktif</option>
                                <option value=0>Non Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txt_kategoriAdd">Hak Akses</label>
                            <select name="hakAkses" class="form-control" required>
                                <option> Choose Hak Akses </option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="SUPERUSER">SUPERUSER</option>
                                <option value="OPERATION">OPERATION</option>
                                <option value="HELPDESK">HELPDESK</option>
                            </select>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        Update User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/getdata_user/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usernamemod">Username</label>
                            <input type="text" id="usernamemod" name="usernamemod" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namamod">Nama</label>
                            <input type="text" id="namamod" name="namamod" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pwmod">Password</label>
                            <div class="input-group-append">
                            <input type="password" id="pwmod" name="pwmod" class="form-control">
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
                        <div class="form-group">
                            <label for="divisimod">Divisi</label>
                            <select id="divisimod" name="divisimod" class="form-control" required>
                                <option> Choose Divisi </option>
                                <option value="ADMINISTRASI">ADMINISTRASI</option>
                                <option value="DEVEL">DEVEL</option>
                                <option value="HELPDESK">HELPDESK</option>
                                <option value="OPERASIONAL">OPERASIONAL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="statusmod">Status</label>
                            <select id="statusmod" name="statusmod" class="form-control" required>
                                <option> Choose Status User </option>
                                <option value="1">AKTIF</option>
                                <option value="0">NON-AKTIF</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hakmod">Hak Akses</label>
                            <select type="text" id="hakmod" name="hakmod" class="form-control">
                            <option> Choose Hak Akses </option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="SUPERUSER">SUPERUSER</option>
                                <option value="HELPDESK">HELPDESK</option>
                                <option value="OPERATION">OPERATION</option>
                            </select>
                        </div>
                    </div>
                    <!-- ... existing code ... -->
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
                username = btn.data('username'),
                nama = btn.data('nama'),
                password = btn.data('password')
                divisi = btn.data('divisi')
                status = btn.data('status')
                hakakses = btn.data('hakakses')

                $('#edit_modal').find('#usernamemod').val(username);
                $('#edit_modal').find('#namamod').val(nama);
                $('#edit_modal').find('#pwmod').val(password);
                $('#edit_modal').find('#divisimod').val(divisi);
                $('#edit_modal').find('#statusmod').val(status);
                $('#edit_modal').find('#hakmod').val(hakakses);
            })
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
                        $('#addUser form').submit();
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

    // membuat fungsi change
    function change() {
    
    // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
    var x = document.getElementById('pwmod').type;

    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
    if (x == 'password') {

        //ubah form input password menjadi text
        document.getElementById('pwmod').type = 'text';
        
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
        document.getElementById('pwmod').type = 'password';

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