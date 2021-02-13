<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';

    protected $fillable = ['Referencia','Marca', 'Disponible'];

    public function equipos(){

        return $this->hasMany('App\Producto','referencias_id');

    }
}
