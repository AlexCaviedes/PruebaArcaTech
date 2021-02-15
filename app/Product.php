<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'amount','unit_price','location',
        'references_id','users_id','categories_id'
    ];


    public function references(){

        return $this->belongsTo('App\Reference');
        
    }

    public function categories(){

        return $this->belongsTo('App\Category');

    }

    public function users(){

        return $this->belongsTo('App\User');

    }
}
