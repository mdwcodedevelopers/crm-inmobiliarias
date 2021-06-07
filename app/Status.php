<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'status';


  public function Oportunities()
  {
    return $this->hasMany(Oportunity::class, "status_id");
  }

  public function Properties()
  {
    return $this->hasMany(Property::class, "status_id");
  }

  public function getPriceAttribute($value)
  {
    return number_format($value, 2, ',', '.');
  }
  // public function getDimensionAttribute($value)
  // {
  //   return number_format($value, 2, ',', '.');
  // }
}
