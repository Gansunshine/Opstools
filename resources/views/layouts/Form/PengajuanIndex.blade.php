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
                    <h2>Data Pengajuan</h2>
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
                        <th scope="col">No. Pengajuan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Nama Pelapor</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parsed_json as $value)
                    <tr>
                        <th scope="row">{{ $loop->iteration }} </th>
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
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning text-white btn-sm mr-2" data-toggle="modal"
                                    data-target="#edit_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgl="{{ $value['tgl_laporan'] }}"
                                    data-status="{{ $value['status'] }}" data-keterangan="{{ $value['ket_laporan'] }}"
                                    data-nama="{{ $value['nama_pelapor'] }}" data-detail="{{ $value['detail_laporan'] }}"
                                    data-userinput="{{ $value['user_input'] }}" data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}"
                                    data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}" data-userupdate="{{ $value['user_update'] }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-secondary text-white btn-sm" data-toggle="modal"
                                    data-target="#view_modal" data-id="{{ $value['id_laporan'] }}"
                                    data-no="{{ $value['no_laporan'] }}" data-tgl="{{ $value['tgl_laporan'] }}"
                                    data-status="{{ $value['status'] }}" data-keterangan="{{ $value['ket_laporan'] }}"
                                    data-nama="{{ $value['nama_pelapor'] }}" data-detail="{{ $value['detail_laporan'] }}"
                                    data-userinput="{{ $value['user_input'] }}" data-tgljaminput="{{ $value['tgl_jam_input_laporan'] }}"
                                    data-tgljamupdate="{{ $value['tgl_jam_update_laporan'] }}" data-userupdate="{{ $value['user_update'] }}">
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
                <form action="{{ URL::asset('/form_pengajuan/store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Pengajuan</label>
                            <input type="date" name="txt_tglpengajuan" id="txt_tglpengajuan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelapor</label>
                            <input type="text" name="txt_namapelapor" id="txt_namapelapor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Detail Pengajuan</label>
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
                        Update Pengajuan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_pengajuan/update') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input</label>
                                    <input type="text" name="tgljaminputmod" id="tgljaminputmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Pengajuan</label>
                                    <input type="hidden" name="idmod" id="idmod">
                                    <input type="text" name="nomod" id="nomod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengajuan</label>
                                    <input type="text" name="tglmod" id="tglmod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="namamod" id="namamod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Pengajuan</label>
                                    <select name="statusmod" id="statusmod" class="form-control" required>
                                        <option value="1">Open</option>
                                        <option value="0">Close</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="userinputmod" id="userinputmod" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="userupdatemod" id="userupdatemod" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detail Pengajuan</label>
                                    <textarea type="text" name="detailmod" id="detailmod" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan Pengajuan</label>
                                    <textarea type="text" name="keteranganmod" id="keteranganmod" class="form-control" required></textarea>
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
                        View Pengajuan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL::asset('/form_pengajuan/pdf') }}" method="POST" id="form_edit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Input</label>
                                    <input type="text" name="tgljaminputview" id="tgljaminputview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Pengajuan</label>
                                    <input type="text" name="noview" id="noview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengajuan</label>
                                    <input type="text" name="tglview" id="tglview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pelapor</label>
                                    <input type="text" name="namaview" id="namaview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Pengajuan</label>
                                    <input type="text" name="statusview" id="statusview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Input</label>
                                    <input type="text" name="userinputview" id="userinputview" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Update</label>
                                    <input type="text" name="userupdateview" id="userupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal & Jam Update</label>
                                    <input type="text" name="tgljamupdateview" id="tgljamupdateview" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detail Pengajuan</label>
                                    <textarea type="text" name="detailview" id="detailview" class="form-control" required readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan Pengajuan</label>
                                    <textarea type="text" name="keteranganview" id="keteranganview" class="form-control" required readonly></textarea>
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
                    status = btn.data('status'),
                    keterangan = btn.data('keterangan'),
                    nama = btn.data('nama'),
                    detail = btn.data('detail'),
                    userinput = btn.data('userinput'),
                    tgljaminput = btn.data('tgljaminput'),
                    userupdate = btn.data('userupdate');

                $('#edit_modal').find('#idmod').val(id);
                $('#edit_modal').find('#nomod').val(no);
                $('#edit_modal').find('#tglmod').val(tgl);
                $('#edit_modal').find('#statusmod').val(status);
                $('#edit_modal').find('#keteranganmod').val(keterangan);
                $('#edit_modal').find('#namamod').val(nama);
                $('#edit_modal').find('#detailmod').val(detail);
                $('#edit_modal').find('#userinputmod').val(userinput);
                $('#edit_modal').find('#tgljaminputmod').val(tgljaminput);
                $('#edit_modal').find('#userupdatemod').val(userupdate);
            });
        
            $('#view_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    no = btn.data('no'),
                    tgl = btn.data('tgl'),
                    status = btn.data('status'),
                    keterangan = btn.data('keterangan'),
                    nama = btn.data('nama'),
                    detail = btn.data('detail'),
                    userinput = btn.data('userinput'),
                    tgljaminput = btn.data('tgljaminput'),
                    tgljamupdate = btn.data('tgljamupdate'),
                    userupdate = btn.data('userupdate');    
            
                if (tgljamupdate === tgljaminput) {
                    $('#tgljamupdateview').val("Belum Ada Update");
                } else {
                    $('#tgljamupdateview').val(tgljamupdate);
                }

                var statusText = (status == 1) ? "OPEN" : "CLOSE";
            
                $('#view_modal').find('#noview').val(no);
                $('#view_modal').find('#tglview').val(tgl);
                $('#view_modal').find('#statusview').val(statusText);
                $('#view_modal').find('#keteranganview').val(keterangan);
                $('#view_modal').find('#namaview').val(nama);
                $('#view_modal').find('#detailview').val(detail);
                $('#view_modal').find('#userinputview').val(userinput);
                $('#view_modal').find('#tgljaminputview').val(tgljaminput);
                $('#view_modal').find('#userupdateview').val(userupdate);
            });
        });


        // Event saat seluruh konten halaman selesai dimuat
        window.onload = function() {
            $(".loading-screen").hide();
        };

        $('#myTable').DataTable({
            "pageLength" : 50,
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
            var namaviewInput = document.getElementById('namaview');
            var tglviewInput = document.getElementById('tglview');
            var noviewInput = document.getElementById('noview');
            var detailviewInput = document.getElementById('detailview');
            var cetakPdfLink = document.getElementById('cetak-pdf-link');
            
            // Saat tautan "Cetak PDF" diklik
            cetakPdfLink.addEventListener('click', function (event) {
                event.preventDefault();
        
                // Ambil nilai-nilai dari input
                var namaviewValue = namaviewInput.value;
                var tglviewValue = tglviewInput.value;
                var noviewValue = noviewInput.value;
                var detailviewValue = detailviewInput.value;
        
                // Buat URL dengan parameter nilai
                var pdfUrl = "{{ route('printPDF', ['namaview' => 'PLACEHOLDER_NAMAVIEW', 'tglview' => 'PLACEHOLDER_TGLVIEW', 'noview' => 'PLACEHOLDER_NOVIEW', 'detailview' => 'PLACEHOLDER_DETAILVIEW']) }}"
                .replace('PLACEHOLDER_NAMAVIEW', encodeURIComponent(namaviewValue))
                .replace('PLACEHOLDER_TGLVIEW', encodeURIComponent(tglviewValue))
                .replace('PLACEHOLDER_NOVIEW', encodeURIComponent(noviewValue))
                .replace('PLACEHOLDER_DETAILVIEW', encodeURIComponent(detailviewValue));

        
                // Buka tautan PDF di tab baru
                window.open(pdfUrl, '_blank');
            });
        });
    </script>
    
@endsection