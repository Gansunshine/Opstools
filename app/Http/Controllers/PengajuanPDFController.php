<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PDF;

class PengajuanPDFController extends Controller
{
    public function cetakPengajuanPdf(request $request)
    {
        // Ambil data dari request
        $namaview = $request->input('namaview');
        $tglview = $request->input('amp;tglview');
        $noview = $request->input('amp;noview');
        $detailview = $request->input('amp;detailview');

        // Generate PDF menggunakan Laravel PDF package (misalnya, dompdf atau snappy)
        return view('layouts.pdf.template', compact('namaview', 'tglview', 'noview', 'detailview'));
    }
    public function cetakPenambahanPdf(request $request)
    {
        // Ambil data dari permintaan
        $namaview = $request->input('namaview');
        $tglview = $request->input('amp;tglview');
        $noview = $request->input('amp;noview');
        $jenisview = $request->input('amp;jenisview');
        $detailview = $request->input('amp;detailview');
        $produk_data = $request->input('amp;produk_data');
        
        // Generate PDF menggunakan Laravel PDF package (misalnya, dompdf atau snappy)
        return view('layouts.pdf.penambahan', compact('namaview', 'tglview', 'noview', 'jenisview','detailview','produk_data'));
    }
    public function cetakBugPdf(request $request)
    {
        // Ambil data dari permintaan
        $namaview = $request->input('txt_namapelaporview');
        $tglview = $request->input('amp;txt_tglview');
        $noview = $request->input('amp;txt_noview');
        $modulview = $request->input('amp;txt_modulview');
        $prosesview = $request->input('amp;txt_prosesview');
        $kronologiview = $request->input('amp;txt_kronologisview');
        $statusview = $request->input('amp;txt_statusbugview');
        
        // Generate PDF menggunakan Laravel PDF package (misalnya, dompdf atau snappy)
        return view('layouts.pdf.bugreport', compact('namaview', 'tglview', 'noview', 'modulview', 'prosesview', 'kronologiview', 'statusview'));
    }
    public function cetakBugkosongPdf(request $request)
    {
        $noview = $request->input('txt_noview');
        
        // Generate PDF menggunakan Laravel PDF package (misalnya, dompdf atau snappy)
        return view('layouts.pdf.bugkosong', compact('noview'));
    }
    public function cetakBugsolvedPdf(request $request)
    {
        // Ambil data dari permintaan
        $namaview = $request->input('txt_namapelaporview');
        $tglview = $request->input('amp;txt_tglview');
        $noview = $request->input('amp;txt_noview');
        $penyebabview = $request->input('amp;txt_penyebabview');
        $aplikasi_data = $request->input('amp;aplikasi_data');
        
        // Generate PDF menggunakan Laravel PDF package (misalnya, dompdf atau snappy)
        return view('layouts.pdf.bugsolved', compact('namaview', 'tglview', 'noview', 'penyebabview','aplikasi_data'));
    }
}
