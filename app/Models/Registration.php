<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function doctor(){
        return $this->belongsTo( Doctor::class );
    }

    public function patient(){
        return $this->belongsTo( Patient::class );
    }
}
