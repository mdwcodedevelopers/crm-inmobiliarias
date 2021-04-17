<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_oportunity extends Model
{
  use HasFactory;

  protected $fillable = ['name','color'];

  protected $table = 'status_oportunities';

}
