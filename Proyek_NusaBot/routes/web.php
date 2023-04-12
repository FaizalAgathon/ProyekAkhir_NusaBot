<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PSekolahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// NOTE Routing untuk mengecek login sebagai siapa

Route::get('/', function () {

  // NOTE Jika akun admin sudah login, tampilkan dashboard/index admin

  if(Auth::guard('admin')->check()){ 
    return view('users.admin.index');
  }

  // NOTE Jika sama sekali blm login, tampilkan daftar akun untuk login

  return view('user');
});

Route::get('/login', function (Request $request) {
  if ($request->user == 'admin') return redirect('/login/admin');
});

// SECTION LOGIN ADMIN

Route::get('/login/admin', [AdminController::class, 'loginForm']);
Route::post('/admin', [AdminController::class, 'index']);

// !SECTION LOGIN ADMIN

Route::get('/logout', [LoginController::class, 'logout']);

// SECTION AKSES ADMIN

Route::resource('/angkatan', AngkatanController::class);
Route::resource('/jurusan', JurusanController::class);
Route::resource('/perusahaan', PerusahaanController::class);
Route::resource('/psekolah', PSekolahController::class);

// !SECTION AKSES ADMIN