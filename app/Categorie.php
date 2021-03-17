<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=[
        'name',
    ];

    /** 
     * Relacion muchos a muchos con el modelo Property 
     */
    public function properties()
    {
        return $this->belongsToMany('App\Property');
    }
}
