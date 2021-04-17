<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'roles';


  public function Users()
  {
      return $this->hasMany(User::class, "role_id")->orderBy('name','ASC');
  }
}
