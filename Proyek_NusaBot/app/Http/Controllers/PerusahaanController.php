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
      'id_p' => Random::generate(),
      'nama_p' => $request->nama,
      'alamat_p' => $request->alamat,
    ];
    Perusahaan::create($data);
    return redirect('/perusahaan')->with('add');
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
    Perusahaan::where('id_p', $id)->update($data);
    return redirect('/perusahaan')->with('edit');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Perusahaan::where('id_p', $id)->delete();
    return redirect('/perusahaan')->with('del');
  }
}
