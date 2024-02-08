<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MitraController extends Controller
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
        $base_url = config('api.base_url') . 'MasterData/get_data_mitra';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.master_data.mitra', compact(['data']));
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
        $base_url = config('api.base_url') . 'MasterData/input_data_mitra';

        // Mendapatkan data dari form input untuk update pengguna
        $txt_kodemitraadd = $request->txt_kodemitraadd;
        $txt_kodelinkmitraadd = $request->txt_kodelinkmitraadd;
        $txt_kodemapadd = $request->txt_kodemapadd;
        $txt_namamitraadd = $request->txt_namamitraadd;
        $txt_alamatadd = $request->txt_alamatadd;
        $txt_emailmitraadd = $request->txt_emailmitraadd;
        $txt_userftpadd = $request->txt_userftpadd;
        $txt_passftpadd = $request->txt_passftpadd;
        $txt_folderadd = $request->txt_folderadd;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'kode_mitra' => $txt_kodemitraadd,
            'kode_link_dbmitra' => $txt_kodelinkmitraadd,
            'kode_mapping_mitra' => $txt_kodemapadd,
            'nama_mitra' => $txt_namamitraadd,
            'alamat' => $txt_alamatadd,
            'email_mitra' => $txt_emailmitraadd,
            'user_ftp' => $txt_userftpadd,
            'pass_ftp' => $txt_passftpadd,
            'folder' => $txt_folderadd
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_mitra');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_mitra');
        }
    }

    public function hapusmitra(Request $request)
    {
        // URL untuk mengirim permintaan update data pengguna ke API eksternal
        $base_url = config('api.base_url') . 'MasterData/hapus_data_mitra';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idmitradlt;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_mitra' => $idmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_hapusdata', "Berhasil Menghapus Data");
            return redirect('getdata_mitra');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_hapusdatagagal', "Gagal Menghapus Data");
            return redirect('getdata_mitra');
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
        $base_url = config('api.base_url') . 'MasterData/update_data_mitra';

        // Mendapatkan data dari form input untuk update pengguna
        $idmod = $request->idmod;
        $txt_kodemitramod = $request->txt_kodemitramod;
        $txt_kodelinkmitramod = $request->txt_kodelinkmitramod;
        $txt_kodemapmod = $request->txt_kodemapmod;
        $txt_namamitramod = $request->txt_namamitramod;
        $txt_alamatmod = $request->txt_alamatmod;
        $txt_emailmitramod = $request->txt_emailmitramod;
        $txt_userftpmod = $request->txt_userftpmod;
        $txt_passftpmod = $request->txt_passftpmod;
        $txt_foldermod = $request->txt_foldermod;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_mitra' => $idmod,
            'kode_mitra' => $txt_kodemitramod,
            'kode_link_dbmitra' => $txt_kodelinkmitramod,
            'kode_mapping_mitra' => $txt_kodemapmod,
            'nama_mitra' => $txt_namamitramod,
            'alamat' => $txt_alamatmod,
            'email_mitra' => $txt_emailmitramod,
            'user_ftp' => $txt_userftpmod,
            'pass_ftp' => $txt_passftpmod,
            'folder' => $txt_foldermod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna (getdata_user)
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_mitra');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_mitra');
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
