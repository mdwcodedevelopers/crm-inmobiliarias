<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['user_id','status_id','currency_id','title','information','price','dimension','title','city','image'];

  protected $table = 'properties';


  public function User()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function Status()
  {
    return $this->belongsTo(Status::class, 'status_id');
  }

  public function Currency()
  {
    return $this->belongsTo(Currency::class, 'currency_id');
  }

  public function Categories()
  {
    return $this->hasMany(Category_property::class, "property_id");
  }

  public function Images()
  {
    return $this->hasMany(Image::class, "property_id");
  }

  public function Environments()
  {
    return $this->hasMany(Environment_property::class, "property_id");
  }

  public function Services()
  {
    return $this->hasMany(Service_property::class, "property_id");
  }

  public function EnvsOne()
  {
    $envs = Environment_property::where('property_id', $this->id)
    ->join('environments','environments.id','proenvironments.environment_id')
    ->where('type','1')
    ->pluck("environment_id");

    return $envs;
  }

  public function Servs()
  {
    $servs = Service_property::where('property_id', $this->id)
    ->join('services','services.id','proservices.service_id')
    ->pluck("service_id");

    return $servs;
  }

  public function EnvsTwo()
  {
    $envs = Environment_property::where('property_id', $this->id)
    ->join('environments','environments.id','proenvironments.environment_id')
    ->where('type','2')
    ->pluck("environment_id");

    return $envs;
  }

  public function ImagePrincipal()
  {
    $image = Image::where('property_id', $this->id)->where('principal','1')->first();

    if( !isset($image->url) ):
      $image = Image::where('property_id', $this->id)->first();
    endif;

    return isset($image->url) ? $image->url : '';
  }
}
