<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
        'Cantidad','Fecha','Ubicacion',
        'referencias_id','users_id','categorias_id'
    ];


    public function referencias(){

        return $this->belongsTo('App\Referencia');
        
    }

    public function categorias(){

        return $this->belongsTo('App\Categoria');

    }

    public function users(){

        return $this->belongsTo('App\User');

    }
}
