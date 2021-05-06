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
        Product::query()->whereIn('id', $data['products'])->update(['promotion_id' => $promotion->id]);

        return $promotion;
    }

    public function update($id, $data)
    {
        $promotion = $this->findOrFail($id);
        $promotion->products()->update(['promotion_id' => null]);
        Product::query()->whereIn('id', $data['products'])->update(['promotion_id' => $promotion->id]);
        return parent::update($id, $data);
    }
}
