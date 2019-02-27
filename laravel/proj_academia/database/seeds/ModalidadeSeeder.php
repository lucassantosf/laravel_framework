<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades')->insert([
            'name' => 'Fitness',
            'value' => 100,
            'freq' => 5,
        ]);

        DB::table('modalidades')->insert([
            'name' => 'Jump',
            'value' => 200,
            'freq' => 3,
        ]);

        DB::table('modalidades')->insert([
            'name' => 'Dança',
            'value' => 130,
            'freq' => 2,
        ]);

        DB::table('modalidades')->insert([
            'name' => 'Ginastica',
            'value' => 280,
            'freq' => 2,
        ]);

        DB::table('modalidades')->insert([
            'name' => 'Bike',
            'value' => 80,
            'freq' => 4,
        ]);
    }
}
