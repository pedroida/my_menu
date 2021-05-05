<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => route('units.edit', $this->resource),
                'destroy' => route('units.destroy', $this->resource),
            ],
        ];
    }
}
