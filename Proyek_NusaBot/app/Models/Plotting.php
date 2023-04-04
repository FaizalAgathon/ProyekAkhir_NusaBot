<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plotting extends Model
{
  use HasFactory;

  protected $table = 'plotting';

  protected $fillable = [
    'id_p',
    'nis_s',
    'nip_ps',
    'id_perusahaan',
  ];
}
