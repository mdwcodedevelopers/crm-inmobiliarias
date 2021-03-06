<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_types extends Model
{
    use HasFactory;
   
    protected $fillable = ['name', 'min_agents', 'min_clients', 'description', 'color', 'notify_after','notify_after_agent', 'notify_before','notify_before_agent', 'message_after',
                            'message_before' ];

    protected $table = 'event_types';
  
    public function Event_type()
    {
      return $this->belongsTo(Event_type::class, "event_types_id")->orderBy('name','ASC');
    }
  
    public function Events()
    {
      return $this->hasMany(Event::class, "event_types_id");
    }
}
