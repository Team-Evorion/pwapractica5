<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleNames = [
            'Administrador',
            'Gerente de proyecto',
            'Miembro del equipo',
        ];

        foreach ($roleNames as $roleName) {
            Role::query()->firstOrCreate(['name' => $roleName]);
        }
    }
}
