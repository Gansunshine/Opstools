<!DOCTYPE html>
<html>
<head>
    <title>Formulir Laporan Kesalahan Sistem</title>
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
    table {
        width: 100%;
        border-collapse: collapse;
        height: 1100px;
        margin-bottom: 20px
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
    }
    /* Gaya untuk mengatur ketinggian baris */
    .compact-row {
        line-height: 0.8; /* Sesuaikan nilai ini sesuai dengan preferensi Anda */
    }
    th.th-small {
        width: 210px;
    }
    td.td-small {
        width: 20px;
    }
</style>
<body>
    <div class="container mt-4">
        <h2 class="mb-1 text-center">Formulir Laporan Kesalahan Sistem</h2>
        <p class="mb-4 text-center">(Bug Report Form)</p>
        <div class="garis-bawah"></div>
        <table class="mb-6">
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
                <th class="th-small">Modul </th>
                <td class="td-small">:</td>
                <td>{{ $modulview }}</td>
            </tr>
            <tr class="compact-row">
                <th class="th-small">Proses </th>
                <td class="td-small">:</td>
                <td>{{ $prosesview }}</td>
            </tr>
            <tr>
                <th class="th-small">Kronologis Permasalahan </th>
                <td class="td-small">:</td>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td colspan="3">
                    <textarea class="form-control" id="detail" rows="38" width="100px">{{ $kronologiview }}</textarea>
                </td>
            </tr>
            <tr class="compact-row-1">
                <th class="th-small">Status </th>
                <td class="td-small">:</td>
                <td>{{ $statusview }}</td>
            </tr>
        </table>
        <div class="garis-bawah-putus"></div>
        <div class="row" style="margin-bottom:80px;">
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
    <script>
        window.onload = function() {
            window.print(); // Pemicu pencetakan saat halaman selesai dimuat
        };
    </script>
</body>
</html>
