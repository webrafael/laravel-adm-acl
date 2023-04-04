<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Component;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        $role = Role::create([
            'name' => 'Administrador',
            'details' => 'Controle de administradores',
            'active' => 'yes'
        ]);

        $permissionsId = [];
        $components = Component::all();

        foreach ($components ?? [] as $component) {

            $createPermission = (new Permission)->create([
                'name' => $component->name,
                'create' => 'yes',
                'read' => 'yes',
                'update' => 'yes',
                'delete' => 'yes',
            ]);

            if ($createPermission) {
                $permissionsId[] = $createPermission->id;
            }
        }

        $role->permissions()->sync($permissionsId);
        $roles = [$role->id];

        if ($user = User::find(2)) {
            $user->roles()->sync($roles);
        }

        DB::commit();
    }
}
