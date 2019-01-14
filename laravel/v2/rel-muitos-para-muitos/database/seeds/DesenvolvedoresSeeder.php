<?php

use Illuminate\Database\Seeder;

class DesenvolvedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desenvolvedores')->insert(['nome'=>'Naddaade Kol','cargo'=>'Analista Pleno']);
        DB::table('desenvolvedores')->insert(['nome'=>'Jukii Aol','cargo'=>'Analista Junior']);
        DB::table('desenvolvedores')->insert(['nome'=>'Herna Null','cargo'=>'Programador Pleno']);
        DB::table('desenvolvedores')->insert(['nome'=>'Luree Pol','cargo'=>'Analista Senior']);
    }
}
