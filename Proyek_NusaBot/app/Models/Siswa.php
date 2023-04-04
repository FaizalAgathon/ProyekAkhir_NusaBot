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
}
