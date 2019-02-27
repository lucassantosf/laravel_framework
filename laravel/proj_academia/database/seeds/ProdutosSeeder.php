<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'name' => 'Camisa Longa',
            'value' => 50,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Avaliacao Física',
            'value' => 100,
        ]);
    }
}
