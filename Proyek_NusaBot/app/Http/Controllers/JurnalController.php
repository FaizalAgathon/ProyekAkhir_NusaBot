<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Nette\Utils\Random;
use App\Models\Plotting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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
      )->orderBy('tanggal_jurnal', 'desc')->get(),
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
    // return view('welcome');
    // dd(Jurnal::where('tanggal_jurnal', date('Y-m-d'))->get('tanggal_jurnal'));
    // if (Jurnal::where('tanggal_jurnal', date('Y-m-d'))->get('tanggal_jurnal')){
    //   return view('users.siswa.createJurnalFalse', [
    //     'createJurnal' => '',
    //   ]);
    // } else {
      return view('users.siswa.createJurnal', [
        'createJurnal' => '', 
      ]);
    // }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $idPlotting = Plotting::where('id_siswa', auth('siswa')->user()->id_siswa)->get('id_plotting')[0]['id_plotting'];
    $imagePath = request('gambar')->store('uploads/jurnal', 'public');
    list($width, $height) = getimagesize($_FILES["gambar"]['tmp_name']);
    $imageWidth = (int)round($width * (10 / 100));
    $imageHeight = (int)round($height * (10 / 100));
    $image = Image::make(public_path('storage/' . $imagePath))->fit($imageWidth, $imageHeight)->save();

    $request->validate([
      'kegiatan' => 'required',
      'kompetensi' => 'required'
    ],[
      'kegiatan.required' => 'Kegiatan wajib diisi',
      'kompetensi.required' => 'Kompetensi wajib diisi',
    ]);

    // return back()->withErrors();

    $data = [
      'id_jurnal' => Random::generate(10, '0-9'),
      'kegiatan_jurnal' => $request->kegiatan,
      'kompetensi_jurnal' => $request->kompetensi,
      'gambar_kegiatan_jurnal' => $imagePath,
      'tanggal_jurnal' => now(),
      'id_plotting' => $idPlotting,
    ];
    Jurnal::create($data);
    return redirect()->route('siswa-readJurnal');
  }

  public function show(string $id)
  {
    return view('users.siswa.showJurnal', [
      'data' => Jurnal::where('id_jurnal', $id)->get()[0],
      'readJurnal' => '',
    ]);
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
