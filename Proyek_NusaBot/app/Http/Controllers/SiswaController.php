<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class SiswaController extends Controller
{

  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'nis_siswa',
      'Identify' => 'NIS'
    ]);
  }

  public function validator(Request $request)
  {
    $this->validate($request, [
      'nis_siswa' => ['required'],
      'password' => ['required'],
    ]);
    $infoLogin = [
      'nis_siswa' => $request->nis_siswa,
      'password' => $request->password,
    ];
    if (Auth::guard('siswa')->attempt($infoLogin)) {
      $request->session()->regenerate();
      return redirect('/siswa');
    }
    return back();
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::guard('admin')->check()) {
      return view('users.admin.siswa', [
        'siswaClassActive' => '',
        'data' => Siswa::with(['jurusan', 'kelas'])->orderBy('siswa.created_at','desc')->get(),
        'dataJurusan' => Jurusan::all(),
        'dataKelas' => Kelas::all(),
      ]);
    } else if (Auth::guard('siswa')->check()) {
      return view('users.siswa.index', [
        'dataSiswa' => Siswa::with(['jurusan', 'kelas'])->where('id_siswa', Auth::guard('siswa')->user()->id_siswa)->get(),
      ]);
      // return dd(Auth::guard('siswa')->user()->id_siswa);
    }
  }

  public function pageProfile()
  {
    return view('users.siswa.profile', [
      'dataKelas' => Siswa::with(['kelas', 'jurusan'])->where('id_siswa', Auth::guard('siswa')->user()->id_siswa)->get()[0],
      'profile' => '',
    ]);
  }

  public function pdf(Request $request)
  {
    $user = Siswa::where('id_jurusan', $request->jurusan)
      ->where('id_kelas', $request->angkatan)
      ->get();
    $angkatan = Kelas::where('id_kelas', $request->angkatan)->get();
    $jurusan = Jurusan::where('id_jurusan', $request->jurusan)->get();
    $pdf = Pdf::loadView('users.admin.pdf.siswa', compact('user', 'angkatan', 'jurusan'));
    return $pdf->download("AKUN_SISWA_" . $angkatan[0]->angkatan_k . '_' . $jurusan[0]->nama_j . '.pdf');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $pass = Str::upper(Random::generate(8, 'a-z'));
    $namaGambar = 'NoImgProfile.png';
    $data = [
      'id_siswa' => Random::generate(10, '0-9'),
      'nis_siswa' => $request->nis,
      'pass_unhash' => $pass,
      'password_s' => Hash::make($pass),
      'nama_s' => $request->nama,
      'jk_s' => $request->jk,
      'gambar_s' => $namaGambar,
      'id_kelas' => $request->angkatan,
      'id_jurusan' => $request->jurusan,
    ];
    Siswa::create($data);
    return redirect('/admin/siswa')->with('add', Siswa::select('id_siswa')->max('created_at'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'nis_siswa' => $request->nis,
      'nama_s' => $request->nama,
      'jk_s' => $request->jk,
      'id_kelas' => $request->angkatan,
      'id_jurusan' => $request->jurusan,
    ];
    Siswa::where('id_siswa', $id)->update($data);
    return redirect('/admin/siswa')->with('edit', Siswa::select('id_siswa')->max('updated_at'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Siswa::where('id_siswa', $id)->delete();
    return redirect('/admin/siswa')->with('del');
  }
}
