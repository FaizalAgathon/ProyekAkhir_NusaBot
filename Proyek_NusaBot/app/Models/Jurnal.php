<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
  use HasFactory;

  protected $table = 'jurnal';

  protected $fillable = [
    'id_jurnal',
    'kegiatan_jurnal',
    'kompetensi_jurnal',
    'paraf_pp_jurnal',
    'gambar_kegiatan_jurnal',
    'tanggal_jurnal',
    'id_plotting',
    'id_pp',
  ];

  public function pembimbing_perusahaan()
  {
    return $this->belongsTo(Pembimbing_Perusahaan::class, 'id_pp', 'id_pp');
  }
  public function plotting()
  {
    return $this->belongsTo(Plotting::class, 'id_plotting', 'id_plotting');
  }
}
