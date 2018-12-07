<?php

use Illuminate\Database\Seeder;

class AlocacoesSeeder extends Seeder
{ 
	public function run()
    {
        DB::table('alocacoes')->insert([
        	'projeto_id'=>1,
        	'desenvolvedor_id'=>1,
        	'horas_semanais'=>240
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>2,
        	'desenvolvedor_id'=>1,
        	'horas_semanais'=>2340
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>1,
        	'desenvolvedor_id'=>2,
        	'horas_semanais'=>240
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>1,
        	'desenvolvedor_id'=>3,
        	'horas_semanais'=>240
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>3,
        	'desenvolvedor_id'=>1,
        	'horas_semanais'=>240
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>3,
        	'desenvolvedor_id'=>2,
        	'horas_semanais'=>240
        ]);

        DB::table('alocacoes')->insert([
        	'projeto_id'=>3,
        	'desenvolvedor_id'=>3,
        	'horas_semanais'=>240
        ]);
    }
}
