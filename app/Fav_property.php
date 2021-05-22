<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fav_property extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id, property_id'];
    
    protected $table = 'fav_properties';


}
