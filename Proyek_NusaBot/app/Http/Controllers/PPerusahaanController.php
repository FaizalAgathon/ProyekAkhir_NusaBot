<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Jurusan;
use App\Models\Pembimbing_Perusahaan;
use App\Models\Pembimbing_Sekolah;
use App\Models\Perusahaan;
use App\Models\Plotting;
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
      'nameValidate' => 'email_pp',
      'Identify' => 'Email'
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
        'data' => Pembimbing_Perusahaan::with('perusahaan')->orderBy('created_at', 'desc')->get(),
      ]);
    } else if (Auth::guard('pPerusahaan')->check()) {
      return view('users.pPerusahaan.index', [
        'listSiswa' => Plotting::with('siswa')->where('id_perusahaan', Auth::guard('pPerusahaan')->user()->id_perusahaan)->get()
      ]);
    }
  }

  public function pdf()
  {
    $user = Pembimbing_Perusahaan::all();
    $pdf = Pdf::loadView('users.admin.pdf.pperusahaan', compact('user'));
    return $pdf->download('AKUN_PEMBIMBING_PERUSAHAAN.pdf');
  }

  public function pageProfile()
  {
    return view('users.pPerusahaan.profile', [
      'data' => Pembimbing_Perusahaan::with(['perusahaan'])->where('id_pp', Auth::guard('pPerusahaan')->user()->id_pp)->get()[0],
      'listSiswa' => Plotting::with('siswa')->where('id_perusahaan', Auth::guard('pPerusahaan')->user()->id_perusahaan)->get(),
      'profile' => '',
    ]);
  }

  public function jurnalSiswa(string $id)
  {
    $data = Jurnal::with('plotting.siswa')->where('id_plotting', $id)->get();

    if ($data->isEmpty()) {
      return view('users.pPerusahaan.jurnalSiswaEmpty', [
        'data' => Plotting::with('siswa')->where('id_plotting', $id)->get(),
        'listSiswa' => Plotting::with('siswa')->where('id_perusahaan', Auth::guard('pPerusahaan')->user()->id_perusahaan)->get(),
        'jurnalActive' => 'show',
      ]);
    } else {
      return view('users.pPerusahaan.jurnalSiswa', [
        'listSiswa' => Plotting::with('siswa')->where('id_perusahaan', Auth::guard('pPerusahaan')->user()->id_perusahaan)->get(),
        'data' => $data,
        'jurnalActive' => 'show',
        'parafTrue' => "<span class='badge text-bg-success'>Sudah di paraf</span>",
        'parafFalse' => "<span class='badge text-bg-danger'>Belum di paraf</span>",
      ]);
    }
  }

  public function parafJurnalSiswa(Request $request)
  {
    // return 
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $pass = Str::upper(Random::generate(8, 'a-z'));
    $data = [
      'id_pp' => Random::generate(8, '0-9'),
      'email_pp' => $request->email,
      'pass_unhash' => $pass,
      'password_pp' => Hash::make($pass),
      'nama_pp' => $request->nama,
      'jk_pp' => $request->jk,
      'id_perusahaan' => $request->perusahaan,
    ];
    Pembimbing_Perusahaan::create($data);
    return redirect()->route('admin-readPPerusahaan')->with('add', Pembimbing_Perusahaan::select('id_pp')->max('created_at'));
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
    return redirect()->route('admin-readPPerusahaan')->with('edit', Pembimbing_Perusahaan::select('id_pp')->max('updated_at'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Pembimbing_Perusahaan::where('id_pp', $id)->delete();
    return redirect()->route('admin-readPPerusahaan')->with('del');
  }
}
