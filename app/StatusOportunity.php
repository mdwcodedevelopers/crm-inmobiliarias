<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusOportunity extends Model
{
    protected $fillable = ['name','color'];

    protected $table='status_oportunities';

    public $timestamps = false;
    
    /** 
     * Relacion uno a muchos con el modelo Oportunity
     */
    public function oportunity()
    {
         return $this->hasMany('App\Oportunity');
    }
}
