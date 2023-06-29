<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ScopePitchingStats implements Scope{
  // public function apply(Builder $builder,Model $model){
  //   $builder->where('ip','>=',30);
  // }
  public function apply(Builder $builder,Model $model){
      return $builder->where('draft_year','2018');
  }
}