<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Environment_property extends Model
{
  use HasFactory;

  protected $fillable = ['property_id','environment_id'];

  protected $table = 'proenvironments';

  protected $dates = ['deleted_at'];


  public function Properties()
  {
    return $this->hasMany(Property::class, "property_id");
  }

  public function Environments()
  {
    return $this->hasMany(Environment::class, "environment_id");
  }
}
