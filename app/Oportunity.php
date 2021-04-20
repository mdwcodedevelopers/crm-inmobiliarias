<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Oportunity extends Model
{
  use HasFactory;

  protected $fillable = ['user_id','contact_id','status_id','name','vigency','closed','closed_description','closed_reason'];

  protected $table = 'oportunities';

  protected $dates = ['deleted_at'];


  public function User()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function Contact()
  {
    return $this->hasOne(Contact::class, 'contact_id');
  }

  public function Status()
  {
    return $this->belongsTo(StatusOportunity::class, 'status_id');
  }

  public function NotesOportunities()
  {
    return $this->hasMany(NoteOportunity::class, 'oportunity_id');
  }

  //PORQUE HAY 3 METODOS QUE HACEN LO MISMO?    
  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }
  public function getUpdatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }
  public function getVigencyAttribute($value)
  {
    return Carbon::parse($value)->format('d-m-Y');
  }

}
