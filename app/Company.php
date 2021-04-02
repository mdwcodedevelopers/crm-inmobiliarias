<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'information',
        'image-url'
    ];

    /**
     * Relacion uno a uno con en modelo User
     */
}
