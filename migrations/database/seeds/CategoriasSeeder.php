<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	'nome'=>'Clothes',
        ]);

        DB::table('categorias')->insert([
        	'nome'=>'Pants',
        ]);

        DB::table('categorias')->insert([
        	'nome'=>'Tshirts',
        ]);

        DB::table('categorias')->insert([
        	'nome'=>'Eletronics',
        ]);
    }
}
