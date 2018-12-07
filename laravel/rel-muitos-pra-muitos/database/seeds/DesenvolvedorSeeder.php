<?php

use Illuminate\Database\Seeder;

class DesenvolvedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('desenvolvedores')->insert([
        	'nome'=>'Berndaa',
        	'cargo'=>'Analista Junior'
        ]);

		DB::table('desenvolvedores')->insert([
        	'nome'=>'Ananias',
        	'cargo'=>'Analista Pleno'
        ]);

        DB::table('desenvolvedores')->insert([
        	'nome'=>'Isak',
        	'cargo'=>'Analista Junior'
        ]);

    }
}
