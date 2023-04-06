<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
  use HasFactory;

  protected $table = 'siswa';

  protected $fillable = [
    'nis_s',
    'password_s',
    'nama_s',
    'jk_s',
    'gambar_s',
    'id_kelas',
    'id_jurusan',
  ];

  public function jurusan()
  {
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_j');
  }
  public function kelas()
  {
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_k');
  }
  public function plotting()
  {
    return $this->hasOne(Plotting::class, 'nis_s', 'nis_s');
  }
}
