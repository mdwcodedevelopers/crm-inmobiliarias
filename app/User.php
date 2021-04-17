<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory;
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['role_id','name', 'email','pronvince','phone','direction', 'password'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password','remember_token' ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = ['email_verified_at' => 'datetime'];

  protected $table = 'users';


  public function Role()
  {
    return $this->belongsTo(Role::class, "role_id")->orderBy('name','ASC');
  }

  public function Properties()
  {
    return $this->hasMany(Property::class, 'user_id');
  }


}
