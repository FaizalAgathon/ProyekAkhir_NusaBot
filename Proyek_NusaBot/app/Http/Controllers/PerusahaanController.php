<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class PerusahaanController extends Controller
{

  public function __construct()
  {
    if (Auth::guard('admin')->check()){
      return $this->index();
    }
    return redirect('/');
  } 

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.admin.perusahaan', [
      'perusahaanClassActive' => 'active',
      'data' => Perusahaan::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'id_perusahaan' => Random::generate(10,'0-9'),
      'nama_p' => $request->nama,
      'alamat_p' => $request->alamat,
    ];
    Perusahaan::create($data);
    return redirect()->route('admin-readPerusahaan')->with('add', Perusahaan::select('id_perusahaan')->max('created_at'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'nama_p' => $request->nama,
      'alamat_p' => $request->alamat,
    ];
    Perusahaan::where('id_perusahaan', $id)->update($data);
    return redirect()->route('admin-readPerusahaan')->with('edit', Perusahaan::select('id_perusahaan')->max('updated_at'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Perusahaan::where('id_perusahaan', $id)->delete();
    return redirect()->route('admin-readPerusahaan')->with('del');
  }
}
