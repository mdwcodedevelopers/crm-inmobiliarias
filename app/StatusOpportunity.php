<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusOpportunity extends Model
{
    protected $fillable = ['id','name'];

    protected $table='status_opportunities';

    public $timestamps = false;
}
