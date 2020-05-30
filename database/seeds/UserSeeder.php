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
        User::create([
            'nome' => 'Nome',
            'cpf' => '057.162.595-96',
            'password' => Hash::make('123123123')
        ]);

    }
}
