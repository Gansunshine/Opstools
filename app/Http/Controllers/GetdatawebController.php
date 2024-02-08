<?php

namespace App\Http\Controllers;

// use App\Models\Rekonweb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GetdatawebController extends Controller
{
    /**
     * Menampilkan daftar data rekonweb.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // URL untuk mengambil data rekonweb dari API eksternal
        $base_url = 'http://10.20.1.175:8090/download_data_lim/web';
        $ch = curl_init($base_url);

        // Data yang akan dikirimkan dalam permintaan API
        $dataRaw = [
            "action" => "post",
            "tanggal" => '20221020',
            "produk" => "all"
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

        // Menampilkan halaman indeks (getdatawebIndex) bersama dengan data hasil parsing dari API
        return view('layouts.getdata.getdatawebIndex', compact(['parsed_json']));
        // return $result;
    }

    // ... fungsi-fungsi lain untuk CRUD (Create, Update, Delete) data dapat diberikan keterangan jika diperlukan ...
}

