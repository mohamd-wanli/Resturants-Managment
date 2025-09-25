<?php

namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chef\ChangeStatusOrderRequest;
use App\Interfaces\Chef\OrderInterface;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {

        return $this->order->getOrder();
    }

    public function changeStatusForStartPreparing(ChangeStatusOrderRequest $request)
    {
        $order_id = $request->order_id;

        return $this->order->changeStatusForStartPreparing($order_id);
    }

    public function changeStatusForEndPreparing(ChangeStatusOrderRequest $request)
    {
        $order_id = $request->order_id;

        return $this->order->changeStatusForEndPreparing($order_id);
    }
}
