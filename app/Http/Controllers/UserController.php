<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Getuser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
        $base_url = config('api.base_url') . 'User/get_user';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();

        // Menampilkan halaman manajemen pengguna (user_management) dengan data hasil parsing dari API
        return view('layouts.master_data.user_management', compact(['parsed_json']));
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
        // URL untuk mengirim data pengguna baru ke API eksternal
        $base_url = config('api.base_url') . 'User/input_user';

        // Mendapatkan data dari form input pengguna baru
        $username = $request->username;
        $nama = $request->nama;
        $password = $request->password;
        $divisi = $request->divisi;
        $status = $request->status;
        $hakAkses = $request->hakAkses;

        // Data yang akan dikirimkan dalam permintaan API untuk menyimpan pengguna baru
        $dataRaw = [
            'username' => $username,
            'nama' => $nama,
            'password' => $password,
            'divisi' => $divisi,
            'status' => $status,
            'hak_akses' => $hakAkses
        ];

        // Melakukan permintaan ke API eksternal untuk menyimpan pengguna baru dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);

        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna (getdata_user)
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_user');
        } else {
            // Jika permintaan gagal, tampilkan pesan error
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_user');
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
        $base_url = config('api.base_url') . 'User/update_user';

        // Mendapatkan data dari form input untuk update pengguna
        $username = $request->usernamemod;
        $nama = $request->namamod;
        $password = $request->pwmod;
        $divisi = $request->divisimod;
        $status = $request->statusmod;
        $hakAkses = $request->hakmod;

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'username' => $username,
            'nama' => $nama,
            'password' => $password,
            'divisi' => $divisi,
            'status' => $status,
            'hak_akses' => $hakAkses
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna (getdata_user)
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_user');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_user');
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
