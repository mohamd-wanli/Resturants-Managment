<?php

namespace App\Repository\User;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\CategoryResource;
use App\Interfaces\user\CategoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepositoryImplementation implements CategoryInterface
{
    public function model()
    {
        return Category::class;
    }

    public function getCategory()
    {
        $categories = $this->get();
        $categories = CategoryResource::collection($categories);

        return ApiResponseHelper::sendResponse(new Result($categories, 'Done'));

    }
}
