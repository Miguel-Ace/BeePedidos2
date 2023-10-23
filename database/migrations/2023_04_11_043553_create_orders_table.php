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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('num_pedido')->nullable();
            $table->string('fecha_hora')->nullable();
            
            $table->bigInteger('id_cliente')->unsigned();

            $table->string('sub_total')->nullable();
            $table->string('descuento')->nullable();
            $table->string('iva')->nullable();
            $table->string('propina')->nullable();
            $table->string('factura_electronica')->nullable();

            $table->bigInteger('id_tipo_pago')->unsigned()->nullable();
            $table->bigInteger('id_tipo_pedido')->unsigned()->nullable();
            $table->bigInteger('id_tipo_entrega')->unsigned()->nullable();

            $table->string('adjuntar_imagen')->nullable();
            
            $table->bigInteger('id_estado')->unsigned();

            $table->string('direccion')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('tipo')->nullable();

            $table->string('tipo_documento')->nullable(); //crédito o de contado
            $table->boolean('cerrar_pedido')->nullable(); //cerrar pedido
            
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('users');
            $table->foreign('id_estado')->references('id')->on('states');
            $table->foreign('id_tipo_pago')->references('id')->on('type_pays');
            $table->foreign('id_tipo_pedido')->references('id')->on('type_orders');
            $table->foreign('id_tipo_entrega')->references('id')->on('type_deliveries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
