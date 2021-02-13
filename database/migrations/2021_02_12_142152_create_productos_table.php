<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Cantidad', 534)->nullable();
            $table->date('Fecha');
            $table->date('FechaCaducidad');
            $table->integer('PrecioUnitario');
            $table->string('Ubicacion',20);
            
            /* 
                Relaciones
            */

            $table->foreignId('referencias_id')
                ->constrained('referencias')
                ->onDelete('cascade');

            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('categorias_id')
                ->constrained('categorias')
                ->onDelete('cascade');
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
