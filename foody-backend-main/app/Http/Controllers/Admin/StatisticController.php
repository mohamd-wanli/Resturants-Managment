<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Http\Requests\Admin\ChartHourRequest;
use App\Query\Admin\AdminDashboardQuery;

class StatisticController extends Controller
{
    public function __construct(AdminDashboardQuery $adminDashboard)
    {
        $this->adminDashboard = $adminDashboard;
    }

    public function CompareFoodsByRequest(BranchRequest $request)
    {
        return $this->adminDashboard->CompareFoodsByRequest($request->branch_id);
    }

    public function CompareDaysByRequest(BranchRequest $request)
    {
        return $this->adminDashboard->CompareDaysByRequest($request->branch_id);
    }

    public function CompareWaitersByAverageOrder(BranchRequest $request)
    {
        return $this->adminDashboard->CompareWaitersByAverageOrder($request->branch_id);
    }

    public function CompareHourByDate(ChartHourRequest $request)
    {
        return $this->adminDashboard->CompareHourByDate($request->validated());
    }
}
