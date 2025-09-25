<?php

namespace App\Query\SuperAdmin;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Models\Restaurant;

class DashboardQuery
{
    public $RestaurantWithCountBranch = null;

    public function getDashboardData(): object
    {

        $result = [
            'RestaurantWithCountBranch' => $this->RestaurantWithCountBranch,

        ];

        return (object) $result;
    }

    public function RestaurantWithCountBranch()
    {
        $this->RestaurantWithCountBranch = Restaurant::select('name')->withCount('branchs')->orderBy('branchs_count', 'DESC')->get();

        return ApiResponseHelper::sendResponse(new Result($this->RestaurantWithCountBranch));
    }
}
