<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('pacote_id')->unsigned();
            $table->foreign('pacote_id')->references('id')->on('pacotes')->onDelete('restrict');
            $table->integer('pagarme_transaction_id')->nullable()->comment('Id - Número identificador da transação no Pagarme');
            $table->integer('perguntas_remaining')->comment('Quantidade de perguntas restantes para esta compra');
            $table->integer('especialidades_quantity')->comment('Quantidade de especialidades permitidas nesta compra');
            $table->integer('especialidades_changes_remaining')->comment('Quantidade de trocas de especialidades restantes');
            $table->integer('status')->comment('1-processing, 2-authorized, 3-paid, 4-refunded, 5-waiting_payment, 6-pending_refund, 7-refused, 8-chargedback, 9-analyzing, 10-pending_review');
            $table->longText('pagarme_object_json')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('transacoes');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
