<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacaoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transacao_id')->unsigned();
            $table->foreign('transacao_id')->references('id')->on('transacoes')->onDelete('restrict');
            $table->string('old_status')->nullable();
            $table->string('current_status')->comment('1-processing, 2-authorized, 3-paid, 4-refunded, 5-waiting_payment, 6-pending_refund, 7-refused, 8-chargedback, 9-analyzing, 10-pending_review');
            $table->longText('log');
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
        Schema::dropIfExists('transacoes_logs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
