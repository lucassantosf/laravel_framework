<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'label' => 'Administrador'],
            ['id' => 2, 'label' => 'Usuario'],
            ['id' => 3, 'label' => 'Medico'],
        ];

        DB::table('roles')->insert($roles);
    }
}
