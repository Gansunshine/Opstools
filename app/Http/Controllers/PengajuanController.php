<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Klasifikasi;
use App\Models\Mitra;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Memeriksa apakah sudah ada sesi dengan key 'username' (artinya pengguna sudah login)
        if (session()->has('username')) 
        {
            try {
                // URL untuk mendapatkan data complain yang sudah di-sortir
                $baseurl = config('api.base_url') . 'Form/get_form_pengajuan';

                // Melakukan HTTP POST request ke API untuk mendapatkan data complain yang sudah di-sortir
                $response = Http::withHeaders([
                    // Tambahkan header yang diperlukan untuk permintaan API
                    ])->post($baseurl);
                    
                    // Memeriksa apakah permintaan API berhasil
                    if ($response->successful()) {
                        // Jika berhasil, parsing data JSON yang diterima
                        $data = $response->json();
                        $parsed_json = $data['data'];
                    } else {
                        // Jika permintaan API gagal atau data yang diterima tidak valid
                        // Menginisialisasi variabel hasil parsing dengan array kosong dan jumlah data dengan nilai 0
                        $parsed_json = [];
                    }
                } catch (\Exception $e) {
                    // Menangani pengecualian yang mungkin terjadi selama permintaan API
                    // Misalnya, mencatat pesan kesalahan atau menampilkan pesan kesalahan umum ke pengguna
                    // Menginisialisasi variabel hasil parsing dengan array kosong dan jumlah data dengan nilai 0
                    $parsed_json = [];
                }

                // Mengirimkan data hasil parsing, data mitra, data klasifikasi, dan jumlah data ke view complainIndex
                return view('layouts.Form.PengajuanIndex', compact(['parsed_json']));
                
        } 
        else {
            // Jika tidak ada sesi dengan key 'username', artinya pengguna belum login
            // Maka, mengarahkan pengguna ke halaman login
            Session::flash('flash_message_belumlogin', "Diperlukan Login");
            return redirect('login');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
     {
         try {
             // Validasi input
             $this->validate($request, [
                 'txt_tglpengajuan' => 'required',
                 'txt_namapelapor' => 'required',
                 'txt_detail' => 'required'
             ]);
 
             // URL untuk menyimpan data complain baru
             $baseurl = config('api.base_url') . 'Form/input_form_pengajuan';
 
             // Mendapatkan data yang dikirimkan dari form
             $user_input = session('username');
             $tglpengajuan = $request->txt_tglpengajuan;
             $namapelapor =  $request->txt_namapelapor;
             $detail = $request->txt_detail;
 
             // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
             $data = [
                'user_input' => $user_input,
                'nama_pelapor' => $namapelapor,
                'detail_laporan' => $detail,
                'tgl_laporan' => $tglpengajuan
            ];
             
             // Lakukan permintaan ke API untuk menyimpan data complain baru
             $insertpengajuan = Http::withHeaders([])->post($baseurl, $data);
 
             // Memeriksa apakah permintaan API berhasil
             if ($insertpengajuan->successful()) {
                 // Jika permintaan berhasil, berarti data complain berhasil disimpan
                 // Maka, arahkan pengguna kembali ke halaman complain
                 Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                 return redirect('form_pengajuan');
             } else {
                 // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                 // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                 Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
                 return redirect('logoutotomatis');
             }
         } catch (\Exception $e) {
             // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
             Session::flash('flash_message_inputgagal', "Terjadi Kesalahan");
             return redirect('logoutotomatis');
         }
    }


    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'idmod' => 'required',
                'statusmod' => 'required',
                'keteranganmod' => 'required'
            ]);

            // URL untuk mengupdate data Pengajuan
            $baseurl = config('api.base_url') . 'Form/update_form_pengajuan';

            // Mendapatkan data yang dikirimkan dari form
            $user_update = session('username');
            $idmod = $request->idmod;
            $statusmod =  $request->statusmod;
            $keteranganmod = $request->keteranganmod;
            
            // Data yang akan dikirimkan dalam request untuk mengupdate data Pengajuan
            $data = [
                "user_update" => $user_update,
                "id_laporan" => $idmod,
                "status" => $statusmod,
                "ket_laporan" => $keteranganmod,
            ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $insertpengajuan = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($insertpengajuan->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
                return redirect('form_pengajuan');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_updategagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
        }
    }

}
