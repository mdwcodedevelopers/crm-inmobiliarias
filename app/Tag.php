<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id','name','group_id'];

     /** 
     * Relacion uno a muchos con el modelo Contact
     */
    public function contact()
    {
         return $this->hasMany('App\Contact');
    }
     /** 
     * Relacion muchos a uno con el modelo GroupTag
     */
    public function grouptag()
    {
         return $this->belongsTo('App\GroupTag');
    }
}
