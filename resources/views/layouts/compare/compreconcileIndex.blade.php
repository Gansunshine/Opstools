@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    @include('_partial.flash_message')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>

    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Compare Reconcile</h2>
                </div>
            </div>
        </div>
    
    
        <form action="{{ URL::asset('/compare/recon/periode') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group ml-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn bg-maroon mb-2 btn-block" data-toggle="modal"
                        data-target="#rekapDataModal">
                        <i class="fa fa-hand-o-up"></i> Rekap Data Reconcile
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
                    @if (isset($first_date))
                    <input type="date" id="startDatee" name="startDate" class="form-control" value="{{$first_date}}">
                    @else
                    <input type="date" id="startDate" name="startDate" class="form-control" placeholder="First Date">
                    @endif
                </div>
                <div class="form-group ml-2">
                    <label for="endDate">End Date:</label>
                    @if (isset($last_date))
                    <input type="date" id="endDatee" name="endDate" class="form-control" value="{{$last_date}}">
                    @else
                    <input type="date" id="endDate" name="endDate" class="form-control" placeholder="Last Date">
                    @endif
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
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Lembar FTR</th>
                    <th scope="col">Lembar Biller</th>
                    <th scope="col">Jumlah FTR</th>
                    <th scope="col">Jumlah Biller</th>
                    <th scope="col">Selisih Lembar FTR</th>
                    <th scope="col">Selisih Lembar Biller</th>
                    <th scope="col">Selisih Jumlah FTR</th>
                    <th scope="col">Selisih Jumlah Biller</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $value)
                    <tr>
                        <td align="center">{{ $loop->iteration }} </th>
                        <td align="center">{{ $value['tgl_trx'] }}</td>
                        <td align="center">{{ $value['nama_produk'] }}</td>
                        <td align="right">
                            @if ($value['jml_lembar_ftr'] == $value['jml_lembar_biller'])
                                {{ $value['jml_lembar_ftr'] }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['jml_lembar_ftr'] }}</span>
                            @endif                            
                        </td>
                        <td align="right">
                            @if ($value['jml_lembar_biller'] == $value['jml_lembar_ftr'])
                                {{ $value['jml_lembar_biller'] }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['jml_lembar_biller'] }}</span>
                            @endif  
                        </td>
                        <td align="right">
                            @if ($value['jml_amount_ftr'] == $value['jml_amount_ftr'])
                            {{ number_format($value['jml_amount_ftr']) }}
                            @else
                            <span style="color:#e93a4b;font-weight:bold;">{{ number_format($value['jml_amount_ftr']) }}</span>
                            @endif 
                        </td>
                        <td align="right">
                            @if ($value['jml_amount_biller'] == $value['jml_amount_ftr'])
                                {{ number_format($value['jml_amount_biller']) }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ number_format($value['jml_amount_biller']) }}</span>
                            @endif 
                        </td>
                        <td align="right">
                            @if ($value['selisih_lembar_ftr'] == $value['selisih_lembar_biller'])
                                {{$value['selisih_lembar_ftr']}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['selisih_lembar_ftr'] }}</span>
                            @endif                
                        </td>
                        <td align="right">
                            @if ($value['selisih_lembar_biller'] == $value['selisih_lembar_ftr'])
                                {{$value['selisih_lembar_biller']}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['selisih_lembar_biller'] }}</span>
                            @endif                    
                        </td>
                        <td align="right">
                            @if ($value['selisih_amount_ftr'] == $value['selisih_amount_biller'])
                            {{ number_format($value['selisih_amount_ftr']) }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ number_format($value['selisih_amount_ftr']) }}</span>
                            @endif                
                        </td>
                        <td align="right">
                            @if ($value['selisih_amount_biller'] == $value['selisih_amount_ftr'])
                            {{ number_format($value['selisih_amount_biller']) }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ number_format($value['selisih_amount_biller']) }}</span>
                            @endif                    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    {{-- Tutup Container-fluid --}}
    <!-- Modal for Upload Data -->
    <div class="modal fade" id="rekapDataModal" tabindex="-1" role="dialog" aria-labelledby="rekapDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="rekapDataModalLabel">Upload Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Proses Compare FTR:</h4>
                            <form action="{{ URL::asset('/compare/recon/proses_compare') }}" method="POST"
                                id="proses_compare">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date:</label>
                                            <input type="date" name="startDate" id="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            <input type="date" name="endDate" id="end_date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary text-white btn-block" id="proses">
                                                <i class="fa fa-upload"></i> Proses Rekap
                                            </button>
                                        </div>
                                    </div>
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
        $('#myTable').DataTable({
            "pageLength" : 50
        });

        document.addEventListener("DOMContentLoaded", function() {
        const startDateInput = document.getElementById("start_date");
        const endDateInput = document.getElementById("end_date");

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
        });document.addEventListener("DOMContentLoaded", function() {
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

    document.addEventListener("DOMContentLoaded", function() {
        const startDateInput = document.getElementById("start_date");
        const endDateInput = document.getElementById("end_date");

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
    @if (isset($first_date))
    <script>
    document.getElementById("periode").addEventListener("change", function () {
        const today = new Date();
        const startDateInput = document.getElementById("startDatee");
        const endDateInput = document.getElementById("endDatee");
    
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
                startDate = $first_date;
                endDate = $last_date;
                break;
        }
    
        startDateInput.value = startDate;
        endDateInput.value = endDate;
    });
    
    document.getElementById("periode").dispatchEvent(new Event("change"));
    </script>
    @else
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
@endif
@endsection