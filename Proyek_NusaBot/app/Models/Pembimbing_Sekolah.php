<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Sekolah extends Model
{
  use HasFactory;

  protected $table = 'p_sekolah';

  protected $fillable = [
    'nip_ps',
    'password_ps',
    'nama_ps',
    'jk_ps',
    'id_jurusan',
  ];

  public function jurusan()
  {
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_j');
  }
  public function plotting()
  {
    return $this->hasMany(Plotting::class, 'nip_ps', 'nip_ps');
  }
}
