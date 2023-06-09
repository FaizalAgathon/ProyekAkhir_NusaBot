<?php

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Pembimbing_Sekolah;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembimbing_Perusahaan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\PlottingController;
use App\Http\Controllers\PSekolahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PPerusahaanController;

// TODO
// 4. (siswa)(pPerusahaan) desain dashboard
// 7. akses pPerusahaan (memberi paraf)
// 8. export pdf jurnal

// TODO
// 1. (siswa) (tambah jurnal) kegiatan dan kompetensi pake textarea biasa
// 2. (siswa) (edit jurnal) kegiatan dan kompetensi pake textarea biasa
// 3. (siswa) (jurnal) pencarian berdasarkan tanggal

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
Route::middleware('auth:admin')->prefix('admin')->name('admin-')->group(function () {
  Route::get('/', fn () => view('users.admin.index')); /* Tampilan Dashboard Admin */

  /* CRUD Angkatan */
  Route::resource('/angkatan', AngkatanController::class)->names([
    'index' => 'readAngkatan',
    'store' => 'storeAngkatan',
  ])->except(['show']); 

  /* CRUD Jurusan */
  Route::resource('/jurusan', JurusanController::class)->names([
    'index' => 'readJurusan',
    'store' => 'storeJurusan',
  ])->except(['show']); 

  /* CRUD Perusahaan */
  Route::resource('/perusahaan', PerusahaanController::class)->names([
    'index' => 'readPerusahaan',
    'store' => 'storePerusahaan',
  ])->except(['show']);

  /* CRUD Pembimbing Sekolah */
  Route::resource('/psekolah', PSekolahController::class)->names([
    'index' => 'readPSekolah',
    'store' => 'storePSekolah',
  ])->except(['show']);
  Route::get('/psekolah/pdf', [PSekolahController::class, 'pdf'])->name('psekolah-pdf'); /* Export PDF Pembimbing Sekolah */

  /* CRUD Pembimbing Perusahaan */
  Route::resource('/pperusahaan', PPerusahaanController::class)->names([
    'index' => 'readPPerusahaan',
    'store' => 'storePPerusahaan',
  ])->except(['show']); 
  Route::get('/pperusahaan/pdf', [PPerusahaanController::class, 'pdf']); /* Export PDF Pembimbing Perusahaan */

  /* CRUD Siswa */
  Route::resource('/siswa', SiswaController::class)->names([
    'index' => 'readSiswa',
    'store' => 'storeSiswa',
  ])->except(['show']); 
  Route::post('/siswa/pdf', [SiswaController::class, 'pdf']); /* Export PDF Siswa */

  /* CRUD Admin */
  Route::resource('/admin', AdminController::class)->names([
    'index' => 'readAdmin',
    'store' => 'storeAdmin',
  ])->except(['show']); 

  /* CRUD Plotting */
  Route::resource('/plotting', PlottingController::class)->names([
    'index' => 'readPlotting',
    'store' => 'storePlotting',
  ])->except(['show']); 

  // AJAX GETSISWA
  Route::post('/plotting/getsiswa', [PlottingController::class, 'getSiswa']);
});
// !SECTION AKSES ADMIN

// SECTION AKSES PEMBIMBING SEKOLAH
Route::middleware('auth:pSekolah')->prefix('p-sekolah')->name('pSekolah-')->group(function () {
  Route::get('', [PSekolahController::class, 'index'])->name('index');
  Route::get('/profile', [PSekolahController::class, 'pageProfile'])->name('profile');
  Route::get('/jurnal', [PSekolahController::class, 'daftarJurnalSiswa'])->name('daftarJurnal');
  Route::get('/jurnal/{id}', [PSekolahController::class, 'jurnalSiswa']);
});
// !SECTION AKSES PEMBIMBING SEKOLAH

// SECTION AKSES SISWA
Route::middleware('auth:siswa')->prefix('siswa')->name('siswa-')->group(function () {
  Route::get('', [SiswaController::class, 'index'])->name('index');
  Route::get('/profile', [SiswaController::class, 'pageProfile'])->name('profile');
  Route::resource('/jurnal', JurnalController::class)
    ->names([
      'index' => 'readJurnal',
      'create' => 'createJurnal',
      'store' => 'storeJurnal',
    ]);
});
// !SECTION AKSES SISWA

// SECTION AKSES PEMBIMBING PERUSAHAAN
Route::middleware('auth:pPerusahaan')->prefix('p-perusahaan')->name('pPerusahaan-')->group(function () {
  Route::get('', [PPerusahaanController::class, 'index'])->name('index');
  Route::get('/profile', [PPerusahaanController::class, 'pageProfile'])->name('profile');
  Route::get('/jurnal/{idSiswa}', [PPerusahaanController::class, 'jurnalSiswa']);
  Route::post('/jurnal/{idSiswa}/paraf/{jurnal}', [PPerusahaanController::class, 'parafJurnalSiswa']);
});
// !SECTION AKSES PEMBIMBING PERUSAHAAN
