<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(
        	['nome'=>'Camisa Polo',
        	 'preco'=>100,
        	 'estoque'=>3,
        	 'categoria_id'=>1]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Camisa Luz',
        	 'preco'=>6600,
        	 'estoque'=>43,
        	 'categoria_id'=>1]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Tecs',
        	 'preco'=>20,
        	 'estoque'=>66,
        	 'categoria_id'=>3]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Tinner',
        	 'preco'=>20,
        	 'estoque'=>66,
        	 'categoria_id'=>2]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Gsolaads',
        	 'preco'=>3,
        	 'estoque'=>66,
        	 'categoria_id'=>2]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Kart',
        	 'preco'=>400,
        	 'estoque'=>234,
        	 'categoria_id'=>4]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Fusiomes',
        	 'preco'=>523,
        	 'estoque'=>2,
        	 'categoria_id'=>4]
        );

        DB::table('produtos')->insert(
        	['nome'=>'Talleres',
        	 'preco'=>100,
        	 'estoque'=>4,
        	 'categoria_id'=>2]
        );
        
    }
}
