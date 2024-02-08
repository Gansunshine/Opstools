<?php

namespace App\Http\Controllers;

use App\Models\switching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ParsedataBillerController extends Controller
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
        $base_url = config('api.base_url') . 'Parsing/get_data_biller';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.parsing.parsedataBiller', compact(['data']));
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
        // Validasi file CSV
        $validator = Validator::make($request->all(), [
            'csvFile' => [
                'required',
                'file',
                'mimes:csv,txt,xls',
            ],
            'txt_switching_csv' => 'required'
        ]);

        $txt_switching = $request->input('txt_switching_csv');
        
        if ($validator->fails() || $txt_switching === "none") {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan file CSV sementara dalam direktori sistem
        $csvFile = $request->file('csvFile');
        $temporaryFilePath = tempnam(sys_get_temp_dir(), 'csv_temp_');
        $csvFile->move(sys_get_temp_dir(), basename($temporaryFilePath));

        // Baca file CSV
        $csvData = array_map('str_getcsv', file($temporaryFilePath));

        // Hapus baris header pertama
        array_shift($csvData);

        // Inisialisasi variabel untuk melacak jumlah respons sukses dan lainnya
        $successResponses = 0;
        $otherResponses = 0;

        // Proses data sesuai format yang Anda inginkan
        foreach ($csvData as $row) {
            if($txt_switching === "BAKOEL"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "BAKOEL";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "BIMASAKTI"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "BIMASAKTI";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "CPN"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "CPN";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "DJI"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "DJI";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "FORTUNA"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "FORTUNA";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "MITRACOMM"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "MITRACOMM";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "VSI"){
                $tgl_jam_trx_csv = $row[0];
                $kode_switching = "VSI";
                $nama_produk = $row[3];
                $id_pel = $row[2];
                $tagihan = (int)str_replace(".", "", $row[9]);
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            
            // Buat payload JSON
            $dataTransaksi = [
                "tgl_jam_trx" => $tgl_jam_trx,
                "kode_switching" => $kode_switching,
                "nama_produk" => $nama_produk,
                "id_pel" => $id_pel,
                "tagihan" => $tagihan,
            ];
            // Kirim data ke API
            $api_url = config('api.base_url') . 'Parsing/parsing_data_biller';
            $response = Http::post($api_url, $dataTransaksi);
            $responseBody = json_decode($response->getBody());
            // Periksa status respons
            if ($responseBody->status === "Sukses") {
                $successResponses++;
            } else {
                $otherResponses++;
            }
            // Tambahkan respons ke array seluruh respons
            $allResponses[] = $response->getBody();
        }

        // Mengambil data pengguna dari API eksternal dengan menggunakan HTTP POST
        $base_url = config('api.base_url') . 'Rekapitulasi/get_rekap_data_biller';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];
        // Mendapatkan data semua dari database
        $dataswitching = switching::all();

        // Hapus file CSV sementara
        unlink($temporaryFilePath);
        
        Session::flash('flash_message_uploadberhasil', 'Upload berhasil');
        return view('layouts.compare.compbillerIndex')
        ->with('successResponses', $successResponses)
        ->with('otherResponses', $otherResponses)
        ->with('responses' , $allResponses)
        ->with('data', $data)
        ->with('dataswitching', $dataswitching)
        ->with('flash_message_uploadberhasil', 'Upload berhasil');
    }

    public function compare(Request $request)
    {
        try {
            // URL untuk menyimpan data baru
            $baseurl = config('api.base_url') . 'Rekapitulasi/proses_rekap_data_biller';
            // Lakukan permintaan ke API untuk menyimpan data complain baru
            $prosescompare = Http::withHeaders([])->post($baseurl);

            // Memeriksa apakah permintaan API berhasil
            if ($prosescompare->successful()) {
                // Jika permintaan berhasil, berarti data complain berhasil disimpan
                // Maka, arahkan pengguna kembali ke halaman complain
                Session::flash('flash_message_compareberhasil', "Berhasil Menambahkan Data");
                return redirect('rekapitulasi/biller');
            } else {
                // Jika permintaan gagal, berarti terjadi masalah saat menyimpan data complain
                // Berikan respons JSON dengan pesan kesalahan dan kode status HTTP 500 (Internal Server Error)
                Session::flash('flash_message_comparegagal', "Gagal Menambahkan Data");
                return redirect('rekapitulasi/biller');
            }
        } catch (\Exception $e) {
            // Tangani exception jika terjadi masalah pada proses validasi atau permintaan ke API
            Session::flash('flash_message_comparegagal', "Terjadi Kesalahan");
            return redirect('rekapitulasi/biller');
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
        //
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
