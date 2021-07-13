<?php

use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = [
            ['id' => 1, 'descricao' => 'Clínica Médica'],
            ['id' => 2, 'descricao' => 'Pediatria'],
            ['id' => 3, 'descricao' => 'Ginecologia'],
            ['id' => 4, 'descricao' => 'Oncologia'],
            ['id' => 5, 'descricao' => 'Dermatologia']
        ];

        DB::table('especialidades')->insert($especialidades);

        $medicosespecialidades = [
            ['id' => 1, 'user_id' => 3, 'especialidade_id' => 1],
            ['id' => 2, 'user_id' => 3, 'especialidade_id' => 2],
            ['id' => 3, 'user_id' => 3, 'especialidade_id' => 3],
            ['id' => 4, 'user_id' => 3, 'especialidade_id' => 4],
            ['id' => 5, 'user_id' => 3, 'especialidade_id' => 5] 
        ];

        DB::table('medicos_especialidades')->insert($medicosespecialidades);
    }
}
