<?php

use Illuminate\Database\Seeder;

class ProjetosSeeder extends Seeder
{
    public function run()
    {
        DB::table('projetos')->insert([
        	'nome'=>'Sistema de Agua',
        	'estimativa_horas'=>30
        ]);

        DB::table('projetos')->insert([
        	'nome'=>'Sistema de pacotes',
        	'estimativa_horas'=>304
        ]);

        DB::table('projetos')->insert([
        	'nome'=>'Sistema de vendas',
        	'estimativa_horas'=>90
        ]);

        DB::table('projetos')->insert([
        	'nome'=>'Sistema de Integracao Facial',
        	'estimativa_horas'=>1000
        ]);
    }
}
