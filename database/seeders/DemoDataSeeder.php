<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\RoleName;
use App\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $administrator = $this->demoUser('Administrador Demo', 'admin@pwapractica5.test', RoleName::Administrator);
        $manager = $this->demoUser('Gerente Demo', 'gerente@pwapractica5.test', RoleName::ProjectManager);
        $member = $this->demoUser('Miembro Demo', 'miembro@pwapractica5.test', RoleName::TeamMember);

        $project = Project::query()->updateOrCreate(
            ['name' => 'Portal académico UBE'],
            [
                'manager_id' => $manager->id,
                'description' => 'Proyecto de demostración para verificar los flujos de los tres roles.',
            ],
        );
        $project->members()->syncWithoutDetaching([$member->id]);

        Task::query()->updateOrCreate(
            ['project_id' => $project->id, 'title' => 'Diseñar panel principal'],
            [
                'assigned_to' => $member->id,
                'description' => 'Preparar la interfaz responsive del dashboard.',
                'status' => TaskStatus::InProgress,
            ],
        );
        Task::query()->updateOrCreate(
            ['project_id' => $project->id, 'title' => 'Validar permisos por rol'],
            [
                'assigned_to' => $member->id,
                'description' => 'Comprobar accesos permitidos y denegados.',
                'status' => TaskStatus::Pending,
            ],
        );

        $this->command?->info("Datos de demostración creados. Administrador: {$administrator->email}");
    }

    private function demoUser(string $name, string $email, RoleName $role): User
    {
        return User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'role_id' => Role::query()->where('name', $role->value)->firstOrFail()->id,
                'password' => Hash::make('Demo2026!'),
            ],
        );
    }
}
