<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('num_pedido')->nullable();

            $table->bigInteger('id_producto')->unsigned();
            
            
            $table->string('cantidad')->nullable();
            $table->string('precio')->nullable();
            $table->string('descuento')->nullable();
            $table->string('iva')->nullable();
            $table->string('enviada_beesy')->nullable();
            $table->string('fecha_hora')->nullable();

            $table->bigInteger('id_modificador1')->unsigned()->nullable();
            $table->bigInteger('id_modificador2')->unsigned()->nullable();
            $table->bigInteger('id_modificador3')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('products');
            $table->foreign('id_modificador1')->references('id')->on('product_modifiers');
            $table->foreign('id_modificador2')->references('id')->on('product_modifiers');
            $table->foreign('id_modificador3')->references('id')->on('product_modifiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
