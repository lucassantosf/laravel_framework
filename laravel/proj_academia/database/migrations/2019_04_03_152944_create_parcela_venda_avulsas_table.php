<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelaVendaAvulsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcela_venda_avulsas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_avulsa_id')->unsigned();
            $table->foreign('venda_avulsa_id')->references('id')->on('venda_avulsas');
            $table->float('value');
            $table->string('nome_cliente')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string('status')->default('Em aberto');
            $table->softDeletes();
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
        Schema::dropIfExists('parcela_venda_avulsas');
    }
}
