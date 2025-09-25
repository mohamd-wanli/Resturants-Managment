<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        if ($user instanceof Admin) {
            return [
                'restaurant_id' => $this->id,
                'restaurant_name' => $this->name,
                'restaurant_email' => $this->email,
                'restaurant_description' => $this->description ?? 'Not found',
                'joining_date' => $this->created_at->toDateString(),
                'branchs' => BranchResource::collection($this->branchs),

            ];
        }

        return [];
    }
}
