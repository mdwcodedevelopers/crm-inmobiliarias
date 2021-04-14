<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
     use SoftDeletes;

     protected $table='oportunities';
      
     protected $fillable = [
          'id',
          'user_id', 
          'name', 
          'contact_id', 
          'vigency', 
          'status_id',
          'closed', 
          'closed_reason'];

    protected $dates = ['deleted_at'];

     // Cambio para el formato de fecha     
     public function getCreatedAtAttribute($value){
           return Carbon::parse($value)->format('d-m-Y');
     }

     public function getUpdatedAtAttribute($value){
          return Carbon::parse($value)->format('d-m-Y');
     }

     public function getVigencyAttribute($value){
          return Carbon::parse($value)->format('d-m-Y');
     }
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
