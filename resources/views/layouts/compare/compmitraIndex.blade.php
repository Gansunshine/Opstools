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
                    <h2>Multibiller Mitra</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 form-inline">

            <button class="btn btn-primary" id="btn_waktu1">
                <i class="fa fa-calendar"></i> Tanggal
            </button>&nbsp;

            <form action="{{ URL::asset('compare/mitra') }}" method="POST">
            @csrf
            </form>
        </div><br>
    </div>
    <div class="row">
        <div class="col-md-4" id="div_tanggal">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tanggal</h5>
                    <form action="{{ URL::asset('compare/mitra/periode') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            {{-- <label for="txt_tglyaa">Tanggal Awal</label> --}}
                            <input type="date" id="txt_tglyaa" name="txt_tglyaa" class="form-control" required>
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
                <th scope="col">Nama Produk</th>
                <th scope="col">Kode Mitra</th>
                <th scope="col">Lembar FTR</th>
                <th scope="col">Lembar Web</th>
                <th scope="col">Jumlah FTR</th>
                <th scope="col">Jumlah WEB</th>
                <th scope="col">Selisih Lembar</th>
                <th scope="col">Selisih Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($parsed_json as $value)
                    <tr>
                    <td align="center">{{ $loop->iteration }} </th>
                    <td align="center">{{ $value['nama_produk_lim'] }}</td>
                    <td>{{ $value['kode_mitra'] }}</td>
                    <!-- lembar_ftr -->
                    <td align="right">
                        @if ($value['lembar_ftr'] == $value['lembar_web'] )
                            {{ $value['lembar_ftr'] }}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{ $value['lembar_ftr'] }}</span>
                        @endif         
                    </td>
                    <!-- lembar_web -->
                    <td align="right">
                        @if ($value['lembar_web'] == $value['lembar_ftr'] )
                            {{ $value['lembar_web'] }}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{ $value['lembar_web'] }}</span>
                        @endif 
                    </td>
                    <!-- amount_ftr -->
                    <td align="right">
                        @if (number_format($value['amount_ftr'],0,',') == number_format($value['amount_web'],0,','))
                            {{number_format($value['amount_ftr'],0,',')}}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['amount_ftr'],0,',')}}</span>
                        @endif         
                    </td>
                    <!-- amount_web -->
                    <td align="right">
                        @if (number_format($value['amount_web'],0,',') == number_format($value['amount_ftr'],0,','))
                            {{number_format($value['amount_web'],0,',')}}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['amount_web'],0,',')}}</span>
                        @endif
                    </td>
                    <!-- selisih_lembar -->
                    <td align="right">
                        @if (number_format($value['selisih_lembar'],0,',') == number_format($value['selisih_amount'],0,','))
                            {{number_format($value['selisih_lembar'],0,',')}}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_lembar'],0,',')}}</span>
                        @endif
                    </td>
                    <!-- selisih_amount -->
                    <td align="right">
                        @if (number_format($value['selisih_amount'],0,',') == number_format($value['selisih_lembar'],0,','))
                            {{number_format($value['selisih_amount'],0,',')}}
                        @else
                            <span style="color:#e93a4b;font-weight:bold;">{{number_format($value['selisih_amount'],0,',')}}</span>
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
        $('#btn_waktu1').click(function() {
            $('#div_tanggal').toggle("slow");
        });
    </script>
    <script></script>
@endsection