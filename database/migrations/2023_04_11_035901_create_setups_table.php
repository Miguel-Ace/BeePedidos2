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
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->string('url_imagen')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('cedula')->nullable();
            $table->string('pais')->nullable();
            $table->string('empresa')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('celular')->nullable();
            $table->string('coordenadas')->nullable();
            $table->string('cantidad_pedidos')->nullable();

            $table->string('tipo_licencia')->nullable(); // POS o Coffee 
            $table->string('tiempo_preparacion')->nullable();
            $table->string('validar_reserva')->nullable();
            $table->string('minimo_cantidad')->nullable();

            $table->string('moneda')->nullable();
            $table->string('baner1')->nullable();
            $table->string('baner2')->nullable();
            $table->string('baner3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};
