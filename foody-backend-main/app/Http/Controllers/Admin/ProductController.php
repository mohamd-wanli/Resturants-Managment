<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Interfaces\Admin\ProductInterface;

class ProductController extends Controller
{
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index(BranchRequest $request)
    {
        return $this->product->getproduct();
    }

    public function store(ProductRequest $request)
    {

        return $this->product->storeproduct($request->validated());
    }

    public function update(string $id, ProductRequest $request)
    {
        return $this->product->updateproduct($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->product->deleteproduct($id);
    }

    public function show(string $id)
    {
        return $this->product->show($id);
    }
}
