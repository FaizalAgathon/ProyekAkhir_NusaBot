<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

  protected $table = 'siswa';

  protected $primaryKey = 'id_siswa';

  protected $guard = 'siswa';

  protected $fillable = [
    'id_siswa',
    'nis_siswa',
    'pass_unhash',
    'password_s',
    'nama_s',
    'jk_s',
    'gambar_s',
    'id_kelas',
    'id_jurusan',
  ];

  public function jurusan()
  {
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
  }
  public function kelas()
  {
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
  }
  public function plotting()
  {
    return $this->hasOne(Plotting::class, 'nis_siswa', 'nis_siswa');
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function getAuthPassword()
  {
    return $this->password_s;
  }
}
