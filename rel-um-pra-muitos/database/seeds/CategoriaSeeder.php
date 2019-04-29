<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{    
    public function run()
    {
        DB::table('categorias')->insert(['nome'=>'Roupas']);
        DB::table('categorias')->insert(['nome'=>'Eletronicos']);
        DB::table('categorias')->insert(['nome'=>'Perfumes']);
        DB::table('categorias')->insert(['nome'=>'Móveis']);
        DB::table('categorias')->insert(['nome'=>'Alimentos']);
        DB::table('categorias')->insert(['nome'=>'Info']);
        DB::table('categorias')->insert(['nome'=>'Livros']);
    }
}
