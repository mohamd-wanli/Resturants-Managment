<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category->name,
            'category_id' => $this->category->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'img' => asset($this->image),
            'estimated_time' => $this->estimated_time,
            'active' => boolval($this->active),

        ];
    }
}
