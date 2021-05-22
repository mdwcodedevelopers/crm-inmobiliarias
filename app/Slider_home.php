<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider_home extends Model
{
    use HasFactory;

    protected $fillable = ['image, title, subtitle, url, button'];
  
    protected $table = 'slider_homes';
  
}
