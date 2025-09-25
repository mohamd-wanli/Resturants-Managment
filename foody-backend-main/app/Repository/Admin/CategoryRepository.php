<?php

namespace App\Repository\Admin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\CategoryResource;
use App\Interfaces\Admin\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends BaseRepositoryImplementation implements CategoryInterface
{
    public function model()
    {
        return Category::class;
    }

    public function getcategories()
    {

        $categories = $this->get();
        $categories = CategoryResource::collection($categories);

        return ApiResponseHelper::sendResponse(new Result($categories, 'Done'), ApiResponseCodes::CREATED);

    }

    public function storecategory($data)
    {
        $user = Auth::user();

        $categorydata = array_merge($data, ['restaurant_id' => $user->id]);

        $category = Category::create($categorydata);
        $category = CategoryResource::make($category);

        return ApiResponseHelper::sendResponse(new Result($category, 'category_created'), ApiResponseCodes::CREATED);

    }

    public function updatecategory($id, $data)
    {
        $category = $this->updateById($id, $data);

        return ApiResponseHelper::sendResponse(new Result($category, 'updated'));
    }

    public function deletecategory($id)
    {
        $this->deleteById($id);

        return ApiResponseHelper::sendMessageResponse('category deleted');

    }

    public function active($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->active = ! $category->active;
            $category->save();

            return ApiResponseHelper::sendMessageResponse('Done');
        } else {
            return false;
        }

    }
}
