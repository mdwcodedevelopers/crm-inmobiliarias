<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'categories';


  public function Properties()
  {
      return $this->hasMany(Category_property::class, "category_id");
  }
}
