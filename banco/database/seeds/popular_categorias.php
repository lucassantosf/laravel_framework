<?php

use Illuminate\Database\Seeder;

class popular_categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	'nome'=>'Eletro 2'
        ]);

        DB::table('categorias')->insert([
            'nome'=>'Info'
        ]);

        DB::table('categorias')->insert([
            'nome'=>'Livros'
        ]);

        DB::table('categorias')->insert([
            'nome'=>'Móveis'
        ]);

    }
}
