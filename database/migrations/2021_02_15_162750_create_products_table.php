<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('amount', 534)->nullable();
            $table->integer('unit_price');
            $table->string('location',20);
            
            /* 
                Relaciones
            */

            $table->foreignId('references_id')
                ->constrained('references')
                ->onDelete('cascade');

            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('categories_id')
                ->constrained('categories')
                ->onDelete('cascade');
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
