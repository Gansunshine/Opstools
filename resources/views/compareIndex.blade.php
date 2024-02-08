@extends('tampilan')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Multibiller</h2>
            </div>
        </div>
    </div>
   
    <table class="table table-bordered">
        <tr>
            <th>Name Produk</th>
            <th>Lembar FTR</th>
            <th>Lembar Web</th>
            <th>Lembar Biller</th>
            <th>Jumlah FTR</th>
            <th>Jumlah WEB</th>
            <th>Jumlah Biller</th>
            <!-- <th>Selisih</th> -->
            <!-- <th width="280px">Action</th> -->
        </tr>
        @foreach ($parsed_json as $value)
        <tr>
            <td>{{ $value['nama_produk_lim'] }}</td>
            <td>{{ $value['lembar_ftr'] }}</td>
            <td>{{ $value['lembar_web'] }}</td>
            <td>{{ $value['lbr_biller'] }}</td>
            <td>Rp. <?php echo number_format($value['amount_ftr'],2,',','.'); ?></td>
            <td>Rp. <?php echo number_format($value['amount_web'],2,',','.'); ?></td>
            <td>Rp. <?php echo number_format($value['amount_biller'],2,',','.'); ?> </td>
            <!-- <td>{{ $value['selisih_rptag_ftp_biller'] }}</td> -->
            </td>
        </tr>
        @endforeach
    </table>
      
@endsection