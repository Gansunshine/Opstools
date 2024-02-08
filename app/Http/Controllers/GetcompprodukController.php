<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Rekonftr;
use App\Models\Rekonweb;
use App\Models\Rekonbiller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GetcompprodukController extends Controller
{
    /**
     * Menampilkan daftar data perbandingan terkait produk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // URL untuk mengambil data perbandingan dari API eksternal
        $base_url = 'http://10.20.1.175:8090/compare_data_lim';
        $ch = curl_init($base_url);

        // Data yang akan dikirimkan dalam permintaan API
        $dataRaw = [
            "action" => "post",
            "tanggal" => '20220919',
            "filter" => "produk"
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

        // Menampilkan halaman indeks (compprodukIndex) bersama dengan data hasil parsing dari API dan data dari database
        return view('layouts.compare.compprodukIndex', compact(['parsed_json', 'dataProduk', 'dataFtr', 'dataWeb', 'dataBiller']));
    }

    /**
     * Menampilkan data perbandingan berdasarkan tanggal tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function waktu(Request $request)
    {
        // Mendapatkan tanggal dari request dan melakukan pengolahan agar format sesuai dengan yang diharapkan
        $tanggal = preg_replace("/[^0-9]/", "", $request['txt_tglya']);
        $date = str_replace(array('/','-',),'',$tanggal);

        // URL untuk mengambil data perbandingan dari API eksternal
        $base_url = 'http://10.20.1.175:8090/compare_data_lim';
        $ch = curl_init($base_url);

        // Data yang akan dikirimkan dalam permintaan API berdasarkan tanggal yang diberikan
        $dataRaw = [
            "action" => "post",
            "tanggal" => $date,
            "filter" => "produk"
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

        // Mengambil data produk dari database
        $dataProduk = Produk::all();

        // Menampilkan halaman indeks (compprodukIndex) bersama dengan data hasil parsing dari API dan data dari database
        return view('layouts.compare.compprodukIndex', compact(['parsed_json', 'dataProduk']));
    }

    // ... fungsi-fungsi lain untuk CRUD (Create, Update, Delete) data dapat diberikan keterangan jika diperlukan ...
}

