<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Perusahaan extends Model
{
  use HasFactory;

  protected $table = 'p_perusahaan';

  protected $fillable = [
    'id_pp',
    'email_pp',
    'password_pp',
    'nama_pp',
    'jk_pp',
    'id_perusahaan',
  ];

  public function perusahaan()
  {
    return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_p');
  }
  public function jurnal()
  {
    return $this->hasOne(Jurnal::class,'id_pp', 'id_pp');
  }
}
