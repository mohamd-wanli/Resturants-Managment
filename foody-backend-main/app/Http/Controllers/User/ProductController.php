<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RestaurantAndBranchRequest;
use App\Repository\User\ProductRepository;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $product)
    {
    }

    public function getProduct(RestaurantAndBranchRequest $request)
    {
        return $this->product->getProduct();
    }
}
