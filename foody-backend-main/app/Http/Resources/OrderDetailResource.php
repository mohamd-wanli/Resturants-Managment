<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'order_detail_id' => $this->pivot->id,
            'item' => $this->name,
            'qty' => $this->pivot->qty,
            'note' => $this->pivot->note,
        ];
    }
}
