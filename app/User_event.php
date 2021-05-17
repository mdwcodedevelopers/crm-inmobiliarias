<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_event extends Model
{
    use HasFactory;
    
    protected $fillable = ['event_id','user_id', 'role_id'];

    protected $table = 'usersevents';


    public function Events()
    {
        return $this->hasMany(Event::class, "contact_id");
    }

    public function User()
    {
        return $this->hasMany(User::class, "tag_id");
    }
}
