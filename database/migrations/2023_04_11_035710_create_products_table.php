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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->string('descripcion');
            $table->string('precio');
            $table->string('descuento')->nullable();
            // $table->string('id_empresa');
            $table->string('id_categoria');
            $table->string('url_imagen');
            $table->string('cod_producto_beesy')->nullable();
            $table->string('tipo_producto_beesy')->nullable();
            $table->boolean('activo')->nullable();
            $table->integer('existencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
