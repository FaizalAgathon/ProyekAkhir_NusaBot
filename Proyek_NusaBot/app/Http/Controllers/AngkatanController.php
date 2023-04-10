<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class AngkatanController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function __construct()
  {
    if (Auth::guard('admin')->check()) {
      return $this->index();
    }
    return redirect('/');
  }

  public function index()
  {
    return view('users.admin.angkatan', [
      'angkatanClassActive' => 'active',
      'kelasClassActive' => 'show',
      'data' => Kelas::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'id_k' => Random::generate(),
      'angkatan_k' => $request->angkatan,
    ];
    Kelas::create($data);
    return redirect('/angkatan')->with('add');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'angkatan_k' => $request->angkatan,
    ];
    Kelas::where('id_k', $id)->update($data);
    return redirect('/angkatan')->with('edit');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Kelas::where('id_k', $id)->delete();
    return redirect('/angkatan')->with('del');
  }
}
