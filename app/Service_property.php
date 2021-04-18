<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service_property extends Model
{
  use HasFactory;

  protected $fillable = ['property_id','service_id'];

  protected $table = 'proservices';

  protected $dates = ['deleted_at'];


  public function Properties()
  {
    return $this->hasMany(Property::class, "property_id");
  }

  public function Services()
  {
    return $this->hasMany(Service::class, "service_id");
  }
}
