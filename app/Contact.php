<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'img_path', 'tel_1', 'tel_2','email','tag_id'];

     /** 
     * Relacion uno a uno con el modelo Oportunity
     */
    public function oportunity()
    {
         return $this->belongsTo('App\Oportunity');
    }
     /** 
     * Relacion muchos a uno con el modelo Tag
     */
    public function tag()
    {
         return $this->belongsTo('App\Tag');
    }
    
}
