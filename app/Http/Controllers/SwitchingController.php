<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SwitchingController extends Controller
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
        $base_url = config('api.base_url') . 'MasterData/get_data_master_switching';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.master_data.switching', compact(['data']));
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
        $base_url = config('api.base_url') . 'MasterData/input_data_master_switching';

        // Mendapatkan data dari form input
        $txt_kodeswitchingadd = $request->input('txt_kodeswitchingadd');
        $txt_namaswitchingadd = $request->input('txt_namaswitchingadd');
        $txt_iprekonadd = $request->input('txt_iprekonadd');
        $txt_alamatswitchingadd = $request->input('txt_alamatswitchingadd');
        $txt_emailswitchingadd = $request->input('txt_emailswitchingadd');
        $txt_contactadd = $request->input('txt_contactadd');
        $txt_bankidadd = $request->input('txt_bankidadd');
        $txt_ipdestinationadd = $request->input('txt_ipdestinationadd');
        $txt_webmonitoringadd = $request->input('txt_webmonitoringadd');

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data 
        $dataRaw = [
            'kode_switching' => $txt_kodeswitchingadd,
            'nama_switching' => $txt_namaswitchingadd,
            'ip_rekon_sw' => $txt_iprekonadd,
            'alamat_switching' => $txt_alamatswitchingadd,
            'email_switching' => $txt_emailswitchingadd,
            'no_contact_switching' => $txt_contactadd,
            'bank_id' => $txt_bankidadd,
            'ip_destination' => $txt_ipdestinationadd,
            'web_monitoring' => $txt_webmonitoringadd
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_switching');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_switching');
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
        $base_url = config('api.base_url') . 'MasterData/update_data_master_switching';

        // Mendapatkan data dari form input
        $idmod = $request->input('idmod');
        $txt_kodeswitchingmod = $request->input('txt_kodeswitchingmod');
        $txt_namaswitchingmod = $request->input('txt_namaswitchingmod');
        $txt_iprekonmod = $request->input('txt_iprekonmod');
        $txt_alamatswitchingmod = $request->input('txt_alamatswitchingmod');
        $txt_emailswitchingmod = $request->input('txt_emailswitchingmod');
        $txt_contactmod = $request->input('txt_contactmod');
        $txt_bankidmod = $request->input('txt_bankidmod');
        $txt_ipdestinationmod = $request->input('txt_ipdestinationmod');
        $txt_webmonitoringmod = $request->input('txt_webmonitoringmod');

        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data 
        $dataRaw = [
            'id_m_switching' => $idmod,
            'kode_switching' => $txt_kodeswitchingmod,
            'nama_switching' => $txt_namaswitchingmod,
            'ip_rekon_sw' => $txt_iprekonmod,
            'alamat_switching' => $txt_alamatswitchingmod,
            'email_switching' => $txt_emailswitchingmod,
            'no_contact_switching' => $txt_contactmod,
            'bank_id' => $txt_bankidmod,
            'ip_destination' => $txt_ipdestinationmod,
            'web_monitoring' => $txt_webmonitoringmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_switching');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_switching');
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
