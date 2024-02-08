<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Mitra;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ComplainController extends Controller
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
                $baseurl = config('api.base_url') . 'Complain/get_complain_sortir';

                // Melakukan HTTP POST request ke API untuk mendapatkan data complain yang sudah di-sortir
                $response = Http::withHeaders([
                    // Tambahkan header yang diperlukan untuk permintaan API
                    ])->post($baseurl);
                    
                    // Memeriksa apakah permintaan API berhasil
                    if ($response->successful()) {
                        // Jika berhasil, parsing data JSON yang diterima
                        $parsed_json = $response->json();
                        // Mendapatkan jumlah data hasil parsing
                        $jumlahdata = count($parsed_json);
                    } else {
                        // Jika permintaan API gagal atau data yang diterima tidak valid
                        // Menginisialisasi variabel hasil parsing dengan array kosong dan jumlah data dengan nilai 0
                        $parsed_json = [];
                        $jumlahdata = 0;
                    }
                } catch (\Exception $e) {
                    // Menangani pengecualian yang mungkin terjadi selama permintaan API
                    // Misalnya, mencatat pesan kesalahan atau menampilkan pesan kesalahan umum ke pengguna
                    // Menginisialisasi variabel hasil parsing dengan array kosong dan jumlah data dengan nilai 0
                    $parsed_json = [];
                    $jumlahdata = 0;
                }
                
                // Mengambil semua data mitra dari database
                $dataMitra = Mitra::all();
                // Mengambil semua data klasifikasi dari database
                $dataKlasifikasi = Klasifikasi::all();
                
                // Mengirimkan data hasil parsing, data mitra, data klasifikasi, dan jumlah data ke view complainIndex
                return view('layouts.complain.complainIndex', compact(['parsed_json', 'dataMitra', 'dataKlasifikasi', 'jumlahdata']));
                
        } 
        else {
            // Jika tidak ada sesi dengan key 'username', artinya pengguna belum login
            // Maka, mengarahkan pengguna ke halaman login
            Session::flash('flash_message_belumlogin', "Diperlukan Login");
            return redirect('login');
        }
    }
    
    public function excelall(Request $request)
    {
        $baseurl = config('api.base_url') . 'Complain/download_semua_data_complain_request';
        
        $response = Http::withHeaders([])->post($baseurl);

        if ($response->successful()) {
            $file = $response->body();
            $fileName = 'Laporan_Semua_Data_Complain_Request_' . now()->format('Ymd') . '.xlsx';

            return response($file, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            Session::flash('flash_message_printgagal', "Gagal Menambahkan Data");
        }
    
    }

    public function excelperiode(Request $request)
    {
        $baseurl = config('api.base_url') . 'Complain/download_laporan_complain_periode_excel';
        
        $awal = $request->start_print;
        $akhir = $request->end_print;
        $kategori = $request->kategori_print;
        $status = $request->status_print;
        $klasifikasi = $request->klasifikasi_print;
        
        $awalNumeric = date('Ymd', strtotime($awal));
        $akhirNumeric = date('Ymd', strtotime($akhir));

        $dataRaw = [
            "periodeFilter" => [
                "start_date" =>  $awal,
                "end_date" => $akhir,
                "kategori" => $kategori,
                "status" => $status,
                "klasifikasi" => $klasifikasi
            ]
        ];
        
        $response = Http::withHeaders([])->post($baseurl,$dataRaw);

        if ($response->successful()) {
            $file = $response->body();
            $fileName = 'Laporan_Data_Complain_Request_' . $awalNumeric.'-' .$akhirNumeric. '.xlsx';

            return response($file, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            Session::flash('flash_message_printgagal', "Gagal Menambahkan Data");
        }
    
    }

    public function excelselected(Request $request)
    {
        $baseurl = config('api.base_url') . 'Complain/download_data_berdasarkan_pencarian';
        
        $notiketing = $request->txt_tiketingPrint;
        $kategori = $request->txt_kategoriPrint;
        
        $dataRaw = [
            "search_data" => $notiketing
        ];
        
        $response = Http::withHeaders([])->post($baseurl,$dataRaw);

        if ($response->successful()) {
            $file = $response->body();
            $fileName = 'Laporan data ' .$kategori.' ' .$notiketing. '.xlsx';

            return response($file, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            Session::flash('flash_message_printgagal', "Gagal Menambahkan Data");
        }
    
    }

    public function excelkategori(Request $request)
    {
        $baseurl = config('api.base_url') . 'Complain/download_laporan_complain_periode_excel';
        
        $akhir = now()->format('Y-m-d');
        
        $kategori = $request->kategori_print;

        $dataRaw = [
            "periodeFilter" => [
                "start_date" =>  "2022-01-01",
                "end_date" => $akhir,
                "kategori" => $kategori,
                "status" => "all"
            ]
        ];

        $response = Http::withHeaders([])->post($baseurl,$dataRaw);

        if ($response->successful()) {
            $file = $response->body();
            $fileName = 'Laporan_Semua_Data_'. $kategori.'_'  . now()->format('Ymd') . '.xlsx';

            return response($file, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            return back();
            Session::flash('flash_message_printgagal', "Gagal Menambahkan Data");
        }
    
    }
    
    public function hapus(Request $request)
    {
        // URL untuk menghapus data complain
        $baseurl = config('api.base_url') . 'Complain/hapus_complain';
    
        // Mendapatkan ID complain yang akan dihapus dari request
        $idcomplain = $request->idcomplain_dlt;

        // Data yang akan dikirimkan dalam request untuk menghapus data complain
        $data = [
            'idComplain' => $idcomplain
        ];

        // Melakukan HTTP POST request ke API untuk menghapus data complain
        $dltcomplain = Http::withHeaders([])->post($baseurl, $data);
        
        // Memeriksa apakah permintaan API berhasil
        if ($dltcomplain->successful()) {
            // Jika permintaan berhasil, berarti data complain telah dihapus
            // Maka, arahkan pengguna kembali ke halaman complain
            return redirect('complain');
        } else {
            // Jika permintaan gagal, berarti terjadi masalah saat menghapus data complain
            // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }


    public function periode(Request $request)
    {
        // Validasi input dari pengguna menggunakan rule tertentu
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'kategori' => 'required',
            'status' => 'required',
            'klasifikasi' => 'required',
        ]);
        
        // Mendapatkan data yang dikirimkan dari form
        $awal = $request->startDate;
        $akhir = $request->endDate;
        $kategori = $request->kategori;
        $status = $request->status;
        $klasifikasi = $request->klasifikasi;
        
        // Format tanggal awal dan akhir sesuai dengan format yang diinginkan (Y-m-d)
        $first_date = date('Y-m-d', strtotime($awal));
        $last_date = date('Y-m-d', strtotime($akhir));
        
        // Simpan data tanggal awal, tanggal akhir, kategori, dan status dalam session
        session(['selectedEndDate' => $last_date]);
        session(['selectedKategori' => $kategori]);
        session(['selectedStatus' => $status]);
        session(['selectedStartDate' => $first_date]);
        
        // URL untuk mendapatkan data complain berdasarkan periode
        $baseurl = config('api.base_url') . 'Complain/get_complain_periode';
        
        // Data yang akan dikirimkan dalam request untuk mendapatkan data complain
        $dataRaw = [
            "start_date" => $first_date,
            "end_date" => $last_date,
            "kategori" => $kategori,
            "status" => $status,
            "klasifikasi" => $klasifikasi
        ];

        // Melakukan HTTP POST request ke API untuk mendapatkan data complain berdasarkan periode
        $response = Http::withHeaders([
            // Tambahkan header yang diperlukan untuk permintaan API (jika ada)
            ])->post($baseurl, $dataRaw);
            if ($response->successful()) {
    
            // Parsing data JSON yang diterima sebagai hasil request
            $parsed_json = $response->json();

            // Mendapatkan data semua mitra dari database
            $dataMitra = Mitra::all();
            // Mendapatkan data semua klasifikasi dari database
            $dataKlasifikasi = Klasifikasi::all();

            Session::flash('flash_message_periodeberhasil', "Gagal Menambahkan Data");
            // Mengirimkan data hasil parsing, data mitra, data klasifikasi, tanggal awal, tanggal akhir, kategori, dan status ke view periode
            return view('layouts.complain.periode', compact(['parsed_json', 'dataMitra', 'dataKlasifikasi', 'first_date', 'last_date', 'kategori', 'status','klasifikasi']));
        }
        else {
            Session::flash('flash_message_periodegagal', "Gagal Menambahkan Data");
            return redirect('complain');
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
                 'txt_tglAdd' => 'required',
                 'txt_jamAdd' => 'required',
                 'txt_mitraAdd' => 'required',
                 'txt_keluhanAdd' => 'required',
                 'txt_kategoriAdd' => 'required',
                 'txt_klasifikasiAdd' => 'required',
                 'txt_requesterAdd' => 'required',
                 'txt_orderAdd' => 'required'
             ]);
 
             // URL untuk menyimpan data complain baru
             $baseurl = config('api.base_url') . 'Complain/input_complain';
 
             // Mendapatkan data yang dikirimkan dari form
             $tgllaporan = $request->txt_tglAdd;
             $jamlaporan =  $request->txt_jamAdd;
             $kodemitra = $request->txt_mitraAdd;
             $keluhan = $request->txt_keluhanAdd;
             $kategori = $request->txt_kategoriAdd;
             $klasifikasi = $request->txt_klasifikasiAdd;
             $requester = $request->txt_requesterAdd;
             $order_by = $request->txt_orderAdd;
 
             // Data yang akan dikirimkan dalam request untuk menyimpan data complain baru
             $data = [
                 'kode_mitra' => $kodemitra,
                 'tgl_laporan' => $tgllaporan,
                 'jam_laporan' => $jamlaporan . ":00",
                 'keluhan' => $keluhan,
                 'kategori' => $kategori,
                 'klasifikasi' => $klasifikasi,
                 'status' => "1",
                 'user_input' => Session::get('username'),
                 'requester' => $requester,
                 'order_by' => $order_by
             ];
             
             // Lakukan permintaan ke API untuk menyimpan data complain baru
             $insertcomplain = Http::withHeaders([])->post($baseurl, $data);
 
             // Memeriksa apakah permintaan API berhasil
             if ($insertcomplain->successful()) {
                 // Jika permintaan berhasil, berarti data complain berhasil disimpan
                 // Maka, arahkan pengguna kembali ke halaman complain
                 Session::flash('flash_message_inputberhasil', "Berhasil Menambahkan Data");
                 return redirect('complain');
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
        // URL untuk mengupdate data complain
        $baseurl = config('api.base_url') . 'Complain/update_complain';
    
        // Mendapatkan data yang dikirimkan dari form
        $idcomplain = $request->txt_idMod;
        $mitra =  $request->txt_mitraMod;
        $keluhan = $request->txt_keluhanMod;
        $solving = $request->txt_solvingMod;
        $status = $request->status;
        $kategori = $request->txt_kategoriMod;
        $klasifikasi = $request->txt_klasifikasiMod;

        // Data yang akan dikirimkan dalam request untuk mengupdate data complain
        $data = [
            "id_complain" => $idcomplain,
            "kode_mitra" => $mitra,
            "kategori" => $kategori,
            "keluhan" => $keluhan,
            "klasifikasi" => $klasifikasi,
            "solving" => $solving,
            "status" => $status,
            "user_update" => Session::get('username') // Mengambil username dari sesi sebagai user yang melakukan update
        ];
        
        // Memeriksa apakah permintaan API berhasil
        $insertcomplain = Http::withHeaders([])->post($baseurl, $data);
        if ($insertcomplain->successful()) {
            Session::flash('flash_message_updateberhasil', "Berhasil Mengupdate Data");
            // Jika permintaan berhasil, berarti data complain berhasil diupdate
            // Maka, arahkan pengguna kembali ke halaman complain
            return redirect('complain');
        } else {
            // Jika permintaan gagal, berarti terjadi masalah saat mengupdate data complain
            // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
            Session::flash('flash_message_updategagal', "Gagal Mengupdate Data");
            return redirect('complain');
        }
    }

}
