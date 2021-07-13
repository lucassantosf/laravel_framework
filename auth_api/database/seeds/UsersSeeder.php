<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
		        'name' => 'Admin',
		        'role_id' => '1',
		        'image' => NULL,
		        'username' => 'admin',
		        'email' => 'master@mail.com',
		        'password' => bcrypt('123'),
		        'remember_token' => '',
		        'created_at' => date('Y-m-d H:i:s'),
	            'updated_at' =>date('Y-m-d H:i:s'),
		    ],
		    [
		        'name' => 'Usuario',
		        'role_id' => '2',
		        'image' => NULL,
		        'username' => 'cpf_11111111111',
		        'email' => 'master+usuario@mail.com',
		        'password' => bcrypt('123456'),
		        'remember_token' => '',
	       		'created_at' => date('Y-m-d H:i:s'),
	            'updated_at' =>date('Y-m-d H:i:s'),
		    ],
		    [
		        'name' => 'Médico',
		        'role_id' => '3',
		        'image' => NULL,
		        'username' => 'crm_1122334455',
		        'email' => 'master+medico@mail.com',
		        'password' => bcrypt('123456'),
		        'remember_token' => '',
		        'created_at' => date('Y-m-d H:i:s'),
	        	'updated_at' =>date('Y-m-d H:i:s'),
		    ]
        ];

        DB::table('users')->insert($users);
    }
}