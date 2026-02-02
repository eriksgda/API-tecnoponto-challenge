<?php

namespace App\Enums;

enum CharStatus: string
{
    case ALIVE = 'Alive';
    case DEAD = 'Dead';
    case UNKNOWN = 'unknown';

    public function translate(): string
    {
        return match ($this) {
            self::ALIVE => 'Vivo',
            self::DEAD => 'Morto',
            self::UNKNOWN => "Desconhecido"
        };
    }
}
