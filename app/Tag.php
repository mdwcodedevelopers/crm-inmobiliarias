<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory;

  protected $fillable = ['name','group_tag_id'];

  protected $table = 'tags';


  public function GroupTag()
  {
    return $this->belongsTo(Group_tag::class, "group_tag_id");
  }

  public function Contact()
  {
    return $this->hasMany(Contact::class, "tag_id");
  }

}
