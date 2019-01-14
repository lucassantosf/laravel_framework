<?php

use Illuminate\Database\Seeder;

class ProjetosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projetos')->insert(['nome'=>'Sistema de Agua Kol','estimativa_horas'=>200]);
        DB::table('projetos')->insert(['nome'=>'Sistema de Esgoto G','estimativa_horas'=>10]);
        DB::table('projetos')->insert(['nome'=>'Sistema de Vendas','estimativa_horas'=>20]);
        DB::table('projetos')->insert(['nome'=>'Sistema de Controle ASS','estimativa_horas'=>1000]);
        DB::table('projetos')->insert(['nome'=>'Sistema ERP A3','estimativa_horas'=>400]);
        
    }
}
