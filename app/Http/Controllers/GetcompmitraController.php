<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Rekonftr;
use App\Models\Rekonweb;
use App\Models\Rekonbiller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GetcompmitraController extends Controller
{
    /**
     * Menampilkan halaman indeks untuk data perbandingan terkait mitra.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Memeriksa apakah sesi 'username' ada (pengguna telah login)
        if (session()->has('username')) {
            // URL untuk mengambil data perbandingan dari API eksternal
            $base_url = 'http://10.20.1.175:8090/compare_data_lim';
            $ch = curl_init($base_url);

            // Data yang akan dikirimkan dalam permintaan API
            $dataRaw = [
                "tanggal" => '20220919',
                "filter" => "mitra"
            ];

            // Konfigurasi permintaan cURL
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataRaw));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Melakukan permintaan ke API eksternal dan mendapatkan respons
            $result = curl_exec($ch);
            curl_close($ch);

            // Parsing data JSON yang diterima dari API eksternal
            $parsed_json = json_decode($result, true);

            // Mengambil data produk, Rekonftr, Rekonweb, dan Rekonbiller dari database
            $dataProduk = Produk::all();
            $dataFtr = Rekonftr::all();
            $dataWeb = Rekonweb::all();
            $dataBiller = Rekonbiller::all();

            // Menampilkan halaman indeks (compmitraIndex) bersama dengan data hasil parsing dari API dan data dari database
            return view('layouts.compare.compmitraIndex', compact(['parsed_json', 'dataProduk', 'dataFtr', 'dataWeb', 'dataBiller']));
        } else {
            // Jika sesi 'username' tidak ada, arahkan pengguna ke halaman login
            return redirect('login');
        }
    }

    /**
     * Menampilkan data perbandingan berdasarkan tanggal tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function waktu1(Request $request)
    {
        // Mendapatkan tanggal dari request dan melakukan pengolahan agar format sesuai dengan yang diharapkan
        $tanggal1 = preg_replace("/[^0-9]/", "", $request['txt_tglyaa']);
        $date1 = str_replace(array('/','-',),'',$tanggal1);

        // URL untuk mengambil data perbandingan dari API eksternal
        $base_url = 'http://10.20.1.175:8090/compare_data_lim';
        $ch = curl_init($base_url);

        // Data yang akan dikirimkan dalam permintaan API berdasarkan tanggal yang diberikan
        $dataRaw = [
            "action" => "post",
            "tanggal" => $date1,
            "filter" => "mitra"
        ];

        // Konfigurasi permintaan cURL
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataRaw));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Melakukan permintaan ke API eksternal dan mendapatkan respons
        $result = curl_exec($ch);
        curl_close($ch);

        // Parsing data JSON yang diterima dari API eksternal
        $parsed_json = json_decode($result, true);

        // Mengambil data produk, Rekonftr, Rekonweb, dan Rekonbiller dari database
        $dataProduk = Produk::all();
        $dataFtr = Rekonftr::all();
        $dataWeb = Rekonweb::all();
        $dataBiller = Rekonbiller::all();

        // Menampilkan halaman indeks (compmitraIndex) bersama dengan data hasil parsing dari API dan data dari database
        return view('layouts.compare.compmitraIndex', compact(['parsed_json', 'dataProduk', 'dataFtr', 'dataWeb', 'dataBiller']));
    }
}
