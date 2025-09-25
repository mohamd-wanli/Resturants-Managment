<?php

namespace App\Repository\Admin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\ProductResource;
use App\Interfaces\Admin\ProductInterface;
use App\Models\Product;
use App\Traits\imageTrait;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends BaseRepositoryImplementation implements ProductInterface
{
    use imageTrait;

    public function model()
    {
        return Product::class;
    }

    public function getproduct()
    {
        $this->with = ['category'];
        $product = $this->get();
        $product = ProductResource::collection($product);

        return ApiResponseHelper::sendResponse(new Result($product, 'get_products'), ApiResponseCodes::CREATED);
    }

    public function storeproduct($data)
    {
        $user = Auth::user();
        $product = $this->create(array_merge($data, ['restaurant_id' => $user->id]));

        return ApiResponseHelper::sendResponse(new Result($product, 'product_created'), ApiResponseCodes::CREATED);
    }

    public function updateProduct($id, $data)
    {

        $product = $this->updateById($id, $data);

        return ApiResponseHelper::sendResponse(new Result($product, 'updated'));
    }

    public function deleteProduct($id)
    {
        $this->deleteById($id);

        return ApiResponseHelper::sendMessageResponse(' deleted');
    }

    public function show($id)
    {
        $product = $this->getById($id);
        $product = ProductResource::make($product);

        return ApiResponseHelper::sendResponse(new Result($product, 'updated'));

    }
}
