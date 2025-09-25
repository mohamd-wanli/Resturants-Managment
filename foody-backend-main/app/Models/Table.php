<?php

namespace App\Models;

use App\Models\Scopes\RestaurantAndBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_num', 'branch_id', 'restaurant_id', 'active', 'unique_id', 'Qr_code_path',
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

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function Active($query)
    {
        return $query->where('active', 1);
    }
}
