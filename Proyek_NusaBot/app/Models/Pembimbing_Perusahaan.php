<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing_Perusahaan extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

  protected $table = 'p_perusahaan';

  protected $primaryKey = 'id_pp';

  protected $fillable = [
    'id_pp',
    'email_pp',
    'pass_unhash',
    'password_pp',
    'nama_pp',
    'jk_pp',
    'id_perusahaan',
  ];

  public function perusahaan()
  {
    return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
  }
  public function jurnal()
  {
    return $this->hasOne(Jurnal::class,'id_pp', 'id_pp');
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function getAuthPassword()
  {
    return $this->password_pp;
  }

  protected $guard = 'pPerusahaan';
}
