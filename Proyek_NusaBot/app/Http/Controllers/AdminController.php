<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'email_a'
    ]);
  }

  public function validator(Request $request)
  {
    $this->validate($request, [
      'email_a' => ['required', 'email'],
      'password' => ['required'],
    ]);
    $infoLogin = [
      'email_a' => $request->email_a,
      'password' => $request->password,
    ];

    if (Auth::guard('admin')->attempt($infoLogin)) {
      
      $request->session()->regenerate();
      // dd(auth('admin'), Auth::guard('admin'), Auth::check(), Auth::guard('admin')->check());
      return redirect('/admin');
    }
    return back();
  }

  // NOTE Tampilan tabel CRUD admin
  public function index()
  {
    # code...
  }

  // NOTE Method untuk menyimpan data yang dikirim $request ($request dapet dari form blade)
  public function store(Request $request)
  {
    # code...
  }

  // NOTE Method untuk mengedit data di database berdasarkan $id yg di kirim form action
  public function update(Request $request, $id)
  {
    # code...
  }

  // NOTE Method untuk menghapus data yg ada di database berdasarkan $id yg di kirim form action
  public function destroy(Request $request, $id)
  {
    # code...
  }
}
