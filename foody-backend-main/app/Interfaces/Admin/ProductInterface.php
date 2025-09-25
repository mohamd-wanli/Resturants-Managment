<?php

namespace App\Interfaces\Admin;

interface ProductInterface
{
    public function getproduct();

    public function storeproduct($data);

    public function updateproduct($id, $data);

    public function deleteproduct($id);

    public function show($id);
}
