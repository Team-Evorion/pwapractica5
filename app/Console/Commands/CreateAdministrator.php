<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\RoleName;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

#[Signature('app:create-administrator {--name=} {--email=} {--password=}')]
#[Description('Crea de forma segura el primer usuario administrador')]
class CreateAdministrator extends Command
{
    public function handle(): int
    {
        $data = [
            'name' => $this->option('name') ?: $this->ask('Nombre'),
            'email' => $this->option('email') ?: $this->ask('Correo electrónico'),
            'password' => $this->option('password') ?: $this->secret('Contraseña (mínimo 8 caracteres)'),
        ];

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', Password::min(8)],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $role = Role::query()->firstOrCreate(['name' => RoleName::Administrator->value]);
        $user = User::query()->create([
            ...$validator->validated(),
            'role_id' => $role->id,
        ]);

        $this->info("Administrador creado: {$user->email}");

        return self::SUCCESS;
    }
}
