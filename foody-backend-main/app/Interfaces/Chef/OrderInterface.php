<?php

namespace App\Interfaces\Chef;

interface OrderInterface
{
    public function getOrder();

    public function changeStatusForStartPreparing(int $order_id);

    public function changeStatusForEndPreparing(int $order_id);
}
