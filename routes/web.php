<?php

use App\Http\Controllers\ComplainController;
use App\Http\Controllers\GetdatawebController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\GetcompprodukController;
use App\Http\Controllers\GetcompmitraController;
use App\Http\Controllers\GetdataftrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenambahanController;
use App\Http\Controllers\BugIssuesController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AgregatorController;
use App\Http\Controllers\ParsedataBillerController;
use App\Http\Controllers\ParsedataBillerxlsController;
use App\Http\Controllers\RekapitulasiBillerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SwitchingController;
use App\Http\Controllers\GetcompreconController;
use App\Http\Controllers\PengajuanPDFController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if(session()->has('username')){
        return redirect('dashboard');
    }
    else{
    return view('layouts.login');
    }
});

Route::middleware(['auth', 'check.session.expired'])->group(function () {
    // Definisikan rute-rute yang memerlukan autentikasi di sini
});

Route::post('getsaldodata', [DashboardController::class, 'getSaldoData'])->name('getsaldodata');

Route::resource('/dashboard', DashboardController::class);
Route::post('dashboard/viewopenstatus ', [DashboardController::class, 'tocomplain']);

// Route::get('/comparemitra', function () {
//     return view('layouts.compare.compmitraIndex');
// });
Route::get('/api/saldo', 'SaldoController@apiGetSaldo');

Route::get('login', [LoginController::class, 'index'])->name('login'); // Ganti LoginController dengan penamaan yang sesuai
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logoutotomatis', [LoginController::class, 'logoutotomatis'])->name('logoutotomatis');
Route::post('loginPost', [loginController::class, 'loginPost']);

// COMPLAIN
Route::resource('complain', ComplainController::class);
Route::post('complain/periode', [ComplainController::class, 'periode']);
Route::post('complain/store', [ComplainController::class, 'store']);
Route::post('complain/download', [ComplainController::class, 'excelperiode']);
Route::post('complain/downloadall', [ComplainController::class, 'excelall']);
Route::post('complain/downloadkategori', [ComplainController::class, 'excelkategori']);
Route::post('complain/downloadselected', [ComplainController::class, 'excelselected']);
Route::post('/complain/{id}', [ComplainController::class, 'hapus']);

// COMPARE PRODUK
Route::resource('compare/produk', GetcompprodukController::class);
Route::post('compare/produk/periode', [GetcompprodukController::class, 'waktu']);

// COMPARE MITRA
Route::resource('compare/mitra', GetcompmitraController::class);
Route::post('compare/mitra/periode', [GetcompmitraController::class, 'waktu1']);

// COMPARE BILLER
Route::resource('rekapitulasi/biller', RekapitulasiBillerController::class);
Route::post('rekapitulasi/biller/periode', [RekapitulasiBillerController::class, 'periode']);

// COMPARE RECONCILE
Route::resource('compare/recon', GetcompreconController::class);
Route::post('compare/recon/periode', [GetcompreconController::class, 'periode']);
Route::post('compare/recon/proses_compare', [GetcompreconController::class, 'compare']);

// Getdata FTR
Route::resource('getdata_ftr', GetdataftrController::class);
Route::post('getdata_ftr/periode', [GetdataftrController::class, 'periode']);
Route::post('getdata_ftr/proses_compare', [GetdataftrController::class, 'compare']);

// Getdata WEB
Route::resource('getdata_web', GetdatawebController::class);

// form
Route::resource('form_pengajuan', PengajuanController::class);
Route::post('form_pengajuan/store', [PengajuanController::class, 'store']);

Route::resource('form_penambahan_produk', PenambahanController::class);
Route::post('form_penambahan_produk/store', [PenambahanController::class, 'store']);
Route::post('form_penambahan_produk/hapusProduk', [PenambahanController::class, 'hapusProduk']);
Route::post('form_penambahan_produk/tambahProduk', [PenambahanController::class, 'tambahProduk']);
Route::post('form_penambahan_produk/updateProduk', [PenambahanController::class, 'updateProduk']);
Route::get('/form_penambahan_produk/{id}', 'PenambahanController@update')->name('getData');

Route::resource('form_bug', BugIssuesController::class);
Route::post('form_bug/store', [BugIssuesController::class, 'store']);
Route::post('form_bug/tambahAplikasi', [BugIssuesController::class, 'tambahAplikasi'])->name('tambahAplikasi');
Route::post('form_bug/updateAplikasi', [BugIssuesController::class, 'updateAplikasi'])->name('updateAplikasi');
Route::post('form_bug/hapusAplikasi', [BugIssuesController::class, 'hapusAplikasi'])->name('hapusAplikasi');

// User
Route::resource('getdata_user', UserController::class);
Route::put('getdata_user/{id}', [UserController::class, 'update']);

// Mitra
Route::resource('getdata_mitra', MitraController::class);
Route::post('getdata_mitra/store', [MitraController::class, 'store']);
Route::post('getdata_mitra/hapusmitra', [MitraController::class, 'hapusmitra']);
Route::put('getdata_mitra/{id}', [MitraController::class, 'update']);


// Agregator
Route::resource('getdata_agregator', AgregatorController::class);
Route::post('getdata_agregator/store', [AgregatorController::class, 'store']);
Route::post('getdata_agregator/hapus', [AgregatorController::class, 'hapus']);
Route::put('getdata_agregator/{id}', [AgregatorController::class, 'update']);

// Bank
Route::resource('getdata_bank', BankController::class);
Route::post('getdata_bank/store', [BankController::class, 'store']);
Route::post('getdata_bank/hapus', [BankController::class, 'hapus']);
Route::put('getdata_bank/{id}', [BankController::class, 'update']);

// Produk
Route::resource('getdata_produk', ProdukController::class);
Route::post('getdata_produk/store', [ProdukController::class, 'store']);
Route::put('getdata_produk/{id}', [ProdukController::class, 'update']);

// Switching
Route::resource('getdata_switching', SwitchingController::class);
Route::post('getdata_switching/store', [SwitchingController::class, 'store']);
Route::put('getdata_switching/{id}', [SwitchingController::class, 'update']);

// Upload Biller
Route::resource('parsedata_biller', ParsedataBillerController::class);
Route::post('parsedata_billerexcel/store', [ParsedataBillerxlsController::class, 'store']);
Route::post('parsedata_billercsv/store', [ParsedataBillerController::class, 'store']);
Route::post('parsedata_biller/proses_compare', [ParsedataBillerController::class, 'compare']);

// Download PDF
Route::get('printPDF', 'App\Http\Controllers\PengajuanPDFController@cetakPengajuanPdf')->name('printPDF');
Route::get('PDFpenambahan', 'App\Http\Controllers\PengajuanPDFController@cetakPenambahanPdf')->name('PDFpenambahan');
Route::get('bugPDF', 'App\Http\Controllers\PengajuanPDFController@cetakBugPdf')->name('bugPDF');
Route::get('bugkosongPDF', 'App\Http\Controllers\PengajuanPDFController@cetakBugkosongPdf')->name('bugkosongPDF');
Route::get('bugsolvedPDF', 'App\Http\Controllers\PengajuanPDFController@cetakBugsolvedPdf')->name('bugsolvedPDF');

// Route::post('compare/waktu', [GetlogController::class, 'waktu']);

// Route::resource('getdata', GetdatawebController::class);

// Route::get('compare', [GetlogController::class, 'index']);
// Route::get('compare', [CompareController::class, 'index']);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//How to Clear Route Cache from Browser
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//How to Clear Config Cache from Browser
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});

//How to Clear Application Cache from Browser
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

//How to Clear View Cache from Browser
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});
