<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RestaurantAndBranchRequest;
use App\Repository\User\CategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function getCategory(RestaurantAndBranchRequest $request)
    {
        return $this->category->getCategory();
    }
}
