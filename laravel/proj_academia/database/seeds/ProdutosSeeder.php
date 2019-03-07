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

        DB::table('produtos')->insert([
            'name' => 'Avaliacao Dermatologica',
            'value' => 99,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Camisa Azul A',
            'value' => 30,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Garrafinha',
            'value' => 5,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Massagem Tipo 2',
            'value' => 190,
        ]);
    }
}
