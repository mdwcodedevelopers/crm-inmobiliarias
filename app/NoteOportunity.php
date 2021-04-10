<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class NoteOportunity extends Model
{
     use SoftDeletes;

    protected $fillable = ['note_id','title', 'description', 'oportunity_id'];
    
    protected $primaryKey = 'note_id';
    
    protected $table='note_oportunities';
    protected $dates = ['deleted_at'];
    // Cambio para el formato de fecha     
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
  }

  public function getUpdatedAtAttribute($value){
       return Carbon::parse($value)->format('d-m-Y');
  }

    /** 
     * Relacion muchos a uno con el modelo Oportunity
     */
    public function oportunity()
    {
         return $this->belongsTo('App\Oportunity');
    }
}
