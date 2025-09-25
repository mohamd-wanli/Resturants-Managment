<?php

namespace App\Statuses;

class UserStatus
{
    public const WAITER = 1;

    public const CHEF = 2;

    public const ADMIN = 3;

    public const SUPER_ADMIN = 4;

    public static array $statuses = [self::WAITER, self::CHEF, self::ADMIN, self::SUPER_ADMIN];
}
