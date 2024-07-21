<?php

namespace App\Enums;

enum Type : String
{
    case WRITER = 'Writer';
    case EDITOR = 'Editor';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}
