<?php

namespace App;

enum TaskStatus: string
{
    case Pending = 'Pendiente';
    case InProgress = 'En proceso';
    case Completed = 'Completado';

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
