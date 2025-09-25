<?php

namespace App\Models;

use App\Models\Scopes\RestaurantAndBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RestaurantAndBranch());
    }

    protected $fillable = [
        'status', 'total_price',
        'time_Waiter', 'restaurant_id', 'waiter_id', 'chef_id', 'branch_id', 'table_id', 'estimated_time'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function waiter()
    {
        return $this->belongsTo(User::class);
    }

    public function chef()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->belongsToMany(Product::class, 'orderDetail')->withPivot('id', 'qty', 'note');
    }
}
