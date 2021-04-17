<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  use HasFactory;

  protected $fillable = ['tag_id','name', 'image','email','phone_1','phone_2'];

  protected $table = 'contacts';


  public function Tag()
  {
    return $this->belongsTo(Tag::class, "tag_id");
  }

}
