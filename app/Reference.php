<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = ['reference','mark', 'available'];

    public function products(){

        return $this->hasMany('App\Product','references_id');

    }
}
