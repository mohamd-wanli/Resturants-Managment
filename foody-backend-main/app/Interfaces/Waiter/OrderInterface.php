<?php

namespace App\Interfaces\Waiter;

interface OrderInterface
{
    public function getOrder();

    public function changeStatusForDelivery(int $order_id);
}
