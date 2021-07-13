<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('role_id')->comment('1 - Admin, 2 - Cliente, 3 - Medico')->default('2');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('fone')->nullable();
            $table->longText('cep')->nullable();
            $table->longText('cidade')->nullable();
            $table->longText('estado')->nullable();
            $table->longText('endereco')->nullable();
            $table->longText('numero')->nullable();
            $table->longText('complemento')->nullable();
            $table->longText('bairro')->nullable();
            $table->longText('pais')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
