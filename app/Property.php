<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable=[
        'id',
        'user_id',
        'title',
        'information',
        'price',
        'dimension',
        'status_id',
        'title',
        'categorie_id',
        'currency_id',
        'city',
        'image'
    ];

    /**
     * Relacion muchos a muchos con el modelo User
     */
    // public function users()
    // {
    //     return $this->belongsToMany('App\User');
    // }

    // /**
    //  * Relacion uno a muchos con el modelo Status
    //  */
    // public function status()
    // {
    //     return $this->hasMany('App\Status');
    // }

    // /**
    //  * Relacion muchos a muchos con el modelo Categorie
    //  */
    // public function categories()
    // {
    //     return $this->belongsToMany('App\Categorie');
    // }
}
