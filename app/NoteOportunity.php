<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteOportunity extends Model
{

    protected $fillable = ['note_id','title', 'description', 'oportunity_id'];
    
    protected $primaryKey = 'note_id';
    
    protected $table='note_oportunities';

    /** 
     * Relacion muchos a uno con el modelo Oportunity
     */
    public function oportunity()
    {
         return $this->belongsTo('App\Oportunity');
    }
}
