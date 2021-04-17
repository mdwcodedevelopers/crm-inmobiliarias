<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Note_oportunity extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['oportunity_id','title', 'description'];

  protected $table = 'note_oportunities';

  protected $dates = ['deleted_at'];


  public function Oportunities()
  {
    return $this->belongsTo(Oportunity::class, "oportunity_id");
  }

  //PORQUE HAY 3 METODOS QUE HACEN LO MISMO?  getUpdatedAtAttribute
  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }
}
