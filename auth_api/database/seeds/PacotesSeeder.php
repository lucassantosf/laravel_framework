<?php

use Illuminate\Database\Seeder;

class PacotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pacotes = [
            ['descricao' => 'Pacote Inicial' , 'valor' => 0.00, 'especialidades' => 1, 'perguntas' => 3, 'trocas_especialidade' => 0,'status'=>1 , 'created_at'=>date('Y-m-d H:i:s')],
            ['descricao' => 'Pacote Intermedium' , 'valor' => 10.00, 'especialidades' => 3, 'perguntas' => 10, 'trocas_especialidade' => 3, 'status'=>1 , 'created_at'=>date('Y-m-d H:i:s')],
            ['descricao' => 'Pacote Premium' , 'valor' => 10.00, 'especialidades' => 4, 'perguntas' => 15, 'trocas_especialidade' => 4, 'status'=>1 , 'created_at'=>date('Y-m-d H:i:s')],
        ];

        DB::table('pacotes')->insert($pacotes);
    }
}
