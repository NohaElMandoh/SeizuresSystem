<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fines extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='fineses';

    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }
    public function seizure(){
        return $this->belongsTo(Seizures::class,'seizures_id','id');
    }
    public function cause(){
        return $this->belongsTo(Seizures::class,'cause_id','id');
    }
}
