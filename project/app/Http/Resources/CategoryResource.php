<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => route('categories.edit', $this->resource),
                'destroy' => route('categories.destroy', $this->resource),
            ],
        ];
    }
}
