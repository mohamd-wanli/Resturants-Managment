<?php

namespace App\Interfaces\Admin;

interface CategoryInterface
{
    public function getcategories();

    public function storecategory($data);

    public function updatecategory($id, $data);

    public function deletecategory($id);

    public function active($id);
}
