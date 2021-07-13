<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('Usuário quem realizou a pergunta');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('especialidade_id')->unsigned();
            $table->foreign('especialidade_id')->references('id')->on('especialidades')->onDelete('restrict');
            $table->integer('transacao_id')->unsigned()->nullable();
            $table->foreign('transacao_id')->references('id')->on('transacoes')->onDelete('restrict');
            $table->longtext('texto');
            $table->longtext('replica')->nullable();
            $table->boolean('status')->default(0)->comment('0 - Aguardando Resposta, 1 - Respondido');
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
        Schema::dropIfExists('perguntas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
