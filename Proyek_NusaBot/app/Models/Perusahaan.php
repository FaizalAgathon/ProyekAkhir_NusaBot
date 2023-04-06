<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
  use HasFactory;

  protected $table = 'perusahaan';

  protected $fillable = [
    'id_p',
    'nama_p',
    'alamat_p',
  ];

  public function plotting()
  {
    return $this->hasOne(Plotting::class, 'id_perusahaan', 'id_p');
  }
  public function pembimbing_perusahaan()
  {
    return $this->hasMany(Pembimbing_Perusahaan::class, 'id_perusahaan', 'id_p');
  }
}
