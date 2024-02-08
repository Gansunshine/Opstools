    <!DOCTYPE html>
    <html>
    <head>
        <title>Formulir Penambahan Produk Baru</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    </head>
    <style>
        .ttd {
            text-align: center;
        }
        .ttdd {
            text-align: center;
            border-top: 1px solid #000;
            margin-left: 35%;
            width: 30%;
        }
        .keterangan-pinggir {
            float: right;
            margin-left: 20px;
            text-align: right;
        }
        .tableee{
            width: 100%;
            border-collapse: collapse;
        }
    .tablee {
        width: 100%;
        border-collapse: collapse;
        }
        .table-container {
            max-height: calc(100vh - 200px); /* Sesuaikan dengan tinggi footer Anda (di sini digunakan 200px) */
            overflow: auto; /* Tambahkan scrollbar jika kontennya melebihi tinggi maksimum */
            margin-bottom: 10px; /* Sesuaikan dengan tinggi margin yang Anda inginkan antara konten dan footer */
        }
    .textarea-container {
        max-height: calc(100vh - 280px); /* Sesuaikan dengan tinggi footer Anda dan textarea Anda */
        overflow: auto; /* Tambahkan scrollbar jika kontennya melebihi tinggi maksimum */
    }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            width: 30%; /* Mengatur lebar kolom header */
        }
        /* Garis bawah */
        .garis-bawah {
            border-bottom: 1px solid #000;
        }
        /* Garis bawah */
        .garis-bawah-putus {
        border-top: 1px dashed #000;
        }
        /* Watermark */
        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.5;
            font-size: 18px;
        }
        /* Margin pada textarea */
        #detail {
            margin-bottom: 20px;
            border: 1px dashed #000;
            color: #000;
            max-height: 860px; /* Sesuaikan dengan tinggi maksimum yang Anda hitung */
            overflow-y: auto; /* Tambahkan scrollbar jika kontennya melebihi tinggi maksimum */
        }
        /* Gaya untuk mengatur ketinggian baris */
        .compact-row {
            line-height: 0.8; /* Sesuaikan nilai ini sesuai dengan preferensi Anda */
        }
        th.th-small {
            width: 160px;
        }
        td.td-small {
            width: 20px;
        }

        .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: center;
        padding: 10px;
    }

    </style>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="mb-1">Formulir Penambahan Produk Baru</h2>
                    <p class="mb-4">(Add New Produk Form)</p>
                </div>
            </div>
            <div class="garis-bawah"></div>
            <div class="table-container">
                <table class="md-6 tablee">
                    <colgroup>
                        <col style="width: 5px;">
                    </colgroup>
                    <tr class="compact-row">
                        <th class="th-small">Pelapor </th>
                        <td class="td-small">:</td>
                        <td>{{ $namaview }}</td>
                    </tr>
                    <tr class="compact-row">
                        <th class="th-small">Tanggal </th>
                        <td class="td-small">:</td>
                        <td>{{ $tglview }}</td>
                    </tr>
                    <tr class="compact-row">
                        <th class="th-small">No. </th>
                        <td class="td-small">:</td>
                        <td>{{ $noview }}</td>
                    </tr>
                    <tr class="compact-row">
                        <th class="th-small">Produk </th>
                        <td class="td-small">:</td>
                        <td>{{ $jenisview }}</td>
                    </tr>
                    <tr>
                        <th class="th-small">Detail Produk :</th>
                        <td class="td-small">:</td>
                        <td>&nbsp</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="tableee" border="1">
                                <tr>
                                    <th scope="col" style="width: 20px">No.</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Biller ID</th>
                                    <th scope="col">Switching / Biller</th>
                                    <th scope="col">Rp. Admin</th>
                                </tr>
                                @if(isset($produk_data))
                                @foreach(json_decode($produk_data) as $key => $produk)
                                <tr>
                                    <th scope="row" style="width: 20px">{{ $key + 1 }}</th>
                                    <td>{{ $produk->nama_produk_lim }}</td>
                                    <td>{{ $produk->kode_produk_sw }}</td>
                                    <td>{{ $produk->kode_switching }}</td>
                                    <td>{{ $produk->biaya_admin }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <th scope="row" style="width: 20px">1</th>
                                    <td>&nbsp</td>
                                    <td>&nbsp</td>
                                    <td>&nbsp</td>
                                    <td>&nbsp</td>
                                </tr>
                                @endif
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                                <textarea class="form-control" id="detail" rows="37" width="100px" placeholder="Masukkan detail pengajuan">{{ $detailview }}</textarea>
                                
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <div class="garis-bawah-putus"></div>
            <div class="row" style="margin-bottom:65px;">
                <div class="col-md-6 mb-6">
                    <div class="ttd">
                        <p>Mengetahui,</p>
                        <p>Atasan</p></div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="ttd">
                        <p>&nbsp</p>
                        <p>Pelapor</p></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-6">
                    <div class="ttdd">PT.Layanan IMEDIA</div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="ttdd">Divisi Development</div>
                </div>
            </div>
        </div>   
    </body>
    </html>