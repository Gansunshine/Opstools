<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    // Fungsi untuk menampilkan halaman login
    public function index()
    {
        return view('layouts.login');
    }

    // Fungsi untuk meng-handle login dan validasi akun
    public function loginPost(Request $request)
{
    // Mengambil data username dan password dari input form
    $username = $request->input('txt_username');
    $password = $request->input('txt_password');

    // URL untuk login
    $base_url = config('api.base_url') . 'User/login_opstool';

    $dataRaw = [
        "username" => $username,
        "password" => $password
    ];
    
    // Request untuk login
    try {
        $response = Http::withHeaders([])->post($base_url, $dataRaw);
        $parsed_json = $response->json();

        if ($response->successful() && isset($parsed_json['status']) && $parsed_json['status'] == "Sukses" && !empty($parsed_json['data'])) {
            $userFound = true; // Pengguna ditemukan
            $userData = $parsed_json['data'][0]; // Ambil data pengguna dari respons
            // Simpan informasi yang diperlukan di sesi (tidak termasuk kata sandi)
            session([
                'username' => $userData['username'],
                'nama' => $userData['nama'],
                'divisi' => $userData['divisi'],
                'hak_akses' => $userData['hak_akses'],
                'status' => $userData['status']
            ]);
            // Tampilkan pesan "Login Berhasil" dan redirect ke halaman dashboard
            return redirect('dashboard')->with('flash_message_loginsukses', 'Login Berhasil');
        } else {
            // Jika login gagal atau respons tidak sesuai yang diharapkan
            return redirect('login')->with('flash_message_logingagal', 'Gagal Login');
        }
    } catch (\Exception $e) {
        // Tangani kesalahan saat melakukan permintaan HTTP
        return redirect('login')->with('flash_message_logingagal', 'Terjadi kesalahan saat melakukan login');
    }
}

// Fungsi untuk logout dan menghapus data session

//public function logout(Request $request)
//{
//    // Ambil username dan password dari Form
//    $username = $request->input('txt_username');
//    $password = $request->input('txt_password');
//
//    // URL untuk update status login
//    $update_status_url = config('api.base_url') . 'User/logout_opstool';
//
//    // Set status akun menjadi "is_logged_in = 0" pada backend
//    $response = Http::post($update_status_url, ['username' => $username, 'password' => $password]);
//    $respon = $response->json();
//
//    if ($respon['status'] == "Sukses") {
//        // Update status berhasil
//        Session::flash('flash_message_resetberhasil', 'Logout successful message here');
//        return redirect()->route('login'); // Menggunakan named route
//    } else {
//        // Update status gagal
//        Session::flash('flash_message_resetgagal', 'Logout failed message here');
//        return redirect()->route('login'); // Menggunakan named route
//    }
//}

public function logoutotomatis(Request $request)
{
    Session::flash('flash_message_resetberhasil', 'Logout successful message here');
    // Hapus semua data dalam sesi
    session()->flush();
    return redirect()->route('login'); // Mengarahkan pengguna kembali ke halaman login
}
}
