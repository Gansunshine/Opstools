<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
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
        $base_url = config('api.base_url') . 'MasterData/get_data_master_produk';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.master_data.produk', compact(['data']));
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
        $base_url = config('api.base_url') . 'MasterData/input_data_master_produk';

        // Mendapatkan data dari form input
        $txt_kodeproduklimadd = $request->input('txt_kodeproduklimadd');
        $txt_kodeprodukswadd = $request->input('txt_kodeprodukswadd');
        $txt_namaprodukadd = $request->input('txt_namaprodukadd');
        $txt_biayaadminadd = $request->input('txt_biayaadminadd');
        $txt_kodeswitchingadd = $request->input('txt_kodeswitchingadd');
        $txt_kodeagregatoradd = $request->input('txt_kodeagregatoradd');
        $txt_feemitraadd = $request->input('txt_feemitraadd');
        $txt_feebilleradd = $request->input('txt_feebilleradd');
        $txt_feeagregatoradd = $request->input('txt_feeagregatoradd');
        $txt_feelimadd = $request->input('txt_feelimadd');
        
        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'kode_produk_lim' => $txt_kodeproduklimadd,
            'nama_produk_lim' => $txt_namaprodukadd,
            'kode_produk_sw' => $txt_kodeprodukswadd,
            'biaya_admin' => $txt_biayaadminadd,
            'kode_switching' => $txt_kodeswitchingadd,
            'kode_agregator' => $txt_kodeagregatoradd,
            'fee_mitra' => $txt_feemitraadd,
            'fee_biller' => $txt_feebilleradd,
            'fee_agregator' => $txt_feeagregatoradd,
            'fee_lim' => $txt_feelimadd
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
            return redirect('getdata_produk');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
            return redirect('getdata_produk');
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
        $base_url = config('api.base_url') . 'MasterData/update_data_master_produk';

        // Mendapatkan data dari form input
        $idmod = $request->input('idmod');
        $txt_kodeproduklimmod = $request->input('txt_kodeproduklimmod');
        $txt_kodeprodukswmod = $request->input('txt_kodeprodukswmod');
        $txt_namaprodukmod = $request->input('txt_namaprodukmod');
        $txt_biayaadminmod = $request->input('txt_biayaadminmod');
        $txt_kodeswitchingmod = $request->input('txt_kodeswitchingmod');
        $txt_kodeagregatormod = $request->input('txt_kodeagregatormod');
        $txt_feemitramod = $request->input('txt_feemitramod');
        $txt_feebillermod = $request->input('txt_feebillermod');
        $txt_feeagregatormod = $request->input('txt_feeagregatormod');
        $txt_feelimmod = $request->input('txt_feelimmod');
        
        // Data yang akan dikirimkan dalam permintaan API untuk melakukan update data pengguna
        $dataRaw = [
            'id_m_produk' => $idmod,
            'kode_produk_lim' => $txt_kodeproduklimmod,
            'nama_produk_lim' => $txt_namaprodukmod,
            'kode_produk_sw' => $txt_kodeprodukswmod,
            'biaya_admin' => $txt_biayaadminmod,
            'kode_switching' => $txt_kodeswitchingmod,
            'kode_agregator' => $txt_kodeagregatormod,
            'fee_mitra' => $txt_feemitramod,
            'fee_biller' => $txt_feebillermod,
            'fee_agregator' => $txt_feeagregatormod,
            'fee_lim' => $txt_feelimmod
        ];

        // Melakukan permintaan ke API eksternal untuk mengupdate data pengguna dengan menggunakan HTTP POST
        $InsetUser = Http::withHeaders([])->post($base_url, $dataRaw);
        
        if ($InsetUser->successful()) {
            // Jika permintaan berhasil, redirect ke halaman daftar pengguna 
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            return redirect('getdata_produk');
        } else {
            // Jika permintaan gagal, tampilkan pesan error dalam format JSON dengan status 500
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('getdata_produk');
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
