<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'user_id', 'event_types_id', 'property_id', 'completed', 'postponed',
        'report' ];

}
