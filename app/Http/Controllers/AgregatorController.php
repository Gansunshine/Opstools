<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AgregatorController extends Controller
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
        $base_url = config('api.base_url') . 'MasterData/get_data_agregator';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.master_data.agregator', compact(['data']));
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
        $base_url = config('api.base_url') . 'MasterData/input_data_agregator';

        // Mendapatkan data dari form input untuk update pengguna
        $txt_kodeagregatoradd = $request->txt_kodeagregatoradd;
        $txt_namaagregatoradd = $request->txt_namaagregatoradd;
        $txt_alamatagregatoradd = $request->txt_alamatagregatoradd;
        $txt_emailadd = $request->txt_emailadd;
        $txt_contactadd = $request->txt_contactadd;
        $txt_bankidadd = $request->txt_bankidadd;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'kode_agregator' => $txt_kodeagregatoradd,
            'nama_agregator' => $txt_namaagregatoradd,
            'alamat_agregator' => $txt_alamatagregatoradd,
            'email_agregator' => $txt_emailadd,
            'contact_person' => $txt_contactadd,
            'bank_id' => $txt_bankidadd
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_agregator');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_agregator');
        }
    }

    public function hapus(Request $request)
    {
        // URL untuk mengirim permintaan update data pengguna ke API eksternal
        $base_url = config('api.base_url') . 'MasterData/hapus_data_agregator';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idagregatordlt;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_agregator' => $idmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_hapusdata', "Berhasil Menghapus Data");
            return redirect('getdata_agregator');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_hapusdatagagal', "Gagal Menghapus Data");
            return redirect('getdata_agregator');
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
        $base_url = config('api.base_url') . 'MasterData/update_data_agregator';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idmod;
        $txt_kodeagregatormod = $request->txt_kodeagregatormod;
        $txt_namaagregatormod = $request->txt_namaagregatormod;
        $txt_alamatagregatormod = $request->txt_alamatagregatormod;
        $txt_emailmod = $request->txt_emailmod;
        $txt_contactmod = $request->txt_contactmod;
        $txt_bankidmod = $request->txt_bankidmod;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_agregator' => $idmod,
            'kode_agregator' => $txt_kodeagregatormod,
            'nama_agregator' => $txt_namaagregatormod,
            'alamat_agregator' => $txt_alamatagregatormod,
            'email_agregator' => $txt_emailmod,
            'contact_person' => $txt_contactmod,
            'bank_id' => $txt_bankidmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $insertbank = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($insertbank->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_agregator');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_agregator');
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
