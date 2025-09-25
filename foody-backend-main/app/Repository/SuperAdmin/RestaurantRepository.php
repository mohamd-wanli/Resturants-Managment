<?php

namespace App\Repository\SuperAdmin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\RestaurantResource;
use App\Interfaces\SuperAdmin\RestaurantInterface;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;

class RestaurantRepository extends BaseRepositoryImplementation implements RestaurantInterface
{
    public function model()
    {
        return Restaurant::class;
    }

    public function createRestaurant($data)
    {
        $password = rand(0000, 9999);
        $restaurant = $this->create(array_merge($data, ['password' => Hash::make($password)]));

        return ApiResponseHelper::sendResponse(new Result($restaurant, 'Done'), ApiResponseCodes::CREATED);
    }

    public function getRestaurant()
    {
        $this->with('branchs');
        $restaurants = $this->get();
        $restaurants = RestaurantResource::collection($restaurants);

        return ApiResponseHelper::sendResponse(new Result($restaurants, 'Done'), ApiResponseCodes::CREATED);

    }

    public function updateRestaurant($id, $data)
    {
        $restaurant = $this->updateById($id, $data);

        return ApiResponseHelper::sendResponse(new Result($restaurant, 'Done'));

    }

    public function showRestaurant($id)
    {
        $restaurant = $this->getById($id, ['id', 'name', 'email', 'description']);

        return ApiResponseHelper::sendResponse(new Result($restaurant, 'Done'));
    }

    public function deleteRestaurant($id)
    {
        $this->deleteById($id);

        return ApiResponseHelper::sendMessageResponse('delete restaurant ');

    }
}
