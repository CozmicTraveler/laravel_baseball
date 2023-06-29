<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePitchingStats;

class PitchingStats extends Model
{
    use HasFactory;
    // Input guard
    protected $guarded=['id','name'];
    // disable timestamps(created,updated)
    public $timestamps=false;
    //Define validation rules
    public static $rules = array(
        'team'=>'required',
        'name'=>'required',
        'ip'=>'numeric',
        'game'=>'integer',
        'batter'=>'integer',
        'ip'=>'integer',
        'hit'=>'integer',
        'hr'=>'integer',
        'bb'=>'integer',
        'ib'=>'integer',
        'db'=>'integer',
        'so'=>'integer',
    );
    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new ScopePitchingStats);
        // static::addGlobalScope('ip',function(Builder $builder){
        //     $builder->where('ip','>=',30);
        // });
    }

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
    public function scopeGreatPlayer($query){
        return $query->where('fip','<=','3.00')->get();
    }
}
