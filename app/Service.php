<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'services';


  public function Properties()
  {
    return $this->hasMany(Environment_property::class, "service_id");
  }
}
