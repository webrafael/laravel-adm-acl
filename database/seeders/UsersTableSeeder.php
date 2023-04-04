<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador Root',
            'username' => 'root',
            'email' => 'root@root.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'Administrador',
            'username' => 'adm',
            'email' => 'adm@adm.com.br',
            'password' => bcrypt('12345678')
        ]);
    }
}
