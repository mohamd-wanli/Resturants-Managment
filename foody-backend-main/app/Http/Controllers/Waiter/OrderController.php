<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chef\ChangeStatusOrderRequest;
use App\Interfaces\Waiter\OrderInterface;

class OrderController extends Controller
{
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {

        return $this->order->getOrder();
    }

    public function changeStatusForDelivery(ChangeStatusOrderRequest $request)
    {
        $order_id = $request->order_id;

        return $this->order->changeStatusForDelivery($order_id);
    }
}
