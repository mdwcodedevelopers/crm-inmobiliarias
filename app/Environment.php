<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
  use HasFactory;

  protected $fillable = ['name','type'];

  protected $table = 'environments';


  public function Properties()
  {
    return $this->hasMany(Environment_property::class, "environment_id");
  }
}
