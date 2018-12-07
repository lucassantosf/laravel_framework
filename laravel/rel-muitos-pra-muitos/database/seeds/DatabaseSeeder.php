<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ProjetosSeeder::class);
        $this->call(DesenvolvedorSeeder::class);
        $this->call(AlocacoesSeeder::class);
    }
}
