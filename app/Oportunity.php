<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    //
    protected $fillable = ['id','user_id', 'name', 'contact_id', 'vigency', 'status_id'];


     /** 
     * Relacion uno a uno con el modelo Contact
     */
    public function contact()
    {
         return $this->hasOne('App\Contact');
    }
    
     /** 
     * Relacion uno a muchos con el modelo NoteOportunity
     */
    public function notes()
    {
         return $this->hasMany('App\NoteOportunity');
    }

     /** 
     * Relacion muchos a uno con el modelo status_oportunities
     */
    public function status()
    {
         return $this->belongsTo('App\StatusOportunity','status_id');
    }
    /** 
     * Relacion muchos a uno con el modelo status_oportunities
     */
    public function user()
    {
         return $this->belongsTo('App\User','user_id');
    }



}
