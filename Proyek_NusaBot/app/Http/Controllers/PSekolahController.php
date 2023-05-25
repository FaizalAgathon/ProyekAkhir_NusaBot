<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Jurusan;
use App\Models\Pembimbing_Sekolah;
use App\Models\Plotting;
use App\Models\Siswa;
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
      'nameValidate' => 'nip_ps',
      'Identify' => 'NIP'
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
      return redirect()->route('pSekolah-index');
    }
    return back();
  }

  public function pdf()
  {
    $user = Pembimbing_Sekolah::all()->sortBy('nip_ps');
    $pdf = FacadePdf::loadView('users.admin.pdf.psekolah', compact('user'));
    return $pdf->download('AKUN_PEMBIMBING_SEKOLAH.pdf');
  }

  public function index()
  {
    if (Auth::guard('admin')->check()) {
      return view('users.admin.psekolah', [
        'psekolahClassActive' => 'active',
        'dataJurusan' => Jurusan::all(),
        'data' => Pembimbing_Sekolah::with('jurusan')->orderBy('created_at', 'desc')->get(),
      ]);
    } else if (Auth::guard('pSekolah')->check()) {
      return view('users.pSekolah.index', [
        'listSiswa' => Plotting::with(['siswa', 'pembimbing_sekolah'])
          ->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get()
      ]);
    }
    return redirect('/');
  }

  public function daftarJurnalSiswa()
  {
    return view('users.pSekolah.daftarJurnalSiswa', [
      'listSiswa' => Plotting::with(['siswa', 'pembimbing_sekolah', 'perusahaan'])
          ->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get(),
      'jurnalActive' => 'show'
    ]);
  }

  public function jurnalSiswa(string $id)
  {
    $idPlotting = Plotting::where('id_plotting', $id)->get('id_plotting')[0]['id_plotting'];
    $data = Jurnal::with('plotting.siswa')->where('id_plotting', $id)->get();

    if ($data->isEmpty()) {
      return view('users.pSekolah.jurnalSiswaEmpty', [
        'data' => Plotting::with('siswa')->where('id_plotting', $id)->get(),
        'listSiswa' => Plotting::with(['siswa', 'pembimbing_sekolah'])->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get(),
        'jurnalActive' => 'show',
      ]);
    } else {
      return view('users.pSekolah.jurnalSiswa', [
        'listSiswa' => Plotting::with(['siswa', 'pembimbing_sekolah'])->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get(),
        'data' => $data,
        'jurnalActive' => 'show',
        "$idPlotting" => '',
        'parafTrue' => "<span class='badge text-bg-success'>Sudah di paraf</span>",
        'parafFalse' => "<span class='badge text-bg-danger'>Belum di paraf</span>",
      ]);
    }
  }

  public function pageProfile()
  {
    return view('users.pSekolah.profile', [
      'data' => Pembimbing_Sekolah::with(['jurusan'])->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get()[0],
      'listSiswa' => Plotting::with(['siswa', 'pembimbing_sekolah'])->where('id_ps', Auth::guard('pSekolah')->user()->id_ps)->get(),
      'profile' => '',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $pass = Str::upper(Random::generate(8, 'a-z'));
    $idJurusan = Jurusan::where('id_jurusan', $request->jurusan)->get('id_jurusan');
    $request->validate([
      'nip' => 'required|numeric',
      'nama' => 'required',
      'jk' => 'required',
    ],[
      'nip.required' => 'NIP Wajib Diisi',
      'nip.numeric' => 'NIP Wajib Angka',
      'nama.required' => 'Nama Wajib Diisi',
      'jk.required' => 'JK Wajib Diisi',
    ]);
    $data = [
      'id_ps' => Random::generate(10, '0-9'),
      'nip_ps' => $request->nip,
      'pass_unhash' => $pass,
      'password_ps' => Hash::make($pass),
      'nama_ps' => $request->nama,
      'jk_ps' => $request->jk,
      'id_jurusan' => $idJurusan->toArray()[0]['id_jurusan'],
    ];
    Pembimbing_Sekolah::create($data);
    return redirect()->route('admin-readPSekolah')->with('add', Pembimbing_Sekolah::select('id_ps')->max('created_at'));
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
    return redirect()->route('admin-readPSekolah')->with('edit', Pembimbing_Sekolah::select('id_ps')->max('updated_at'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Pembimbing_Sekolah::where('id_ps', $id)->delete();
    return redirect()->route('admin-readPSekolah')->with('del');
  }
}
