<?php

namespace App\Http\Resources;

use App\Enums\PromotionTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PromotionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'value' => $this->formatted_value,
            'products_count' => $this->products->count(),
            'valid_from' => format_date($this->valid_from, 'd/m/Y'),
            'valid_until' => format_date($this->valid_until, 'd/m/Y'),
            'type' => ($this->type === PromotionTypeEnum::PERCENTAGE) ? 'Porcentagem' : 'Valor de desconto',
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => route('promotions.edit', $this->resource),
                'show' => route('promotions.show', $this->resource),
                'destroy' => route('promotions.destroy', $this->resource),
            ],
        ];
    }
}
