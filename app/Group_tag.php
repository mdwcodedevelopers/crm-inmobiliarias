<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_tag extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'group_tags';


  public function Tags()
  {
    return $this->hasMany(Tag::class, "group_tag_id");
  }
}
