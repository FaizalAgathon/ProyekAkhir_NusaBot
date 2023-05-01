<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pembimbing_Perusahaan;
use App\Models\Pembimbing_Sekolah;
use App\Models\Perusahaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class PPerusahaanController extends Controller
{
  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'email_pp'
    ]);
  }

  public function validator(Request $request)
  {
    $this->validate($request, [
      'email_pp' => ['required'],
      'password' => ['required'],
    ]);
    $infoLogin = [
      'email_pp' => $request->email_pp,
      'password' => $request->password,
    ];
    // dd(Auth::guard('pPerusahaan')->attempt($infoLogin));
    if (Auth::guard('pPerusahaan')->attempt($infoLogin)) {
      Auth::guard('pPerusahaan')->attempt($infoLogin);
      $request->session()->regenerate();
      return redirect('/p-perusahaan');
    }
    return back();
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::guard('admin')->check()) {
      return view('users.admin.pperusahaan', [
        'pperusahaanClassActive' => 'active',
        'dataPerusahaan' => Perusahaan::all(),
        'data' => Pembimbing_Perusahaan::with('perusahaan')->get(),
      ]);
    } else if(Auth::guard('pPerusahaan')->check()){
      return view('users.pPerusahaan.index');
    }
  }

  public function pdf()
  {
    $user = Pembimbing_Perusahaan::all();
    $pdf = Pdf::loadView('users.admin.pdf.pperusahaan', compact('user'));
    return $pdf->stream();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {    
    $pass = Str::upper(Random::generate(8,'a-z'));
    $data = [
      'id_pp' => Random::generate(8,'0-9'),
      'email_pp' => $request->email,
      'pass_unhash' => $pass,
      'password_pp' => Hash::make($pass),
      'nama_pp' => $request->nama,
      'jk_pp' => $request->jk,
      'id_perusahaan' => $request->perusahaan,
    ];
    Pembimbing_Perusahaan::create($data);
    return redirect('/admin/pperusahaan');
  }
  
  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'email_pp' => $request->email,
      'nama_pp' => $request->nama,
      'jk_pp' => $request->jk,
      'id_perusahaan' => $request->perusahaan,
    ];
    Pembimbing_Perusahaan::where('id_pp', $id)->update($data);
    return redirect('/admin/pperusahaan');
  }
  
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Pembimbing_Perusahaan::where('id_pp', $id)->delete();
    return redirect('/admin/pperusahaan');
  }
}
