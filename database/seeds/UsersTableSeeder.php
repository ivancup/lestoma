<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Alejandro',
            'lastname' => '2',
            'email' => 'alejo@ucundinamarca.edu.co',
            'password' => bcrypt('123456'),
            'id_estado' => '1'
        ]);
        $user1->assignRole('ADMINISTRADOR');

        $user1 = User::create([
            'name' => 'Liz',
            'lastname' => 'Quintero',
            'email' => 'liz@ucundinamarca.edu.co',
            'password' => bcrypt('123456'),
            'id_estado' => '1'
        ]);
        $user1->assignRole('USUARIO_ESTANDAR');
    }
}
