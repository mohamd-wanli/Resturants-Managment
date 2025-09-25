<?php

namespace App\Query\Admin;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Statuses\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardQuery
{
    public function CompareFoodsByRequest($branch_id)
    {
        $restaurantId = Auth::id();
        $products = DB::table('products as pr')
            ->leftJoin('orderdetail as od', 'pr.id', '=', 'od.product_id')
            ->leftJoin('orders as o', function ($join) use ($restaurantId, $branch_id) {
                $join->on('o.id', '=', 'od.order_id')
                    ->where('o.restaurant_id', '=', $restaurantId)
                    ->where('o.branch_id', '=', $branch_id);
            })
            ->select(
                'pr.id as product_id',
                'pr.name',
                DB::raw('COALESCE(COUNT(od.product_id), 0) as count')
            )
            ->where('pr.restaurant_id', '=', $restaurantId)
            ->where('pr.branch_id', '=', $branch_id)
            ->groupBy('pr.id', 'pr.name')
            ->orderBy(DB::raw('COUNT(od.product_id)'), 'DESC')
            ->get();

        return ApiResponseHelper::sendResponse(new Result($products, 'Compare Foods By Request'));

    }

    public function CompareDaysByRequest($branch_id)
    {

        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $daysCount = DB::table('orders as o')
            ->join('orderdetail as od', 'o.id', '=', 'od.order_id')
            ->select(
                DB::raw('DAYNAME(o.created_at) as order_day'),
                DB::raw('COUNT(DAYNAME(o.created_at)) as count')
            )
            ->where('o.restaurant_id', Auth::id())
            ->where('o.branch_id', $branch_id)
            ->groupBy('order_day')
            ->orderByRaw("FIELD(order_day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")
            ->get()
            ->keyBy('order_day')
            ->toArray();

        $results = [];
        foreach ($daysOfWeek as $day) {
            $results[] = [
                'order_day' => $day,
                'count' => $daysCount[$day]->count ?? 0,
            ];
        }

        $daysCount = collect($results);

        return ApiResponseHelper::sendResponse(new Result($daysCount, 'Compare Days By Request'));

    }

    public function CompareWaitersByAverageOrder($branch_id)
    {

        $waiterAverages = DB::table('users as u')
            ->leftJoin('orders as o', 'u.id', '=', 'o.waiter_id')
            ->select(
                'u.id',
                'u.name',
                DB::raw("TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(o.time_Waiter))), '%H:%i:%s') as avg_time_waiter")
            )
            ->where('u.user_type', UserStatus::WAITER)
            ->where('u.branch_id', $branch_id)
            ->where('u.restaurant_id', Auth::id())
            ->groupBy('u.id', 'u.name')
            ->get();

        return ApiResponseHelper::sendResponse(new Result($waiterAverages, 'Compare Waiters By Average Order'));

    }

    public function CompareHourByDate($data)
    {

        $ordersByHour = DB::table('orders')
            ->whereDate('created_at', $data['date'])
            ->where('restaurant_id', Auth::id())
            ->where('branch_id', $data['branch_id'])
            ->selectRaw('HOUR(created_at) as order_hour, COUNT(*) as order_count')
            ->groupBy(DB::raw('HOUR(created_at)'))
            ->orderBy('order_hour')
            ->get();

        return ApiResponseHelper::sendResponse(new Result($ordersByHour, 'Compare Hour By Date'));

    }
}
