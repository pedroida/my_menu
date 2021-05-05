<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->compound_name,
            'price' => $this->price,
            'description' => Str::limit($this->description, 20),
            'category' => $this->category->name,
            'unit' => $this->unit->name,
            'thumbnail' => route('product.thumb', $this->resource),
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => route('products.edit', $this->resource),
                'show' => route('products.show', $this->resource),
                'destroy' => route('products.destroy', $this->resource),
            ],
        ];
    }
}
