<?php

namespace Database\Seeders;

use App\Models\Role;
use App\RoleName;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleName::cases() as $role) {
            Role::query()->firstOrCreate(['name' => $role->value]);
        }
    }
}
