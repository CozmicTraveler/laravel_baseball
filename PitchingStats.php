<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PitchingStats extends Model
{
    use HasFactory;
    public function getData(){
        return $this->team . ',' .$this->name . ',' . $this->ip;
    }

    public function scopeNameEqual($query,$str){
        return $query->where('name',$str);
    }
    
    public function scopeInningGreaterThan($query,$n){
        return $query->where('ip','>=',$n);
    }
    public function scopeInningLessThan($query,$n){
        return $query->where('ip','<=',$n);
    }
}
