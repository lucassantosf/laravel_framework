<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(['nome'=>'Roupas']);
        DB::table('categorias')->insert(['nome'=>'Eletro']);
        DB::table('categorias')->insert(['nome'=>'Informatica']);
        DB::table('categorias')->insert(['nome'=>'Perfume']);
        DB::table('categorias')->insert(['nome'=>'Alimentos']);
        DB::table('categorias')->insert(['nome'=>'Brinquedos']);
    }
}
