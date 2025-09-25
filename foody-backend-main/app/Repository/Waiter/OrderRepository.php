<?php

namespace App\Repository\Waiter;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\OrderResource;
use App\Interfaces\Waiter\OrderInterface;
use App\Models\Order;
use App\Statuses\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepositoryImplementation implements OrderInterface
{
    public function getOrder()
    {
        $this->with = ['table'];
        $orders = $this->where('status', OrderStatus::END_PREPARING)->get();
        $orders = OrderResource::collection($orders);

        return ApiResponseHelper::sendResponse(
            new Result($orders, 'Done')
        );
    }

    public function changeStatusForDelivery(int $order_id)
    {

        $order = $this->getById($order_id);
        $timeWaiter = $order->updated_at->diffInMinutes(Carbon::now());
        $timeWaiter = Carbon::today()->addMinutes($timeWaiter)->format('H:i:s');

        $this->updateById($order_id, ['status' => OrderStatus::DELIVERY, 'time_Waiter' => $timeWaiter, 'waiter_id' => Auth::id()]);

        return ApiResponseHelper::sendMessageResponse(
            'update status order for Delivery'
        );
    }

    public function model()
    {
        return Order::class;
    }
}
