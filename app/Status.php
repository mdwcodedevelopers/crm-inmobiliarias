<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=[
        'name',
    ];

    /**
     * Relacion uno a muchos con el modelo Property
     */
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
