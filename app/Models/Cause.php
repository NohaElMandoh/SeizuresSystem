<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }

    public function seizures(){
        return $this->hasOne(Seizures::class);
    }
}
