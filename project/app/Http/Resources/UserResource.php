<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => route('users.edit', $this->id),
                'show' => route('users.show', $this->id),
                'destroy' => $this->when(
                    $this->id != current_user()->id,
                    route('users.destroy', $this->id)
                ),
            ]
        ];
    }
}
