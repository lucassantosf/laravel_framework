<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEspecialidadeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_especialidades_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->string('origem');
            $table->integer('especialidade_id_from')->unsigned();
            $table->foreign('especialidade_id_from')->references('id')->on('especialidades')->onDelete('restrict');
            $table->integer('especialidade_id_to')->unsigned();
            $table->foreign('especialidade_id_to')->references('id')->on('especialidades')->onDelete('restrict');
            $table->integer('transacao_id')->unsigned();
            $table->foreign('transacao_id')->references('id')->on('transacoes')->onDelete('restrict');
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
        Schema::dropIfExists('users_especialidades_logs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
