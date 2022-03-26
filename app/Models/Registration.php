<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function rooms(){
        return $this->belongsTo( 'App\Models\Room','rooms','id');
    }

    public function doctors(){
        return $this->belongsTo( 'App\Models\Doctor','doctors','id');
    }

    public function patients(){
        return $this->belongsTo( 'App\Models\Patient','patients','id');
    }
}
