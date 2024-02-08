<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BugIssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Memeriksa apakah sudah ada sesi dengan key 'username' (artinya pengguna sudah login)
        if (session()->has('username')) {
            try {
                // URL untuk mendapatkan data complain yang sudah di-sortir
                $baseurl = config('api.base_url') . 'Form/get_form_laporan_kesalahan_sistem';

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
            return view('layouts.Form.BugIndex', compact(['parsed_json']));
        } else {
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
                'modul' => 'required|array', // Pastikan 'modul' adalah array
                'modul.*' => 'string', // Pastikan setiap elemen dalam 'modul' adalah string
                'proses' => 'required|array', // Pastikan 'proses' adalah array
                'proses.*' => 'string', // Pastikan setiap elemen dalam 'modul' adalah string
                'txt_kronologis' => 'required',
                'status' => 'required|array', // Pastikan 'status' adalah array
                'status.*' => 'string' // Pastikan setiap elemen dalam 'modul' adalah string
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/input_form_laporan_kesalahan_sistem';

            // Mendapatkan data yang dikirimkan dari form
            $user_input = session('username');
            $txt_tglpengajuan = $request->txt_tglpengajuan;
            $txt_namapelapor =  $request->txt_namapelapor;
            $modulArray =  $request->modul;
            $prosesArray =  $request->proses;
            $txt_kronologis =  $request->txt_kronologis;
            $statusArray =  $request->status;

            // Mengubah array nilai modul menjadi teks terpisah dengan koma
            $jenis_modul = implode(', ', $modulArray);
            $proses = implode(', ', $prosesArray);
            $status = implode(', ', $statusArray);

            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
                'user_input' => $user_input,
                'tgl_laporan' => $txt_tglpengajuan,
                'nama_pelapor' => $txt_namapelapor,
                'jenis_modul' => $jenis_modul,
                'proses_bug' => $proses,
                'ket_laporan' => $txt_kronologis,
                'status_bug' => $status
            ];

            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $insertpengajuan = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($insertpengajuan->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                return redirect('form_bug');
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

    public function tambahAplikasi(request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporanadd' => 'required',
                'txt_namaaplikasiadd' => 'required',
                'txt_perubahanadd' => 'required',
                'txt_tglsolvingadd' => 'required',
                'txt_versiadd' => 'required',
                'txt_tglliveadd' => 'required'
            ]);
        
            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/input_data_aplikasi';
        
            // Ambil data dari request
            $txt_idlaporanadd = $request->input('txt_idlaporanadd');
            $txt_namaaplikasiadd = $request->input('txt_namaaplikasiadd');
            $txt_perubahanadd = $request->input('txt_perubahanadd');
            $txt_tglsolvingadd = $request->input('txt_tglsolvingadd');
            $txt_tglsolvingfix = date("Y-m-d", strtotime($txt_tglsolvingadd));
            $txt_versiadd = $request->input('txt_versiadd');
            $txt_tglliveadd = $request->input('txt_tglliveadd');
            $txt_tgllivefix = date("Y-m-d", strtotime($txt_tglliveadd));
        
            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
                'id_laporan' => $txt_idlaporanadd,
                'nama_aplikasi' => $txt_namaaplikasiadd,
                'ket_perubahan_aplikasi' => $txt_perubahanadd,
                'tgl_solving' => $txt_tglsolvingfix,
                'update_versi' => $txt_versiadd,
                'tgl_live' => $txt_tgllivefix
            ];

            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $tambahaplikasi = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($tambahaplikasi->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                return redirect('form_bug')->with('open_modal', true);
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
    
    public function updateAplikasi(request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporanmod' => 'required',
                'txt_namaaplikasimod' => 'required',
                'txt_perubahanmod' => 'required',
                'txt_tglsolvingmod' => 'required',
                'txt_versimod' => 'required',
                'txt_tgllivemod' => 'required'
            ]);
        
            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/update_data_aplikasi';
        
            // Ambil data dari request
            $txt_idlaporanmod = $request->input('txt_idlaporanmod');
            $txt_namaaplikasimod = $request->input('txt_namaaplikasimod');
            $txt_perubahanmod = $request->input('txt_perubahanmod');
            $txt_tglsolvingmod = $request->input('txt_tglsolvingmod');
            $txt_tglsolvingfix = date("Y-m-d", strtotime($txt_tglsolvingmod));
            $txt_versimod = $request->input('txt_versimod');
            $txt_tgllivemod = $request->input('txt_tgllivemod');
            $txt_tgllivefix = date("Y-m-d", strtotime($txt_tgllivemod));
        
            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
                'id_aplikasi' => $txt_idlaporanmod,
                'nama_aplikasi' => $txt_namaaplikasimod,
                'ket_perubahan_aplikasi' => $txt_perubahanmod,
                'tgl_solving' => $txt_tglsolvingfix,
                'update_versi' => $txt_versimod,
                'tgl_live' => $txt_tgllivefix
            ];

            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $updateAplikasi = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($updateAplikasi->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
                return redirect('form_bug');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
                return redirect('logoutotomatis');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_inputgagal', "Terjadi Kesalahan");
            return redirect('logoutotomatis');
        }
    }

    public function hapusAplikasi(request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'txt_idlaporandlt' => 'required'
            ]);

            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/hapus_data_aplikasi';

            // Ambil data dari request
            $txt_idlaporandlt = $request->input('txt_idlaporandlt');

            // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
            $data = [
                'id_aplikasi' => $txt_idlaporandlt,
            ];
            
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $hapusAplikasi = Http::withHeaders([])->post($baseurl, $data);

            // Memeriksa apakah permintaan API berhasil
            if ($hapusAplikasi->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_hapusdata', "Berhasil Menambahkan Data");
                return redirect('form_bug')->with('open_modal', true);
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_hapusdatagagal', "Gagal Menambahkan Data");
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
                'txt_statuslaporanmod' => 'required',
                'txt_tglterimamod' => 'required',
                'txt_penyelesaimod' => 'required',
                'txt_penyebabmod' => 'required',
            ]);



            // URL untuk menyimpan data complain baru
            $baseurl = config('api.base_url') . 'Form/update_form_laporan_kesalahan_sistem';

            // Mendapatkan data yang dikirimkan dari form
            $idmod = $request->idmod;
            $user_update = session('username');
            $txt_statuslaporanmod =  $request->txt_statuslaporanmod;
            $txt_tglterimamod =  $request->txt_tglterimamod;
            $txt_penyelesaimod = $request->txt_penyelesaimod;
            $txt_penyebabmod =  $request->txt_penyebabmod;
            $dataBaris = [
                'id_laporan' => $idmod,
                'user_update' => $user_update,
                'status' => $txt_statuslaporanmod,
                'tgl_terima_laporan' => $txt_tglterimamod,
                'nama_penerima_laporan' => $txt_penyelesaimod,
                'ket_permasalahan' => $txt_penyebabmod
            ];

            // Lakukan permintaan ke API untuk menyimpan data baru
            $updatelaporan = Http::withHeaders([])->post($baseurl, $dataBaris);

            // Memeriksa apakah permintaan API berhasil
            if ($updatelaporan->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
                return redirect('form_bug');
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
