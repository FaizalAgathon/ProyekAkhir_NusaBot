<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PerusahaanController;
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

Route::get('/', function () {
  if(Auth::guard('admin')->check()){
    return view('users.admin.index');
  }
  return view('user');
});

Route::get('/login', function (Request $request) {
  if ($request->user == 'admin'){
    return redirect('/login/admin');
  }
});
Route::get('/login/admin', [AdminController::class, 'loginForm']);
Route::post('/admin', [AdminController::class, 'index']);

Route::get('/logout', [LoginController::class, 'logout']);

// SECTION AKSES ADMIN

Route::resource('/angkatan', AngkatanController::class);

Route::resource('/jurusan', JurusanController::class);

Route::resource('/perusahaan', PerusahaanController::class);