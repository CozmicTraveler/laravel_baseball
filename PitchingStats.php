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
    public function find(){
        echo 'aaa';
    }
}
