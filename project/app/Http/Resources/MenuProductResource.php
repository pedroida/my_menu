<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class MenuProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'promotional_price' => $this->promotional_price,
            'description' => $this->description,
            'category' => $this->category->name,
            'unit' => $this->unit->name,
            'thumbnail' => route('product.thumb', $this->resource),
            'created_at' => format_date($this->created_at),
            'whatsapp_request' => $this->getWhatsUrl(),
        ];
    }

    private function getWhatsUrl()
    {
        if (!store()->whatsapp)
            return null;

        $whatsapp = preg_replace('/\W/', '', store()->whatsapp);
        $whatsapp = '55' . $whatsapp;
        $text = urlencode('Gostaria de pedir um(a): ' . $this->name);

        return "https://wa.me/{$whatsapp}/?text={$text}";
    }
}
