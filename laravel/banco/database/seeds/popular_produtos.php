<?php

use Illuminate\Database\Seeder;

class popular_produtos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('produtos')->insert([
			'nome'=>'Produto 1',
			'preco'=>12,
			'estoque'=>20,
			'categoria_id'=>2,
		]);

		DB::table('produtos')->insert([
			'nome'=>'Produto 122',
			'preco'=>122,
			'estoque'=>250,
			'categoria_id'=>2,
		]);

		DB::table('produtos')->insert([
			'nome'=>'Produto 1321',
			'preco'=>122,
			'estoque'=>520,
			'categoria_id'=>4,
		]);

		DB::table('produtos')->insert([
			'nome'=>'Produto 321',
			'preco'=>112,
			'estoque'=>203,
			'categoria_id'=>1,
		]);

    }
}
