<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string("cod_pedido"); // FAC-001
            $table->dateTime("fecha");
            $table->string("cod_factura")->nullable();
            $table->integer("estado")->default(1); // 1: proceso, 2: completado, 3: pendiente, 4: cancelado

            // N:1
            $table->bigInteger("cliente_id")->unsigned();
            // $table->unsignedBigInteger("cliente_id");
            $table->foreign('cliente_id')->references('id')->on('clientes');

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
        Schema::dropIfExists('pedidos');
    }
};
