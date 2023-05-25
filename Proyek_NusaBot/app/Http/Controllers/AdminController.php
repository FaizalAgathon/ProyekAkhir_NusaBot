<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pembimbing_Sekolah;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class AdminController extends Controller
{

  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'email_a',
      'Identify' => 'Email'
    ]);
  }
  public function validator(Request $request)
  {
    $this->validate($request, [
      'email_a' => ['required', 'email'],
      'password' => ['required'],
    ],[
      'email_a.required' => 'Email Wajib Diisi',
      'email_a.email' => 'Email Wajib Berbentuk Email',
      'password.required' => 'Password Wajib Diisi',
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
    return view('users.admin.admin', [
      'adminClassActive' => '',
      'data' => Admin::all(),
    ]);
  }

  // NOTE Method untuk menyimpan data yang dikirim $request ($request dapet dari form blade)
  public function store(Request $request)
  {
    $pass = Str::upper(Random::generate(8));
    $data = [
      'id_a' => Random::generate(10, '0-9'),
      'email_a' => $request->email,
      'pass_unhash' => $pass,
      'password_a' => Hash::make($pass),
    ];
    Admin::create($data);
    return redirect()->route('admin-readAdmin')->with('add', Admin::select('id_a')->max('created_at'));
  }

  // NOTE Method untuk mengedit data di database berdasarkan $id yg di kirim form action
  public function update(Request $request, $id)
  {
    $data = [
      'email_a' => $request->email,
    ];
    Admin::where('id_a', $id)->update($data);
    return redirect()->route('admin-readAdmin')->with('edit', Admin::select('id_a')->max('updated_at'));
  }

  // NOTE Method untuk menghapus data yg ada di database berdasarkan $id yg di kirim form action
  public function destroy( $id)
  {
    Admin::where('id_a', $id)->delete();
    return redirect()->route('admin-readAdmin')->with('del');
  }
}
