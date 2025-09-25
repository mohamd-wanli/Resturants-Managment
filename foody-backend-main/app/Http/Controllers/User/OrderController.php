<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\makeOrderRequest;
use App\Interfaces\user\OrderInterface;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    public function makeOrder(makeOrderRequest $request)
    {
        $data = $request->validated();

        return $this->order->makeOrder($data);
    }
}
