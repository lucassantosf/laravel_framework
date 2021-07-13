<?php

use Illuminate\Database\Seeder;

class InformacoesSeeder extends Seeder
{
    public function run()
    {
        factory(App\Info::class, 1)->create();
    }
}
