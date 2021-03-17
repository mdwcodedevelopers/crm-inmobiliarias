<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name'
    ];

    /** 
     * Relacion uno a uno con en modelo User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
