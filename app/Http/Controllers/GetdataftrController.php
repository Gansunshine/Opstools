<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GetdataftrController extends Controller
{
    /**
     * Menampilkan daftar data rekonftr.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('username')) {
        // Mengambil data pengguna dari API eksternal dengan menggunakan HTTP POST
        $base_url = config('api.base_url') . 'Rekapitulasi/get_rekap_data_ftr';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];
        
        return view('layouts.getdata.getdataftrIndex', compact(['data']));
        }
        else{
            Session::flash('flash_message_belumlogin', "Diperlukan Login");   
            return redirect('login');
        }
    }

    public function periode(Request $request)
    {
        // Validasi input dari pengguna menggunakan rule tertentu
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date'
        ]);
        
        // Mendapatkan data yang dikirimkan dari form
        $awal = $request->startDate;
        $akhir = $request->endDate;
        
        // Format tanggal awal dan akhir sesuai dengan format yang diinginkan (Y-m-d)
        $first_date = date('Y-m-d', strtotime($awal));
        $last_date = date('Y-m-d', strtotime($akhir));
        
        // Simpan data tanggal awal, tanggal akhir, kategori, dan status dalam session
        session(['selectedFirstDate' => $first_date]);
        session(['selectedEndDate' => $last_date]);
        
        // URL untuk mendapatkan data complain berdasarkan periode
        $baseurl = config('api.base_url') . 'Rekapitulasi/get_rekap_data_ftr_periode';
        
        // Data yang akan dikirimkan dalam request untuk mendapatkan data complain
        $dataRaw = [
            "start_date" => $first_date,
            "end_date" => $last_date
        ];

        // Melakukan HTTP POST request ke API untuk mendapatkan data complain berdasarkan periode
        $response = Http::withHeaders([])->post($baseurl, $dataRaw);

        // Parsing data JSON yang diterima sebagai hasil request
        $parsed_json = $response->json();
        $data = $parsed_json['data'];

        if ($response->successful()) {
            Session::flash('flash_message_periodeberhasil', "Gagal Menambahkan Data");
            return view('layouts.getdata.getdataftrIndex', compact(['data','first_date', 'last_date']));
        }
        else {
            Session::flash('flash_message_periodegagal', "Gagal Menambahkan Data");
            return redirect('/getdata_ftr');
        }
    }

    public function compare(Request $request)
    {
        // Validasi input dari pengguna menggunakan rule tertentu
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date'
        ]);
        
        // Mendapatkan data yang dikirimkan dari form
        $awal = $request->startDate;
        $akhir = $request->endDate;
        
        // Format tanggal awal dan akhir sesuai dengan format yang diinginkan (Y-m-d)
        $first_date = date('Y-m-d', strtotime($awal));
        $last_date = date('Y-m-d', strtotime($akhir));
        
        // Simpan data tanggal awal, tanggal akhir, kategori, dan status dalam session
        session(['selectedFirstDate' => $first_date]);
        session(['selectedEndDate' => $last_date]);
        
        // URL untuk mendapatkan data complain berdasarkan periode
        $baseurl = config('api.base_url') . 'Rekapitulasi/proses_rekap_data_ftr';
        
        // Data yang akan dikirimkan dalam request untuk mendapatkan data complain
        $dataRaw = [
            "start_date" => $first_date,
            "end_date" => $last_date
        ];

        // Melakukan HTTP POST request ke API untuk mendapatkan data complain berdasarkan periode
        $response = Http::withHeaders([])->post($baseurl, $dataRaw);

        if ($response->successful()) {
            Session::flash('flash_message_periodeberhasil', "Gagal Menambahkan Data");
            return redirect('/getdata_ftr');
        }
        else {
            Session::flash('flash_message_periodegagal', "Gagal Menambahkan Data");
            return redirect('/getdata_ftr');
        }
    }
}

