<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Plotting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class JurnalController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.siswa.readJurnal', [
      'readJurnal' => '',
      'data' => Jurnal::with(['pembimbing_perusahaan'])->where(
        'jurnal.id_plotting',
        Plotting::where('id_siswa', auth('siswa')->user()->id_siswa)->get('id_plotting')[0]['id_plotting']
      )->get(),
      'parafTrue' => "<span class='badge text-bg-success'>Sudah di paraf</span>",
      'parafFalse' => "<span class='badge text-bg-danger'>Belum di paraf</span>",
    ]);
    // return 
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('users.siswa.createJurnal',['createJurnal' => '']);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $idPlotting = Plotting::where('id_siswa', auth('siswa')->user()->id_siswa)->get('id_plotting')[0]['id_plotting'];
    $data = [
      'id_jurnal' => Random::generate(10, '0-9'),
      'kegiatan_jurnal' => $request->kegiatan,
      'kompetensi_jurnal' => $request->kompetensi,
      'gambar_kegiatan_jurnal' => 'noImgProfile.png',
      'tanggal_jurnal' => now(),
      'id_plotting' => $idPlotting,
    ];
    Jurnal::create($data);
    return redirect()->route('siswa-readJurnal');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
