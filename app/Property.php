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

    /** 
     * Relacion uno a uno con el modelo Status
     */
    public function status()
    {
        return $this->hasOne('App\Status');
    }

    public function categories()
    {
        return $this->hasMany('App\Categorie');
    }
}
