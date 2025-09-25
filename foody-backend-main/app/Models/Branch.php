<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'cover', 'description', 'restaurant_id', 'active',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
