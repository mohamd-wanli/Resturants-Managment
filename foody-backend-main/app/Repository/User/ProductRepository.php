<?php

namespace App\Repository\User;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\ProductResource;
use App\Interfaces\user\ProductInterface;
use App\Models\Product;

class ProductRepository extends BaseRepositoryImplementation implements ProductInterface
{
    public function model()
    {
        return Product::class;
    }

    public function getProduct()
    {
        $products = $this->get();
        $products = ProductResource::collection($products);

        return ApiResponseHelper::sendResponse(new Result($products, 'Done'));
    }
}
