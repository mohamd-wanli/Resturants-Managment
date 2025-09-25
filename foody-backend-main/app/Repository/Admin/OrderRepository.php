<?php

namespace App\Repository\Admin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\OrderResource;
use App\Interfaces\Admin\OrderInterface;
use App\Models\Order;

class OrderRepository extends BaseRepositoryImplementation implements OrderInterface
{
    public function model()
    {
        return Order::class;
    }

    public function getOrders()
    {
        $this->with = ['orderDetail', 'table', 'waiter', 'chef'];
        $orders = $this->get();
        $orders = OrderResource::collection($orders);

        return ApiResponseHelper::sendResponse(
            new Result($orders, 'Done')
        );
    }
}
