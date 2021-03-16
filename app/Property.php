<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable=[
        'user_id',
        'title',
        'information',
        'price',
        'dimension',
        'status_id',
        'title'
    ];

    /** 
     * Relacion muchos a muchos con el modelo User
     */
    public function users() 
    {
        return $this->belongsToMany('App\User');
    }

    
}
