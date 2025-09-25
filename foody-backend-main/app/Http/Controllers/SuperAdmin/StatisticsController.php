<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Query\SuperAdmin\DashboardQuery;

class StatisticsController extends Controller
{
    public function __construct(private DashboardQuery $dashboard)
    {
    }

    public function RestaurantWithCountBranch()
    {
        return $this->dashboard->RestaurantWithCountBranch();

    }
}
