<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'currencies';


  public function Properties()
  {
      return $this->hasMany(Property::class, "currency_id");
  }

}
