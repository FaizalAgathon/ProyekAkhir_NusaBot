<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

  protected $primaryKey = 'id_a';

  protected $table = 'admin';

  protected $guard = 'admin';

  protected $fillable = [
    'id_a',
    'email_a',
    'pass_unhash',
    'password_a',
  ];

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function getAuthPassword()
  {
    return $this->password_a;
  }


}
