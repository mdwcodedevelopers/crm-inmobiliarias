<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['id','name', 'img_path', 'tel_1', 'tel_2','email'];

     /** 
     * Relacion uno a uno con el modelo Oportunity
     */
    public function oportunity()
    {
         return $this->belongsTo('App\Oportunity');
    }
    
}
