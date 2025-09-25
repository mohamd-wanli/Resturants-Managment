<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\OrderRepository;

class OrderController extends Controller
{
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function getOrders()
    {
        return $this->order->getOrders();
    }
}
