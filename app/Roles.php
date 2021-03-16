<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable=[
        'name',
    ];

    /** 
     * Relacion muchos a muchos con en modelo User
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
