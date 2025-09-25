<?php

namespace App\Statuses;

class ActiveStatus
{
    public const UN_ACTIVE = 0;

    public const ACTIVE = 1;

    public static array $statuses = [self::ACTIVE, self::UN_ACTIVE];
}
