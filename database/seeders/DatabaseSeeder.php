<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ComponentTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ComponentTableSeeder::class);
        $this->call(RoleTableSeeder::class);
    }
}
