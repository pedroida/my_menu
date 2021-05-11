<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    protected function getClass()
    {
        return Product::class;
    }

    public function available($currentPromotion = null)
    {
        $this->resetQuery();
        $this->resetScope();

        return $this->model
            ->whereDoesntHave('promotion')
            ->when($currentPromotion, function ($query) use($currentPromotion) {
                return $query->where(function ($query) use($currentPromotion) {
                    return $query->whereDoesntHave('promotion')
                        ->orWhereIn('id', $currentPromotion->products->map->id);
                });
            })
            ->orderBy('name')
            ->with(['category', 'unit'])
            ->get()
            ->map(function ($product) {
                $product->name = $product->compound_name;
                return $product;
            });
    }
}
