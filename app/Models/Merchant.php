<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function causes(){
        return $this->hasMany(Cause::class);
    }
}
