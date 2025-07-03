<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];

        if ($this->user_name) {
            $data['user_name'] = $this->user_name;
        }
        if (($this->resource instanceof \Illuminate\Database\Eloquent\Model)) {
            if ($this->relationLoaded('user') && $this->user) {
                $data['user_name'] = $this->user->name;
            }
        }


        return $data;
    }
}
