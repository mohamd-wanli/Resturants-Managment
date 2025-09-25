<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use App\Models\User;
use App\Statuses\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        if ($user instanceof User && $user->user_type == UserStatus::CHEF) {
            return [
                'order_id' => $this->id,
                'table_name' => $this->table->table_num ?? null,
                'estimated_time' => $this->estimated_time,
                'status' => $this->status,
                'meals' => OrderDetailResource::collection($this->orderDetail),
            ];
        } elseif ($user instanceof User && $user->user_type == UserStatus::WAITER) {
            return [
                'order_id' => $this->id,
                'table_name' => $this->table->table_num,
                'estimated_time' => $this->estimated_time,
                'status' => $this->status,
            ];
        } elseif ($user instanceof Restaurant) {
            return [
                'order_id' => $this->id,
                'table_name' => $this->table->table_num,
                'waiter_name' => $this->waiter->name ?? '-',
                'time_Waiter' => $this->time_Waiter ?? '-',
                'chef_name' => $this->chef->name ?? '-',
                'total_price' => $this->total_price,
                'estimated_time' => $this->estimated_time,
                'status' => $this->status,
                'created_at' => $this->created_at->toDateString(),
                'meals' => OrderDetailResource::collection($this->orderDetail),

            ];
        }

        return [];
    }
}
