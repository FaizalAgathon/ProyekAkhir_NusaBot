<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plotting extends Model
{
  use HasFactory;

  protected $table = 'plotting';

  protected $fillable = [
    'id_plotting',
    'id_siswa',
    'id_ps',
    'id_perusahaan',
  ];

  public function siswa()
  {
    return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
  }
  public function pembimbing_sekolah()
  {
    return $this->belongsTo(Pembimbing_Sekolah::class, 'id_ps', 'id_ps');
  }
  public function perusahaan()
  {
    return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
  }
  public function jurnal()
  {
    return $this->hasMany(Jurnal::class, 'id_plotting', 'id_plotting');
  }
}
