<?php

namespace App;

enum RoleName: string
{
    case Administrator = 'Administrador';
    case ProjectManager = 'Gerente de proyecto';
    case TeamMember = 'Miembro del equipo';

    public static function tryFromKey(string $key): ?self
    {
        foreach (self::cases() as $role) {
            if ($role->name === $key) {
                return $role;
            }
        }

        return null;
    }
}
