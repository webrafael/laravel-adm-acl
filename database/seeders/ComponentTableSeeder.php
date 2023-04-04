<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComponentTableSeeder extends Seeder
{
    const COMPONENT_VERSION_DEFAULT = '1.0.0';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::create([
            'name' => 'users',
            'description' => 'Controle de usuários',
            'version' => self::COMPONENT_VERSION_DEFAULT
        ]);

        Component::create([
            'name' => 'roles',
            'description' => 'Controle de cargos e permissões',
            'version' => self::COMPONENT_VERSION_DEFAULT
        ]);
    }
}
