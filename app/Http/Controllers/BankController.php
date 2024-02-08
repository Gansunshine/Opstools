<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
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
        $base_url = config('api.base_url') . 'MasterData/get_data_bank';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.master_data.bank', compact(['data']));
        }
        else{
            Session::flash('flash_message_belumlogin', "Diperlukan Login");   
            return redirect('login');
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
        // URL untuk mengirim permintaan update data pengguna ke API eksternal
        $base_url = config('api.base_url') . 'MasterData/input_data_bank';

        // Mendapatkan data dari form input untuk update pengguna
        $txt_kodebankadd = $request->txt_kodebankadd;
        $txt_inisialadd = $request->txt_inisialadd;
        $txt_namabankadd = $request->txt_namabankadd;
        $txt_alamatadd = $request->txt_alamatadd;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'kode_bank' => $txt_kodebankadd,
            'inisial_bank' => $txt_inisialadd,
            'nama_bank' => $txt_namabankadd,
            'alamat' => $txt_alamatadd
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $insertbank = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($insertbank->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_bank');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_bank');
        }
    }

    public function hapus(Request $request)
    {
        // URL untuk mengirim permintaan update data pengguna ke API eksternal
        $base_url = config('api.base_url') . 'MasterData/hapus_data_bank';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idbankdlt;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_data_bank' => $idmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_hapusdata', "Berhasil Menghapus Data");
            return redirect('getdata_bank');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_hapusdatagagal', "Gagal Menghapus Data");
            return redirect('getdata_bank');
        }
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
        // URL untuk mengirim permintaan update data pengguna ke API eksternal
        $base_url = config('api.base_url') . 'MasterData/update_data_bank';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idmod;
        $txt_kodebankmod = $request->txt_kodebankmod;
        $txt_inisialmod = $request->txt_inisialmod;
        $txt_namabankmod = $request->txt_namabankmod;
        $txt_alamatmod = $request->txt_alamatmod;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_data_bank' => $idmod,
            'kode_bank' => $txt_kodebankmod,
            'inisial_bank' => $txt_inisialmod,
            'nama_bank' => $txt_namabankmod,
            'alamat' => $txt_alamatmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $insertbank = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($insertbank->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_bank');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_bank');
        }
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