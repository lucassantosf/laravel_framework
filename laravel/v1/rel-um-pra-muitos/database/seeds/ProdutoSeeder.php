<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{    
    public function run()
    {
        DB::table('produtos')->insert([
        	'nome'=>'Camiseta',
        	'preco'=>100,
        	'estoque'=>4,
        	'categoria_id'=>1
        ]);

        DB::table('produtos')->insert([
        	'nome'=>'Calça',
        	'preco'=>24300,
        	'estoque'=>42,
        	'categoria_id'=>3
        ]);

        DB::table('produtos')->insert([
        	'nome'=>'Livro',
        	'preco'=>12430,
        	'estoque'=>41,
        	'categoria_id'=>2
        ]);

        DB::table('produtos')->insert([
        	'nome'=>'Livro 2',
        	'preco'=>12430,
        	'estoque'=>41,
        	'categoria_id'=>2
        ]);

        DB::table('produtos')->insert([
        	'nome'=>'Terno',
        	'preco'=>14,
        	'estoque'=>44,
        	'categoria_id'=>4
        ]);
        DB::table('produtos')->insert([
        	'nome'=>'Terno 2',
        	'preco'=>14,
        	'estoque'=>44,
        	'categoria_id'=>4
        ]);
        
    }
}
