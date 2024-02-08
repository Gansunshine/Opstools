<?php

namespace App\Http\Controllers;

use App\Models\switching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RekapitulasiBillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('username')) {
        // Mengambil data pengguna dari API eksternal dengan menggunakan HTTP POST
        $base_url = config('api.base_url') . 'Rekapitulasi/get_rekap_data_biller';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Mendapatkan data semua dari database
        $dataswitching = switching::all();
        
        return view('layouts.compare.compbillerIndex', compact(['data', 'dataswitching']));
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
            'endDate' => 'required|date',
            'switching' => 'required'
        ]);
        
        // Mendapatkan data yang dikirimkan dari form
        $awal = $request->startDate;
        $akhir = $request->endDate;
        $switching = $request->switching;

        // Mendapatkan data semua dari database
        $dataswitching = switching::all();
        
        // Format tanggal awal dan akhir sesuai dengan format yang diinginkan (Y-m-d)
        $first_date = date('Y-m-d', strtotime($awal));
        $last_date = date('Y-m-d', strtotime($akhir));
        
        // Simpan data tanggal awal, tanggal akhir, kategori, dan status dalam session
        session(['selectedFirstDate' => $first_date]);
        session(['selectedEndDate' => $last_date]);
        session(['selectedStatus' => $switching]);
        
        // URL untuk mendapatkan data complain berdasarkan periode
        $baseurl = config('api.base_url') . 'Rekapitulasi/get_rekap_data_biller_periode';
        
        // Data yang akan dikirimkan dalam request untuk mendapatkan data complain
        $dataRaw = [
            "start_date" => $first_date,
            "end_date" => $last_date,
            "kode_switching" => $switching
        ];

        // Melakukan HTTP POST request ke API untuk mendapatkan data complain berdasarkan periode
        $response = Http::withHeaders([])->post($baseurl, $dataRaw);

        // Parsing data JSON yang diterima sebagai hasil request
        $parsed_json = $response->json();
        $data = $parsed_json['data'];

        if ($response->successful()) {
            Session::flash('flash_message_periodeberhasil', "Gagal Menambahkan Data");
            return view('layouts.compare.compbillerperiodeIndex', compact(['data','first_date', 'last_date', 'switching','dataswitching']));
        }
        else {
            Session::flash('flash_message_periodegagal', "Gagal Menambahkan Data");
            return redirect('/rekapitulasi/biller');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
