<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PPerusahaanController;
use App\Http\Controllers\PSekolahController;
use App\Http\Controllers\SiswaController;
use App\Models\Siswa;
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
Route::get('/', [LoginController::class, 'isLogin'])->name('login');
// Route::get('/', fn () => view('user'))->name('login');

// NOTE Mengecek login sebagai siapa dari request yg dikirim view user
Route::get('/login', function (Request $request) {
  if ($request->user == 'admin') return redirect('/login/admin');
  if ($request->user == 'pSekolah') return redirect('/login/pSekolah');
  if ($request->user == 'pPerusahaan') return redirect('/login/pPerusahaan');
  if ($request->user == 'siswa') return redirect('/login/siswa');
  return redirect('/');
});

// SECTION LOGIN ADMIN
Route::get('/login/admin', [AdminController::class, 'loginForm']);
Route::post('/admin', [AdminController::class, 'validator']);
// !SECTION LOGIN ADMIN

// SECTION LOGIN PEMBIMBING SEKOLAH
Route::get('/login/pSekolah', [PSekolahController::class, 'loginForm']);
Route::post('/pSekolah', [PSekolahController::class, 'validator']);
// !SECTION LOGIN PEMBIMBING SEKOLAH

// SECTION LOGIN PEMBIMBING PERUSAHAAN
Route::get('/login/pPerusahaan', [PPerusahaanController::class, 'loginForm']);
Route::post('/pPerusahaan', [PPerusahaanController::class, 'validator']);
// !SECTION LOGIN PEMBIMBING PERUSAHAAN

// SECTION LOGIN SISWA
Route::get('/login/siswa', [SiswaController::class, 'loginForm']);
Route::post('/siswa', [SiswaController::class, 'validator']);
// !SECTION LOGIN SISWA

Route::get('/logout', [LoginController::class, 'logout']);

// SECTION AKSES ADMIN

Route::middleware('auth:admin')->prefix('admin')->group(function () {
  Route::get('/', fn () => view('users.admin.index'));
  Route::resource('/angkatan', AngkatanController::class);
  Route::resource('/jurusan', JurusanController::class);
  Route::resource('/perusahaan', PerusahaanController::class);
  Route::resource('/psekolah', PSekolahController::class);
  Route::resource('/pperusahaan', PPerusahaanController::class);
  Route::resource('/siswa', SiswaController::class);
});

// !SECTION AKSES ADMIN

// SECTION AKSES PEMBIMBING SEKOLAH

Route::middleware('auth:pSekolah')->prefix('p-sekolah')->group(function () {
  Route::get('', fn () => view('users.pSekolah.index'));
  // Route::get('', [PSekolahController::class, 'coba']);
});

// !SECTION AKSES PEMBIMBING SEKOLAH

// SECTION AKSES SISWA

Route::middleware('auth:siswa')->prefix('siswa')->group(function () {
  Route::get('', [SiswaController::class, 'index']);
});

// !SECTION AKSES SISWA

// SECTION AKSES PEMBIMBING PERUSAHAAN

Route::middleware('auth:pPerusahaan')->prefix('p-perusahaan')->group(function () {
  Route::get('', fn () => dd(Auth::guard('pPerusahaan')->check()));
});

// !SECTION AKSES PEMBIMBING PERUSAHAAN
