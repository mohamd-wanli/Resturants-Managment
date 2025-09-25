<?php

namespace App\Interfaces\SuperAdmin;

interface RestaurantInterface
{
    public function createRestaurant($data);

    public function updateRestaurant($id, $data);

    public function showRestaurant($id);

    public function deleteRestaurant($id);

    public function getRestaurant();
}
