<?php

namespace App\Repository\User;

use App\Abstract\BaseRepositoryImplementationForMoreThanModel;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Interfaces\user\OrderInterface;
use App\Jobs\SendNotificationJob;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Statuses\UserStatus;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepositoryImplementationForMoreThanModel implements OrderInterface
{
    public function makeOrder($data)
    {
        try {
            DB::beginTransaction();
            $meals = $data['meals'];
            $estimated_time = '00:00:00';
            $sum = 0;
            foreach ($meals as $meal) {
                $Meal = $this->getById(Product::class, $meal['meal_id']);
                $sum += $meal['qty'] * $Meal->price;
                $estimated_time = max($Meal->estimated_time, $estimated_time);
            }
            $order = array_merge($data, ['total_price' => $sum, 'estimated_time' => $estimated_time]);
            $order = $this->create(Order::class, $order);
            $orderDetails = [];
            foreach ($meals as $meal) {
                $orderDetails[$meal['meal_id']] = ['order_id' => $order->id, 'qty' => $meal['qty'], 'note' => $meal['note']];

            }
            $order->orderDetail()->syncWithoutDetaching($orderDetails);
            DB::commit();
            $users = $this->where(User::class, 'user_type', UserStatus::CHEF)->get(User::class);
            dispatch(new SendNotificationJob($users));

            return ApiResponseHelper::sendMessageResponse('order created', ApiResponseCodes::CREATED);

        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}
