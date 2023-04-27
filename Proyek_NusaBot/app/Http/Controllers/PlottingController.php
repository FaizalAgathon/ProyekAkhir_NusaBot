<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pembimbing_Sekolah;
use App\Models\Perusahaan;
use App\Models\Plotting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class PlottingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.admin.plotting', [
      'plottingClassActive' => '',
      'data' => Plotting::with(['siswa' => ['kelas', 'jurusan'], 'pembimbing_sekolah', 'perusahaan'])->get(),
      'dataSiswa' => Siswa::with(['kelas', 'jurusan'])->get(),
      'dataKelas' => Kelas::all(),
      'dataJurusan' => Jurusan::all(),
      'dataPerusahaan' => Perusahaan::all(),
      'dataPS' => Pembimbing_Sekolah::with('jurusan')->get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'id_plotting' => Random::generate(10, '0-9'),
      'id_siswa' => $request->siswa,
      'id_ps' => $request->pSekolah,
      'id_perusahaan' => $request->perusahaan,
    ];
    Plotting::create($data);
    return redirect('/admin/plotting');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'id_siswa' => $request->siswa,
      'id_ps' => $request->pSekolah,
      'id_perusahaan' => $request->perusahaan,
    ];
    Plotting::where('id_plotting', $id)->update($data);
    return redirect('/admin/plotting');
    // return dd($data, $id, Plotting::where('id_plotting', $id)->get());
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Plotting::where('id_plotting', $id)->delete();
    return redirect('/admin/plotting');
  }

  // public function getNIS(Request $request)
  // {
  //   // if (isset($request->idAngkatan) && isset($request->idJurusan)){
  //   // }
  //   $idAngkatan = $request->idAngkatan;
  //   $idJurusan = $request->idJurusan;

  //   echo "<option selected>Choose...</option>";
  //   foreach (Siswa::where('idKelas', $idAngkatan)->where('idJurusan', $idJurusan)->get() as $siswa) {
  //     echo "<option value='{$siswa->nis_siswa}'>$siswa->nis_siswa - $siswa->nama_s</option>";
  //   }
  // }
  // public function getPS(Request $request)
  // {
  //   $idJurusan = $request->idJurusan;

  //   echo "<option selected>Choose...</option>";
  //   foreach (Pembimbing_Sekolah::with('jurusan')->where('idJurusan', $idJurusan)->get() as $ps) {
  //     echo "<option value='{$ps->id_ps}'>{$ps->jurusan->nama_j} - $ps->nama_ps</option>";
  //   }
  // }
}
