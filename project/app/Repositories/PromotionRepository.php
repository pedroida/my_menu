<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Promotion;

class PromotionRepository extends Repository
{
    protected function getClass()
    {
        return Promotion::class;
    }

    public function create($data)
    {
        $promotion = parent::create($data);
        (new ProductRepository())->model->whereIn('id', $data['products'])->update(['promotion_id' => $promotion->id]);

        return $promotion;
    }

    public function update($id, $data)
    {
        $promotion = $this->findOrFail($id);
        $promotion->products()->update(['promotion_id' => null]);
        (new ProductRepository())->model->whereIn('id', $data['products'])->update(['promotion_id' => $promotion->id]);
        return parent::update($id, $data);
    }

    public function findWithProducts($id)
    {
        $promotion = $this->findOrFail($id);

        $promotion->products->map(function ($product) {
            $product->name = $product->compound_name;
            return $product;
        });

        return $promotion;
    }
}
