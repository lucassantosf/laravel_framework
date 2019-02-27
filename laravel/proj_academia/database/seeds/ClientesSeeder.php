<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'name' => 'Robherval Antunes',
            'name_mother' => 'Sunizall Ango',
            'name_father' => 'Chalebes Karll',
            'sexo' => 1,
            'est_civil' => 1,
            'cpf' => '349.000.000-51',
            'rg' => '34.165.232-5',
            'rne' => '',
            'phone' => '(11)912341234',
            'email' => 'robherval@gmail.com',
            'cep' => '18078-792',
            'address' => 'Rua Myrna Barbosa Raszl',
            'number' => '123',
            'comple' => 'Logo ali',
            'neigh' => 'Jardim Sorocaba Park',
            'country' => 'Brazil',
            'uf' => 'SP',
            'city' => 'Sorocaba',
        ]);

        DB::table('clientes')->insert([
            'name' => 'Formosandrino Lifi Pereira',
            'name_mother' => 'Ant Plak',
            'name_father' => 'Hernan Abrr',
            'sexo' => 1,
            'est_civil' => 1,
            'cpf' => '523.592.190-90',
            'rg' => '34.168.123-4',
            'rne' => '',
            'phone' => '(11)912341234',
            'email' => 'formosandrino@gmail.com',
            'cep' => '18078-792',
            'address' => 'Rua Myrna Barbosa Raszl',
            'number' => '123',
            'comple' => 'Logo ali',
            'neigh' => 'Jardim Sorocaba Park',
            'country' => 'Brazil',
            'uf' => 'SP',
            'city' => 'Sorocaba',
        ]);

        DB::table('clientes')->insert([
            'name' => 'Gerley Hiuks Jut',
            'name_mother' => 'Arnir Blackaa',
            'name_father' => 'Pekeus Jaaka',
            'sexo' => 1,
            'est_civil' => 1,
            'cpf' => '844.864.250-30',
            'rg' => '43.640.708-5',
            'rne' => '',
            'phone' => '(11)912341234',
            'email' => 'gerley@gmail.com',
            'cep' => '18078-792',
            'address' => 'Rua Myrna Barbosa Raszl',
            'number' => '123',
            'comple' => 'Logo ali',
            'neigh' => 'Jardim Sorocaba Park',
            'country' => 'Brazil',
            'uf' => 'SP',
            'city' => 'Sorocaba',
        ]);

        DB::table('clientes')->insert([
            'name' => 'Fukiss Blatee Hock',
            'name_mother' => 'Hokert Gea',
            'name_father' => 'Deliss Flack',
            'sexo' => 1,
            'est_civil' => 1,
            'cpf' => '293.838.700-87',
            'rg' => '24.269.158-4',
            'rne' => '',
            'phone' => '(11)912341234',
            'email' => 'fukiss@gmail.com',
            'cep' => '18078-792',
            'address' => 'Rua Myrna Barbosa Raszl',
            'number' => '123',
            'comple' => 'Logo ali',
            'neigh' => 'Jardim Sorocaba Park',
            'country' => 'Brazil',
            'uf' => 'SP',
            'city' => 'Sorocaba',
        ]);

        DB::table('clientes')->insert([
            'name' => 'Funes Morennn',
            'name_mother' => 'Kghjull Abdu',
            'name_father' => 'Azile Hyong',
            'sexo' => 1,
            'est_civil' => 1,
            'cpf' => '968.521.980-06',
            'rg' => '47.690.105-4',
            'rne' => '',
            'phone' => '(11)912341234',
            'email' => 'fukiss@gmail.com',
            'cep' => '18078-792',
            'address' => 'Rua Myrna Barbosa Raszl',
            'number' => '123',
            'comple' => 'Logo ali',
            'neigh' => 'Jardim Sorocaba Park',
            'country' => 'Brazil',
            'uf' => 'SP',
            'city' => 'Sorocaba',
        ]);
    }
}
