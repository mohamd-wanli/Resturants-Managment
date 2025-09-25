<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\RestaurantRequest;
use App\Interfaces\SuperAdmin\RestaurantInterface;

class RestaurantController extends Controller
{
    protected $restaurant;

    public function __construct(RestaurantInterface $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->restaurant->getRestaurant();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request)
    {
        return $this->restaurant->createRestaurant($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->restaurant->showRestaurant($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, string $id)
    {
        return $this->restaurant->updateRestaurant($id, $request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->restaurant->deleteRestaurant($id);

    }
}
