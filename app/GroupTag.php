<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTag extends Model
{
    protected $fillable = ['id','name'];
    
    /** 
     * Relacion uno a muchos con el modelo Tag
     */
    public function tag()
    {
         return $this->hasMany('App\Tag');
    }
}
