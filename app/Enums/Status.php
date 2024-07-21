<?php

namespace App\Enums;

enum Status : String
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case FOR_EDIT = 'For Edit';
    case PUBLISHED = 'Published';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}
