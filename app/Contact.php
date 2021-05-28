<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'email','phone_1','phone_2','direction','province','user_id'];

  protected $table = 'contacts';

  public function User()
  {
      return $this->belongsTo(User::class, "user_id");
  }

  public function ContactStringTags()
  {
    $tags = Contact_tag::where('contact_id', $this->id)->pluck('id')->toArray();

    return tagsToString($tags);
  }

  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }
  public function getUpdatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }
}
