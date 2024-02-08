<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('username')) {

        $baseurl_saldo = config('api.base_url') . 'dasboard/get_saldo_switching';

        $response = Http::withHeaders([])->post($baseurl_saldo);
        $saldo = $response->json();
        
        $baseurl = config('api.base_url') . 'Complain/get_complain_sortir';
        $response = Http::withHeaders([])->post($baseurl);
        $parsed_json = $response->json();
        $dataprogressbar = $response->json();

        $jumlahdatacomplain = 0;
        $jumlahdatarequest = 0;
        $jumlahdataopen_complain = 0;
        $jumlahdataopen_request = 0;
        $jumlahdataclose_complain = 0;
        $jumlahdataclose_request = 0;

        foreach ($parsed_json as $data) { // Berfungsi untuk Menghitung Jumlah Data dengan kategori Complain
            if ($data['kategori'] === 'complain') {
                $jumlahdatacomplain++;
                if ($data['status'] === '0') {
                    $jumlahdataclose_complain++;
                }
                else if ($data['status'] === '1') {
                    $jumlahdataopen_complain++;
                }
            }
        }
        foreach ($parsed_json as $data) { // Berfungsi untuk Menghitung Jumlah Data dengan kategori Request
            if ($data['kategori'] === 'request') {
                $jumlahdatarequest++;
                if ($data['status'] === '0') {
                    $jumlahdataclose_request++;
                }
                else if ($data['status'] === '1') {
                    $jumlahdataopen_request++;
                }
            }
        }

        // Berfungsi untuk Cek apakah $jumlahdatacomplain tidak nol
    if ($jumlahdatacomplain != 0) {
        $complainClosePercentage = ($jumlahdataclose_complain / $jumlahdatacomplain) * 100;
    } else {
        $complainClosePercentage = 0; // Atur persentase menjadi 0 atau nilai default
    }

    // Berfungsi untuk Cek apakah $jumlahdatarequest tidak nol
    if ($jumlahdatarequest != 0) {
        $requestClosePercentage = ($jumlahdataclose_request / $jumlahdatarequest) * 100;
    } else {
        $requestClosePercentage = 0; // Atur persentase menjadi 0 atau nilai default
    }

        return view('layouts.dashboard', compact( // Berfungsi untuk mengarahkan Pengguna ke halaman dashboard beserta data yang sudah ditentukan
            'saldo',
            'parsed_json',
            'complainClosePercentage',
            'requestClosePercentage',
            'jumlahdataopen_complain',
            'jumlahdataopen_request',
            'jumlahdatacomplain',
            'jumlahdatarequest'
        ));
    }
    else{
        Session::flash('flash_message_belumlogin', "Diperlukan Login");
        return redirect('login');
    }
    }

    public function getSaldoData()
    {
        // Lakukan pengambilan data saldo atau pemrosesan yang dibutuhkan
        $baseurl_saldo = config('api.base_url') . 'dasboard/get_saldo_switching';
        $response_saldo = Http::withHeaders([])->post($baseurl_saldo);
        $saldoData = $response_saldo->json();

        // Kembalikan data dalam format JSON
        return response()->json($saldoData);
    }

    public function tocomplain(Request $request)
    {   

        $request->validate([
            'kategori' => 'required'
        ]);
        
        $kategori = $request->kategori;

        session(['selectedKategori' => $kategori]);

        $baseurl = config('api.base_url') . 'dasboard/view_data_kategori_complain_request';

        $dataRaw = [
            "kategori"=> $kategori
        ];

        // return $dataRaw;

        $response = Http::withHeaders([
            ])->post($baseurl,$dataRaw);
        if ($response->successful()) {
        $parsed_json = $response->json();
        $dataMitra = Mitra::all();
        $dataKlasifikasi = Klasifikasi::all();
        Session::flash('flash_message_kategoriberhasil', "Berhasil Mengupdate Data");
        return view('layouts.complain.kategori', compact(['parsed_json', 'dataMitra', 'dataKlasifikasi', 'kategori']));
        }
        else{
            Session::flash('flash_message_kategorigagal', "Berhasil Mengupdate Data");
            return redirect('dashboard');
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
