@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>

    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Multibiller Produk</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">

            <button class="btn btn-primary" id="btn_waktu">
                <i class="fa fa-calendar"></i> Tanggal
            </button>&nbsp;

            <form action="{{ URL::asset('compare/produk') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" id="btn_waktu">
                <i class="fa fa-refresh"></i> Refresh
            </button>
            </form>
        </div><br>
    </div>
    <div class="row">
        <div class="col-md-4" id="div_tanggal">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tanggal</h5>
                    <form action="{{ URL::asset('compare/produk/periode') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            {{-- <label for="txt_tglya">Tanggal Awal</label> --}}
                            <input type="date" id="txt_tglya" name="txt_tglya" class="form-control" required
                                placeholder="First Date">
                        </div>
                       
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-gear"></i> Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div><br>

<div class="col-md-12">
    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover table-striped" id="myTable">
            <thead class="bg-maroon">
                <tr>
                    <th scope="col">No</th>
                    <!-- <th scope="col">Selisih cek</th> -->
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Lembar FTR</th>
                    <th scope="col">Lembar Web</th>
                    <th scope="col">Lembar Biller</th>
                    <th scope="col">Jumlah FTR</th>
                    <th scope="col">Jumlah WEB</th>
                    <th scope="col">Jumlah Biller</th>
                    <th scope="col">Selisih Lembar FTP WEB</th>
                    <th scope="col">Selisih RPTAG FTP WEB</th>
                    <th scope="col">Selisih Lembar FTP Biller</th>
                    <th scope="col">Selisih Lembar RPTAG FTP Biller</th>
                    <th scope="col">Selisih Lembar WEB Biller</th>
                    <th scope="col">Selisih RPTAG WEB Biller</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($parsed_json as $value)
                    <tr>
                        <td align="center">{{ $loop->iteration }} </th>
                        <!-- lembar_ftr -->
                        <!-- <td align="right">
                            <?php
                                $hasil1 = $value['lembar_ftr'] ;
                                $hasil2 = $value['lembar_web'];
                                $jumlah = $hasil1 + $hasil2 ;
                                    echo $jumlah;
                            ?>                    
                        </td> -->
                        <td align="center">{{ $value['nama_produk_lim'] }}</td>
                        <!-- lembar_ftr -->
                        <td align="right">
                            @if ($value['lembar_ftr'] == $value['lembar_web'])
                                {{ $value['lembar_ftr'] }}
                            @elseif ($value['lembar_ftr'] == $value['lbr_biller'])
                                {{ $value['lembar_ftr'] }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['lembar_ftr'] }}</span>
                            @endif                            
                        </td>
                        <!-- lembar_web -->
                        <td align="right">
                            @if ($value['lembar_web'] == $value['lembar_ftr'])
                                {{ $value['lembar_web'] }}
                            @elseif ($value['lembar_web'] == $value['lbr_biller'])
                                {{ $value['lembar_web'] }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['lembar_web'] }}</span>
                            @endif
                        </td>
                        <!-- lbr_biller -->
                        <td align="right">
                            @if ($value['lbr_biller'] == $value['lembar_ftr'])
                                {{ $value['lbr_biller'] }}
                            @elseif ($value['lbr_biller'] == $value['lembar_web'])
                                {{ $value['lbr_biller'] }}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{ $value['lbr_biller'] }}</span>
                            @endif
                        </td>
                        <!-- amount_ftr -->
                        <td align="right">
                            @if (number_format($value['amount_ftr'],0,',') == number_format($value['amount_web'],0,','))
                                {{number_format($value['amount_ftr'],0,',')}}
                            @elseif (number_format($value['amount_ftr'],0,',') == number_format($value['amount_biller'],0,','))
                                {{number_format($value['amount_ftr'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['amount_ftr'],0,',')}}</span>
                            @endif                           
                        </td>
                        <!-- amount_web -->
                        <td align="right">
                            @if (number_format($value['amount_web'],0,',') == number_format($value['amount_ftr'],0,','))
                                {{number_format($value['amount_web'],0,',')}}
                            @elseif (number_format($value['amount_web'],0,',') == number_format($value['amount_biller'],0,','))
                                {{number_format($value['amount_web'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['amount_web'],0,',')}}</span>
                            @endif                       
                        </td>
                        <!-- amount_biller -->
                        <td align="right">
                            @if (number_format($value['amount_biller'],0,',') == number_format($value['amount_ftr'],0,','))
                                {{number_format($value['amount_biller'],0,',')}}
                            @elseif (number_format($value['amount_biller'],0,',') == number_format($value['amount_web'],0,','))
                                {{number_format($value['amount_biller'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['amount_biller'],0,',')}}</span>
                            @endif
                        </td>
                        <!-- selisih_lbr_ftp_web -->
                        <td align="right">
                            @if (number_format($value['selisih_lbr_ftp_web'],0,',') == 0 )
                                {{number_format($value['selisih_lbr_ftp_web'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_lbr_ftp_web'],0,',')}}</span>
                            @endif
                        </td>
                        <!-- selisih_rptag_ftp_web -->
                        <td align="right">
                            @if (number_format($value['selisih_rptag_ftp_web'],0,',') == 0 )
                                {{number_format($value['selisih_rptag_ftp_web'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_rptag_ftp_web'],0,',')}}</span>
                            @endif
                        </td>
                        <!-- selisih_lbr_ftp_biller -->
                        <td align="right">
                            @if (number_format($value['selisih_lbr_ftp_biller'],0,',') == 0 )
                                {{number_format($value['selisih_lbr_ftp_biller'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_lbr_ftp_biller'],0,',')}}</span>
                            @endif
                        </td>
                        <!-- selisih_rptag_ftp_biller -->
                        <td align="right">
                            @if (number_format($value['selisih_rptag_ftp_biller'],0,',') == 0 )
                                {{number_format($value['selisih_rptag_ftp_biller'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_rptag_ftp_biller'],0,',')}}</span>
                            @endif                            
                        </td>
                         <!-- selisih_lbr_web_biller -->
                         <td align="right">
                            @if (number_format($value['selisih_lbr_web_biller'],0,',') == 0 )
                                {{number_format($value['selisih_lbr_web_biller'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_lbr_web_biller'],0,',')}}</span>
                            @endif                            
                        </td>
                         <!-- selisih_rptag_web_biller -->
                         <td align="right">
                            @if (number_format($value['selisih_rptag_web_biller'],0,',') == 0 )
                                {{number_format($value['selisih_rptag_web_biller'],0,',')}}
                            @else
                                <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_rptag_web_biller'],0,',')}}</span>
                            @endif                             
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    {{-- Tutup Container-fluid --}}

    <!-- End Modal -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="{{ URL::asset('public/js/index.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#edit_modal').on('show.bs.modal', function(event) {
                var btn = $(event.relatedTarget),
                    klasifikasi = btn.data('klasifikasi')
            })
        })
        $('#myTable').DataTable();
        $('#div_tanggal').hide(true);
    </script>
    <script>
        $('#btn_waktu').click(function() {
            $('#div_tanggal').toggle("slow");
        });
    </script>
    <script></script>
@endsection