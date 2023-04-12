<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pembimbing_Sekolah;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class PSekolahController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // dd(Pembimbing_Sekolah::where('nama_ps', 'M Faizal')->jurusan());
    return view('users.admin.psekolah', [
      'psekolahClassActive' => 'active',
      'dataPS' => Pembimbing_Sekolah::all(),
      'dataJurusan' => Jurusan::all(),
      'data' => Pembimbing_Sekolah::all()->jurusan(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'nip_ps' => $request->nip,
      'password_ps' => Str::upper(Random::generate(8,'a-z')),
      'nama_ps' => $request->nama,
      'jk_ps' => $request->jk,
      'id_jurusan' => Jurusan::where('id_j', $request->jurusan)->get('id_j')->first(),
    ];
    Pembimbing_Sekolah::create($data);
    return redirect('/psekolah')->with('add');
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
