<?php

namespace App\Repository\SuperAdmin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Interfaces\SuperAdmin\BranchInterface;
use App\Models\Branch;

class BranchRepository extends BaseRepositoryImplementation implements BranchInterface
{
    public function model()
    {
        return Branch::class;
    }

    public function createBranch($data)
    {
        $branch = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($branch, 'Done'), ApiResponseCodes::CREATED);

    }

    public function updateBranch($id, $data)
    {
        $branch = $this->updateById($id, $data);

        return ApiResponseHelper::sendResponse(new Result($branch, 'Done'));
    }

    public function showBranch($id)
    {
        $branch = $this->getById($id);

        return ApiResponseHelper::sendResponse(new Result($branch, 'Done'));
    }

    public function deleteBranch($id)
    {
        $this->deleteById($id);

        return ApiResponseHelper::sendMessageResponse('delete branch');
    }
}
