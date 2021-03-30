<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteOportunity extends Model
{

    protected $fillable = ['id','title', 'description', 'oportunity_id'];

    protected $table='note_oportunities';


}
