<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seizures extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }

    public function units(){
        return $this->hasMany(SeizureUnit::class);
    }

    public function cause(){
        return $this->belongsTo(Seizures::class,'cause_id','id');
    }
}
