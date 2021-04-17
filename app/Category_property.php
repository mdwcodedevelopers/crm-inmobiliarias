<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_property extends Model
{
  use HasFactory;

  protected $fillable = ['property_id','category_id'];

  protected $table = 'categories_properties';

  public function Properties()
  {
    return $this->hasMany(Property::class, "property_id");
  }

  public function Categories()
  {
    return $this->hasMany(Category::class, "category_id");
  }
}
