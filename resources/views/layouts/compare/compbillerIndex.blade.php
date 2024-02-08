@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
@include('_partial.flash_message')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
.scroll {
    max-height: 200px;
    overflow-y: auto;
}
</style>
<!-- Header -->
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Rekapitulasi Data Biller</h2>
            </div>
        </div>
    </div>


    <form action="{{ URL::asset('/rekapitulasi/biller/periode') }}" method="POST" id="complainForm">
        @csrf
        <div class="row">
            <div class="form-group ml-2">
                <label>&nbsp;</label>
                <button type="button" class="btn bg-maroon mb-2 btn-block" data-toggle="modal"
                    data-target="#uploadDataModal">
                    <i class="fa fa-hand-o-up"></i> Upload Data Biller
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
                <label for="switching">Switching:</label>
                <select id="switching" name="switching" class="form-control" required>
                    <option value="all">Pilih Switching</option>
                    @foreach ($dataswitching as $value )
                    <option value="{{ $value['kode_switching'] }}">{{ $value['kode_switching'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-gear"></i> Proses
                </button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover table-striped" id="myTable">
            <thead class="bg-maroon">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Switching</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Lembar Biller</th>
                    <th scope="col">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $value)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $value['tgl_trx'] }}</td>
                    <td>{{ $value['kode_switching'] }}</td>
                    <td align="center">{{ $value['nama_produk'] }}</td>
                    <td>{{ $value['jml_lembar_biller'] }}</td>
                    <td>{{number_format($value['jml_amount_biller'],0,',')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Tutup Container-fluid --}}

<!-- End Modal -->

<!-- Modal for Upload Data -->
<div class="modal fade" id="uploadDataModal" tabindex="-1" role="dialog" aria-labelledby="uploadDataModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-maroon">
                <h5 class="modal-title text-white" id="uploadDataModalLabel">Upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Upload Excel:</h4>
                        <form action="{{ URL::asset('/parsedata_billerexcel/store') }}" method="POST"
                            id="uploadBiller" enctype="multipart/form-data">
                            @csrf
                            <!-- Your form content for uploading Excel goes here -->
                            <div class="form-group">
                                <label>Select Switching:</label>
                                <select id="txt_switching" name="txt_switching" class="form-control" required>
                                    <option value="none">Pilih Switching</option>
                                    <option value="BAKOEL">BAKOEL</option>
                                    <option value="BIMASAKTI">BIMASAKTI</option>
                                    <option value="CPN">CPN</option>
                                    <option value="DJI">DJI</option>
                                    <option value="FORTUNA">FORTUNA</option>
                                    <option value="MITRACOMM">MITRACOMM</option>
                                    <option value="VSI">VSI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload Excel File:</label>
                                <input type="file" name="excel_file" class="form-control-file" required>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary text-white btn-block"
                                    id="btn_uploadBiller">
                                    <i class="fa fa-edit"></i> Upload Excel
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h4>Upload CSV:</h4>
                        <form action="{{ URL::asset('/parsedata_billercsv/store') }}" method="POST"
                            id="uploadBillercsv" enctype="multipart/form-data">
                            @csrf
                            <!-- Your form content for uploading CSV goes here -->
                            <div class="form-group">
                                <label>Select Switching:</label>
                                <select id="txt_switching_csv" name="txt_switching_csv" class="form-control" required>
                                    <option value="none">Pilih Switching</option>
                                    <option value="BAKOEL">BAKOEL</option>
                                    <option value="BIMASAKTI">BIMASAKTI</option>
                                    <option value="CPN">CPN</option>
                                    <option value="DJI">DJI</option>
                                    <option value="FORTUNA">FORTUNA</option>
                                    <option value="MITRACOMM">MITRACOMM</option>
                                    <option value="VSI">VSI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload CSV File:</label>
                                <input type="file" name="csvFile" class="form-control-file" required>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary text-white btn-block"
                                    id="btn_uploadBillercsv">
                                    <i class="fa fa-edit"></i> Upload CSV
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Proses Compare Biller:</h4>
                        <form action="{{ URL::asset('/parsedata_biller/proses_compare') }}" method="POST"
                            id="proses_compare">
                            @csrf
                            <div class="form-group">
                                <button type="button" class="btn btn-primary text-white btn-block" id="proses">
                                    <i class="fa fa-upload"></i> Proses Rekap
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="loading-screen">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body scroll">
                            <h5 class="card-title">Respons Sukses</h5>
                            <p class="card-text">
                                @if(isset($successResponses))
                                {{ $successResponses }}
                                @else
                                Lakukan Upload Untuk Melihat Response!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body scroll">
                            <h5 class="card-title">Respons Gagal</h5>
                            <p class="card-text">
                                @if(isset($otherResponses))
                                {{ $otherResponses }}
                                @else
                                Lakukan Upload Untuk Melihat Response!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body scroll">
                            <h5 class="card-title">Log Respons</h5>
                            @if(isset($responses))
                            @foreach($responses as $response)
                            <p>{{ $response }}</p>
                            @endforeach
                            @else
                            Lakukan Upload Untuk Melihat Log!
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="{{ URL::asset('public/js/index.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   <script>
    // Event saat seluruh konten halaman selesai dimuat
    window.onload = function() {
        $(".loading-screen").hide();
    };
    
    $('#myTable').DataTable({
            "pageLength" : 50
        });

    $('#btn_gagal').click(function() {
        swal("Input Gagal!", "Anda Belum Login ", "error");
    });
    $('#btn_gagalup').click(function() {
        swal("Update Gagal!", "Anda Belum Login ", "error");
    });

    $('#btn_uploadBiller').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Upload Data?',
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
                        $('#uploadBiller').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    $('#btn_uploadBillercsv').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Upload Data?',
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
                        $('#uploadBillercsv').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    $('#proses').click(function() {
        // Show SweetAlert2 confirmation modal for saving data
        Swal.fire({
            title: 'Rekapitulasi Data?',
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
                        $('#proses_compare').submit();
                    }, 1000); // Waktu jeda simulasi loading dalam milidetik (misal: 1000 ms = 1 detik)
                }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const startDateInput = document.getElementById("startDate");
        const endDateInput = document.getElementById("endDate");

        // Mendapatkan tanggal hari ini
        const today = new Date();
        // Dapatkan tanggal saat ini dalam format YYYY-MM-DD
        var todayy = new Date().toISOString().split('T')[0];
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0"); // +1 karena bulan dimulai dari 0
        const day = "01"; // Untuk startDate selalu diatur ke tanggal 1

        // Atur nilai default untuk startDate dan endDate
        startDateInput.value = `${year}-${month}-${day}`;
        endDateInput.value = todayy;
    });
</script>
<script>
    $(document).ready(function() {
        @php
            $flash_message_uploadberhasil = session('flash_message_uploadberhasil');
        @endphp
        if ('{{ $flash_message_uploadberhasil }}' === 'Upload berhasil') {
            $('#uploadDataModal').modal('show');
        }
    });
</script>
<script>
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
            startDate = new Date(today.getFullYear(), 1, 01).toISOString().split("T")[0];
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
        default:
            startDate = "";
            endDate = "";
            break;
    }

    startDateInput.value = startDate;
    endDateInput.value = endDate;
});

document.getElementById("periode").dispatchEvent(new Event("change"));
</script>
@endsection