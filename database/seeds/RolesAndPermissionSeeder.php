<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{
    Role,
    Permission
};


class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Limpando permissões
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Criando permissões e papel para administradores do sistema
         */
        Permission::create(['name' => 'create users adm']);
        Permission::create(['name' => 'update users adm']);
        Permission::create(['name' => 'delete users adm']);

        Role::create(['name' => 'adm sys'])->givePermissionTo(Permission::all());

        /**
         * Criando permissões e papel para usuario adm do setor
         */
        Permission::create(['name' => 'create acompanhador']);
        Permission::create(['name' => 'create registrador']);
        Permission::create(['name' => 'update acompanhador']);
        Permission::create(['name' => 'update registrador']);
        Permission::create(['name' => 'delete acompanhador']);
        Permission::create(['name' => 'delete registrador']);
        Role::create(['name' => 'adm'])->syncPermissions([
            'create acompanhador',
            'create registrador',
            'update acompanhador',
            'update registrador',
            'delete acompanhador',
            'delete registrador'
        ]);

        /**Criando  permissões e papel para registrador*/

        Permission::create(['name' => 'create paciente']);
        Permission::create(['name' => 'update paciente']);
        Permission::create(['name' => 'delete paciente']);
        Role::create(['name' => 'registrador'])
            ->syncPermissions(['create paciente', 'update paciente', 'delete paciente']);


        /**Criando permissões e papel para acompanhador */
        Role::create(['name' => 'acompanhador'])->givePermissionTo(['update paciente']);

        /**Atrelando papeis a usuários de teste */
        if (config('app.env') === 'local') {
            (User::find(1))->assignRole('adm sys');
            (User::find(2))->assignRole('adm');
            (User::find(3))->assignRole('acompanhador');
            (User::find(4))->assignRole('registrador');
        }
    }
}
