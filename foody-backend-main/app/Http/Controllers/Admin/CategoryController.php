<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\Admin\CategoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index(BranchRequest $request)
    {
        return $this->category->getcategories();
    }

    public function store(CategoryRequest $request)
    {
        return $this->category->storecategory($request->validated());
    }

    public function update($id, CategoryRequest $req)
    {
        return $this->category->updatecategory($id, $req->validated());
    }

    public function destroy(string $id)
    {
        return $this->category->deletecategory($id);
    }

    public function active(string $id)
    {
        return $this->category->active($id);
    }
}
