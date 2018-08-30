<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class UserRole extends Enum
{
    const USER = 0;
    const ADMIN = 1;

    private static $titles = [
        self::USER => 'NormalUser',
        self::ADMIN => 'Admin'
    ];

    public static function getRole($role)
    {
        return self::$titles[(string)$role];
    }
}