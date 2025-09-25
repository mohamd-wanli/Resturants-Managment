<?php

namespace App\Repository\Admin;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Interfaces\Admin\BranchInterface;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchRepository implements BranchInterface
{
    public function getBranches()
    {

        $branches = Branch::select('name', 'id')->where('restaurant_id', Auth::id())->get();

        return ApiResponseHelper::sendResponse(new Result($branches, 'Done'));

    }
}
