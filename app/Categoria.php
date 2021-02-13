<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //

    protected $table = "categorias";

    protected $fillable = ['Categoria'];

    public function equipos(){

        return $this->hasMany('App\Producto','categorias_id');

    }
}
