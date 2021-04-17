<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  use HasFactory;

  protected $fillable = ['property_id','url','principal'];

  protected $table = 'images';


  public function Property()
  {
      return $this->belongsTo(Property::class, "property_id");
  }

}
