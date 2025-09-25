<?php

namespace App\Statuses;

class OrderStatus
{
    public const PENDING = 1;

    public const START_PREPARING = 2;

    public const END_PREPARING = 3;

    public const DELIVERY = 4;

    public static array $statuses = [self::PENDING, self::START_PREPARING, self::END_PREPARING, self::DELIVERY];
}
