<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Sekolah extends Model
{
  use HasFactory;

  protected $table = 'pembimbing_sekolah';

  protected $fillable = [
    'nip_ps',
    'password_ps',
    'nama_ps',
    'jk_ps',
    'id_jurusan',
  ];
}
