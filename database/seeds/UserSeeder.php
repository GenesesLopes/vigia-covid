<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**Finserindo usuários para teste */
        if(config('app.env') === 'local'){
            
            User::create([
                'nome' => 'Adm Sys',
                'cpf' => '929.801.790-19',
                'password' => Hash::make('123123')
            ]);

            User::create([
                'nome' => 'Adm',
                'cpf' => '957.334.600-16',
                'password' => Hash::make('123123')
            ]);

            User::create([
                'nome' => 'Acompanhador',
                'cpf' => '363.015.910-97',
                'password' => Hash::make('123123')
            ]);

            User::create([
                'nome' => 'Registrador',
                'cpf' => '814.587.280-48',
                'password' => Hash::make('123123')
            ]);
        }
        

    }
}
