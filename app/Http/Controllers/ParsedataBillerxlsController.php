<?php

namespace App\Http\Controllers;

use App\Models\switching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ParsedataBillerxlsController extends Controller
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
        $base_url = config('api.base_url') . 'Parsing/get_data_web_biller';
        $GetData = Http::withHeaders([])->post($base_url);
        $parsed_json = $GetData->json();
        $data = $parsed_json['data'];

        // Menampilkan halaman dengan data hasil parsing dari API
        return view('layouts.compare.compbillerIndex', compact(['data']));
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
        // Validasi file Excel
        $validator = Validator::make($request->all(), [
            'excel_file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'txt_switching' => 'required'
            ],
        ]);
    
        $txt_switching = $request->input('txt_switching');
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Simpan file Excel sementara dalam direktori sistem
        $excelFile = $request->file('excel_file');
        $temporaryFilePath = tempnam(sys_get_temp_dir(), 'excel_temp_');
        $excelFile->move(sys_get_temp_dir(), basename($temporaryFilePath));

        // dd($temporaryFilePath);
        // Load file Excel menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($temporaryFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // return $spreadsheet;
    
        // Inisialisasi variabel untuk melacak jumlah respons sukses dan lainnya
        $successResponses = 0;
        $otherResponses = 0;
        $allResponses = [];
    
        // Proses data sesuai format yang Anda inginkan
        foreach ($worksheet->getRowIterator() as $row) {
            // Cek apakah ini adalah baris header
            if ($row->getRowIndex() === 1) {
                continue; // Lewati baris header
            }
    
            if($txt_switching === "BAKOEL"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "BAKOEL";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "BIMASAKTI"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "BIMASAKTI";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "CPN"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "CPN";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "DJI"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "DJI";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "FORTUNA"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "FORTUNA";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "MITRACOMM"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "MITRACOMM";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
                // Ubah format tanggal dan waktu sesuai dengan format yang sesuai dengan tipe data datetime di database
                $tgl_jam_trx = date('Y-m-d H:i:s', strtotime($tgl_jam_trx_csv));
            }
            else if($txt_switching === "VSI"){
                $tgl_jam_trx_csv = $worksheet->getCell('B' . $row->getRowIndex())->getValue(); // Menggunakan kolom B
                $kode_switching = "VSI";
                $nama_produk = $worksheet->getCell('D' . $row->getRowIndex())->getValue(); // Menggunakan kolom D
                $id_pel = $worksheet->getCell('E' . $row->getRowIndex())->getValue();
                $tagihan = (int)str_replace(".", "", $worksheet->getCell('I' . $row->getRowIndex())->getValue()); // Menggunakan kolom I
        
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
        // Hapus file Excel sementara
        unlink($temporaryFilePath);
    
        Session::flash('flash_message_uploadberhasil', 'Upload berhasil'); 
        return view('layouts.compare.compbillerIndex')
            ->with('successResponses', $successResponses)
            ->with('otherResponses', $otherResponses)
            ->with('responses', $allResponses)
            ->with('data', $data)
            ->with('dataswitching', $dataswitching)
            ->with('flash_message_uploadberhasil', 'Upload berhasil');
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
