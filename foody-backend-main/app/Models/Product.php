<?php

namespace App\Models;

use App\Models\Scopes\RestaurantAndBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'restaurant_id', 'price',
        'image', 'estimated_time', 'active', 'category_id', 'branch_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setImageAttribute($image)
    {
        $newImageName = uniqid().'_'.'product'.'.'.$image->extension();
        $image->move(public_path('asset/product'), $newImageName);

        return $this->attributes['image'] = '/'.'asset/product'.'/'.$newImageName;
    }
}
