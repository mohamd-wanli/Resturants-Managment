<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BranchResource extends JsonResource
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
                'branch_id' => $this->id,
                'branch_name' => $this->name,
                'branch_description' => $this->description ?? 'Not found',
                'joining_date' => $this->created_at->toDateString(),

            ];
        }

        return [];
    }
}
