<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('user_id')->unsigned()->comment('Usuário quem respondeu a pergunta_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('pergunta_id')->unsigned();
            $table->foreign('pergunta_id')->references('id')->on('perguntas')->onDelete('restrict');
            $table->longtext('texto');
            $table->longtext('replica')->nullable();    
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
        Schema::dropIfExists('respostas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}