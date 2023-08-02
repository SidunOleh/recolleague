<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'requests_count' => $this->requests_count,
            'last_request' => $this->last_request 
                ? $this->last_request->format('M d, Y H:i') 
                : null,
            'registred' => $this->created_at->format('M d, Y'),
            'pm_method' => $this->pm_type,
            'pm_last_four' => $this->pm_last_four,
        ];
    }
}
