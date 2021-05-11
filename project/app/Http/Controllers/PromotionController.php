<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionRequest;
use App\Http\Resources\PromotionResource;
use App\Models\Product;
use App\Models\Promotion;
use App\Repositories\Criterias\Common\With;
use App\Repositories\ProductRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\Repository;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->repository = new PromotionRepository();
        $this->resource = PromotionResource::class;
    }

    public function index()
    {
        return view('promotions.index');
    }

    public function create()
    {
        $promotion = Promotion::factory()->empty()->make();
        $products = (new ProductRepository())->available();

        return view('promotions.create', compact('promotion', 'products'));
    }

    public function store(PromotionRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'promotions.index');
    }

    public function show($id)
    {
        $promotion = $this->repository->findOrFail($id);
        return view('promotions.show', compact('promotion'));
    }

    public function edit($id)
    {
        $promotion = $this->repository->findWithProducts($id);
        $products = (new ProductRepository())->available($promotion);

        return view('promotions.edit', compact('promotion', 'products'));
    }

    public function update(PromotionRequest $request, $id)
    {
        $data = $request->validated();

        $product = $this->repository->update($id, $data);
        if (data_get($data, 'image'))
            $product->addMediaFromRequest('image')->toMediaCollection('image');

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'promotions.index');
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getThumb(Product $product)
    {
        return response($product->thumbnail, 200, ['Content-Type:image/*']);
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->criterias([new With(['products:id,promotion_id'])])
            ->defaultOrderBy('name', 'DESC')
            ->resource($this->resource);
    }
}
