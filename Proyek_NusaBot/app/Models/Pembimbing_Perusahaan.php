<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Perusahaan extends Model
{
  use HasFactory;

  protected $table = 'pembimbing_perusahaan';

  protected $fillable = [
    'id_pp',
    'email_pp',
    'password_pp',
    'nama_pp',
    'jk_pp',
    'id_perusahaan',
  ];
}
