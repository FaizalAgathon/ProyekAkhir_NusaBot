<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Sekolah extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

  protected $primaryKey = 'id_ps';

  protected $table = 'p_sekolah';

  protected $fillable = [
    'id_ps',
    'nip_ps',
    'pass_unhash',
    'password_ps',
    'nama_ps',
    'jk_ps',
    'id_jurusan',
  ];

  public function jurusan()
  {
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
  }
  public function plotting()
  {
    return $this->hasMany(Plotting::class, 'nip_ps', 'nip_ps');
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function getAuthPassword()
  {
    return $this->password_ps;
  }

  protected $guard = 'pSekolah';
}
