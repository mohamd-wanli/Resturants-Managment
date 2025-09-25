<?php

namespace App\Models;

use App\Models\Scopes\RestaurantAndBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'branch_id', 'restaurant_id', 'active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RestaurantAndBranch());
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function ScopeActive(Builder $builder): Builder
    {
        return $builder->where('active', 1);
    }
}
