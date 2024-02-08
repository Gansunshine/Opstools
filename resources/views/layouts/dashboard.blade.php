@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
@include('_partial.flash_message')
<style>
.button-container {
    display: flex; /* Mengubah elemen container menjadi flex container */
    align-items: center; /* Mengatur pemosisian vertikal tombol */
}

.button-container button {
    margin-right: 5px; /* Mengatur margin kanan antara tombol */
}
table{
    width: 85%;
    margin:0 auto;
    text:black;
}
    table .switching {
        text-align: left; /* Agar konten di kolom "switching" berada di sisi kiri */
    }
    table .saldo {
        text-align: right; /* Agar konten di kolom "saldo" berada di sisi kanan */
    }
    table .rp {
        text-align: right; /* Agar konten di kolom "saldo" berada di sisi kanan */
        padding-left: 30px;
    }
</style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                    {{-- {{ Session::get('status') }} --}}
                </div>
            </div>
        </div>
    </div>


    <!-- row Informasi Saldo Biller -->
    <div class="row column1 social_media_section">
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons fb margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-comments-o"></i>
                </div>
                <div class="social_cont">
                <ul>
                    <form id="all_comp" action="{{ URL::asset('/dashboard/viewopenstatus ') }}" method="POST">
                        @csrf
                    <input type="hidden" name="kategori" value="complain">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('all_comp').submit();" style="color: #0F0F0F">
                            Complain
                    </li>
                    <li>
                        <span style="color: #0F0F0F">{{ $jumlahdatacomplain }}</span>
                    </li>
                    </a>
                    </form>
                </ul>
                <ul>
                    <form id="proses_comp" action="{{ URL::asset('/dashboard/viewopenstatus ') }}" method="POST">
                        @csrf
                    <input type="hidden" name="kategori" value="complain">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('proses_comp').submit();" style="color: #e93a4b">
                            Open
                    </li>
                    <li>
                        <span style="color: #e93a4b">{{ $jumlahdataopen_complain }}</span>
                    </li>
                    </a>
                    </form>
                </ul>
                <ul>
                    <form id="all_comp" action="{{ URL::asset('/dashboard/viewopenstatus ') }}" method="POST">
                        @csrf
                    <input type="hidden" name="kategori" value="complain">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('all_comp').submit();" style="color: #0F0F0F">
                            Request
                    </li>
                    <li>
                        <span style="color: #0F0F0F">{{ $jumlahdatarequest }}</span>
                    </li>
                    </a>
                    </form>
                </ul>
                <ul>
                    <form id="proses_req" action="{{ URL::asset('/dashboard/viewopenstatus ') }}" method="POST">
                        @csrf
                    <input type="hidden" name="kategori" value="request">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('proses_req').submit();" style="color: #e93a4b">
                            Open
                    </li>
                    <li>
                        <span style="color: #e93a4b">{{ $jumlahdataopen_request }}</span>
                    </li>
                    </a>
                    </form>
                </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons linked margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-money"></i>
                </div>
                <div class="social_cont" id="saldoTableContainer">
                    <center><h4>Saldo</h4></center>
                    <table id="saldoTable">
                        <thead></thead>
                        <tbody>
                            @foreach ($saldo as $value)
                            <tr>
                                <td class="switching">{{ $value['switching'] }}</td>
                                <td class="rp">Rp.</td>
                                <td class="saldo">{{number_format($value['saldo'])}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-file-text "></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Selisih</strong></span>

                        </li>
                        <li>
                            <span><strong>-</strong></span>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full socile_icons linked margin_bottom_30">
                <div class="social_icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="social_cont">
                    <ul>
                        <li>
                            <span><strong>Data</strong></span>

                        </li>
                        <li>
                            <span><strong>-</strong></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end row column1 -->

    <!-- Menu Mitra COmplaint & Request -->
    <div class="row column3">
        <!-- progress bar -->
        <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Progress Bar</h2>
                    </div>
                </div>
                    <div class="full progress_bar_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress_bar">
                                    <!-- Complaint Solved Skill Bar -->
                                    @if ($complainClosePercentage != 0)
                                        <span class="skill" style="width:{{ $complainClosePercentage }}%;">Complaint Solved <span class="info_valume">{{ number_format($complainClosePercentage) }}%</span></span>
                                    @else
                                        <span class="skill" style="width:{{ $complainClosePercentage }}%;">Complaint Solved <span class="info_valume">0%</span></span>
                                    @endif
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                                            aria-valuenow="{{ $complainClosePercentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $complainClosePercentage }}%;">
                                        </div>
                                    </div>

                                    <!-- Request Revolded Skill Bar -->
                                    @if ($requestClosePercentage != 0)
                                        <span class="skill" style="width:{{ $requestClosePercentage }}%;">Request Revolded <span class="info_valume">{{ number_format($requestClosePercentage) }}%</span></span>
                                    @else
                                        <span class="skill" style="width:{{ $requestClosePercentage }}%;">Request Revolded <span class="info_valume">0%</span></span>
                                    @endif
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"
                                            aria-valuenow="{{ $requestClosePercentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $requestClosePercentage }}%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end progress bar -->
    </div>
    <!--  END Menu Mitra COmplaint & Request  -->
    </div>
    </div> <!-- end iiner container -->
    <script>
        function number_format(number) {
            // Fungsi number_format yang digunakan untuk memformat angka
            // Sesuaikan sesuai kebutuhan Anda
            return new Intl.NumberFormat().format(number);
        }
        
        function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
    
        function refreshTable() {
            fetch('getsaldodata', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken(), // Menambahkan token CSRF
                },
                // Body request jika diperlukan
                // body: JSON.stringify({ key: value }),
            })
            .then(response => response.json())
            .then(data => {
                var tableBody = document.querySelector('#saldoTable tbody');
                tableBody.innerHTML = '';
    
                data.forEach(value => {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="switching">${value.switching}</td>
                        <td class="rp">Rp.</td>
                        <td class="saldo">${number_format(value.saldo)}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        setInterval(function() {
            refreshTable();
        }, 5000);
    </script>
@endsection
