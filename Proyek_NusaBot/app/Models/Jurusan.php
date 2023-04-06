<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
  use HasFactory;

  protected $table = 'jurusan';

  protected $fillable = [
    'id_j',
    'nama_j',
  ];

  public function siswa()
  {
    return $this->hasMany(Siswa::class, 'id_jurusan', 'id_j');
  }
  public function pembimbing_sekolah()
  {
    return $this->hasMany(Pembimbing_Sekolah::class, 'id_jurusan', 'id_j');
  }
}
