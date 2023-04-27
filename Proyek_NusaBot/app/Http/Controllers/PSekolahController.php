<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pembimbing_Sekolah;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class PSekolahController extends Controller
{

  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'nip_ps'
    ]);
  }

  public function validator(Request $request)
  {
    $this->validate($request, [
      'nip_ps' => ['required'],
      'password' => ['required'],
    ]);
    $infoLogin = [
      'nip_ps' => $request->nip_ps,
      'password' => $request->password,
    ];
    if (Auth::guard('pSekolah')->attempt($infoLogin)) {
      Auth::guard('pSekolah')->attempt($infoLogin);
      $request->session()->regenerate();
      return redirect('/p-sekolah');
    }
    return back();
  }

  public function pdf()
  {
    $user = Pembimbing_Sekolah::all()->sortBy('nip_ps');
    $pdf = FacadePdf::loadView('users.admin.pdf.psekolah', compact('user'));
    return $pdf->stream();
  }

  public function index()
  {
    if (Auth::guard('admin')->check()){
      return view('users.admin.psekolah', [
        'psekolahClassActive' => 'active',
        'dataJurusan' => Jurusan::all(),
        'data' => Pembimbing_Sekolah::with('jurusan')->get(),
      ]);
    }
    return redirect('/');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $pass = Str::upper(Random::generate(8,'a-z'));
    $idJurusan = Jurusan::where('id_jurusan', $request->jurusan)->get('id_jurusan');
    $data = [
      'id_ps' => Random::generate(10,'0-9'),
      'nip_ps' => $request->nip,
      'pass_unhash' => $pass,
      'password_ps' => Hash::make($pass),
      'nama_ps' => $request->nama,
      'jk_ps' => $request->jk,
      'id_jurusan' => $idJurusan->toArray()[0]['id_jurusan'],
    ];
    Pembimbing_Sekolah::create($data);
    return redirect()->route('admin-readPSekolah')->with('add');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'nip_ps' => $request->nip,
      'nama_ps' => $request->nama,
      'jk_ps' => $request->jk,
      'id_jurusan' => $request->jurusan,
    ];
    Pembimbing_Sekolah::where('id_ps', $id)->update($data);
    return redirect('/psekolah')->with('edit');
  }
  
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Pembimbing_Sekolah::where('id_ps', $id)->delete();
    return redirect('/psekolah')->with('del');
  }
}
