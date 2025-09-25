<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
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
            'table_num' => $this->table_num,
            'active' => boolval($this->active),
            'unique_id' => $this->unique_id,
            'Qr_code_path' => asset($this->Qr_code_path),

        ];
    }
}
