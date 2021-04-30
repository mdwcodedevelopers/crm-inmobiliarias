<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_tag extends Model
{
    use HasFactory;
    
    protected $fillable = ['contact_id','tag_id'];

    protected $table = 'contact_tag';

    protected $dates = ['deleted_at'];


    public function Contacts()
    {
        return $this->hasMany(Contacts::class, "contact_id");
    }

    public function Tags()
    {
        return $this->hasMany(Tags::class, "tag_id");
    }
}
