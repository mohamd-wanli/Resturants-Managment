<?php

namespace App\Models\Scopes;

use App\Models\Admin;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class RestaurantAndBranch implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        $request = app('request');
        if ($user instanceof Admin) {
            $builder->where('restaurant_id', $user->restaurant_id)->where('branch_id', $user->branch_id);
        } elseif ($user instanceof Restaurant) {
            $builder->where('restaurant_id', $user->id);
            if ($request->branch_id) {
                $builder->where('branch_id', $request->branch_id);
            }

        } else {
            if ($request->restaurant_id) {
                $builder->where('restaurant_id', $request->restaurant_id);
            }
            if ($request->branch_id) {
                $builder->where('branch_id', $request->branch_id);
            }

        }

    }
}
