<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->resource
        ];
    }
}
