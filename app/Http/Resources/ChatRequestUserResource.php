<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRequestUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'email' => $this->user->email ?? '',
            'uri' => $this->uri,
            'style' => $this->style,
            'sent' => $this->created_at->format('M d, Y H:i')
        ];
    }
}
