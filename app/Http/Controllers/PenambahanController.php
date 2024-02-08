<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\switching;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PenambahanController extends Controller
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
                
                // Mendapatkan data semua mitra dari database
                $dataswitching = switching::all();

                // URL untuk mendapatkan data complain yang sudah di-sortir
                $baseurl = config('api.base_url') . 'Form/get_form_penambahan_produk';

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
                return view('layouts.Form.PenambahanIndex', compact(['parsed_json','dataswitching']));
                
        } 
        else {
            // Jika tidak ada sesi dengan key 'username', artinya pengguna belum login
            // Maka, mengarahkan pengguna ke halaman login
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
        try {
            // Validasi input
            $this->validate($request, [
                'txt_tglpengajuan' => 'required',
                'txt_namapelapor' => 'required',
                'txt_jenis' => 'required|array', // Pastikan 'modul' adalah array
                'txt_jenis.*' => 'string', // Pastikan setiap elemen dalam 'modul' adalah string
                'txt_detail' => 'required'
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/input_form_penanambahan_produk';

            // Mendapatkan data yang dikirimkan dari form
            $user_input = session('username');
            $tglpengajuan = $request->txt_tglpengajuan;
            $namapelapor =  $request->txt_namapelapor;
            $txt_jenisArray =  $request->txt_jenis;
            $detail = $request->txt_detail;
            
            // Mengubah array nilai modul menjadi teks terpisah dengan koma
            $txt_jenis = implode(', ', $txt_jenisArray);

            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
               'user_input' => $user_input,
               'tgl_laporan' => $tglpengajuan,
               'nama_pelapor' => $namapelapor,
               'jenis_produk' => $txt_jenis,
               'detail_laporan' => $detail,
           ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $insertpengajuan = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($insertpengajuan->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                return redirect('form_penambahan_produk');
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
        try {
            // Validasi input
            $this->validate($request, [
                'idmod' => 'required',
                'txt_statusmod' => 'required',
                'txt_keteranganmod' => 'required'
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/update_form_penambahan_produk';

            // Mendapatkan data yang dikirimkan dari form
            $user_update = session('username');
            $idmod = $request->idmod;
            $txt_statusmod =  $request->txt_statusmod;
            $txt_keteranganmod =  $request->txt_keteranganmod;

            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
               'id_laporan' => $idmod,
               'user_update' => $user_update,
               'status' => $txt_statusmod,
               'ket_laporan' => $txt_keteranganmod
           ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $insertpengajuan = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($insertpengajuan->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_updateberhasil', "Berhasil Menambahkan Data");
                return redirect('form_penambahan_produk');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_updategagal', "Gagal Menambahkan Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_updategagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function hapusProduk(Request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporandlt' => 'required'
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/hapus_data_produk';

            $idmod = $request->txt_idlaporandlt;

            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
               'id_produk' => $idmod
           ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $hapusproduk = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($hapusproduk->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_hapusdata', "Berhasil Menghapus Data");
                return redirect('form_penambahan_produk');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_hapusgagal', "Gagal Menghapus Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_updategagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function tambahProduk(Request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporanadd' => 'required',
                'txt_namaprodukadd' => 'required',
                'txt_billeradd' => 'required',
                'txt_switchingadd' => 'required',
                'txt_adminadd' => 'required'
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/input_data_produk';

            $txt_idlaporanadd = $request->txt_idlaporanadd;
            $txt_namaprodukadd = $request->txt_namaprodukadd;
            $txt_billeradd = $request->txt_billeradd;
            $txt_switchingadd = $request->txt_switchingadd;
            $txt_adminadd = $request->txt_adminadd;

            // Data yang akan dikirimkan dalam request untuk menyimpan data baru
            $data = [
                'id_laporan' => $txt_idlaporanadd,
                'nama_produk_lim' => $txt_namaprodukadd,
                'kode_produk_sw' => $txt_billeradd,
                'kode_switching' => $txt_switchingadd,
                'biaya_admin' => $txt_adminadd
            ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $tambahproduk = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($tambahproduk->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
            // Simpan data laporan dalam sesi
            $request->session()->put('id_laporan_edit', $txt_idlaporanadd);
            $request->session()->put('produk_data_edit', $data);
                Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                return redirect('form_penambahan_produk?id_laporan=$txt_idlaporanadd');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_inputgagal', "Gagal Menambahkan Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_updategagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updateProduk(Request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporanmod' => 'required',
                'txt_namaprodukmod' => 'required',
                'txt_billermod' => 'required',
                'txt_switchingmod' => 'required',
                'txt_adminmod' => 'required',
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/update_data_produk';

            $idmod = $request->txt_idlaporanmod;
            $txt_namaprodukmod = $request->txt_namaprodukmod;
            $txt_billermod = $request->txt_billermod;
            $txt_switchingmod = $request->txt_switchingmod;
            $txt_adminmod = $request->txt_adminmod;

            // Data yang akan dikirimkan dalam request untuk menyimpan data baru
            $data = [
               'id_produk' => $idmod,
               'nama_produk_lim' => $txt_namaprodukmod,
               'kode_produk_sw' => $txt_billermod,
               'kode_switching' => $txt_switchingmod,
               'biaya_admin' => $txt_adminmod
           ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $updateproduk = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($updateproduk->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_updateberhasil', "Berhasil Update Data");
                return redirect('form_penambahan_produk');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_updategagal', "Gagal Update Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_updategagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
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
