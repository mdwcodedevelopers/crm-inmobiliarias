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

    public function users() 
    {
        return $this->belongsToMany('App\User');
    }
}
