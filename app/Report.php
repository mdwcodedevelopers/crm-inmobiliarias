<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  use HasFactory;

  protected $fillable = ['user_id','type','table','information'];

  protected $table = 'reports';

  public function User()
  {
      return $this->belongsTo(User::class, "user_id");
  }
}
