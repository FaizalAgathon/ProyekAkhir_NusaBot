<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class JurusanController extends Controller
{

  public function __construct()
  {
    if (Auth::guard('admin')->check()) {
      return $this->index();
    }
    return redirect('/');
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.admin.jurusan', [
      'jurusanClassActive' => 'active',
      'kelasClassActive' => 'show',
      'data' => Jurusan::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = [
      'id_j' => Random::generate(),
      'nama_j' => $request->jurusan,
    ];
    Jurusan::create($data);
    return redirect('/jurusan')->with('add');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = [
      'nama_j' => $request->jurusan,
    ];
    Jurusan::where('id_j', $id)->update($data);
    return redirect('/jurusan')->with('edit');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Jurusan::where('id_j', $id)->delete();
    return redirect('/jurusan')->with('del');
  }
}
