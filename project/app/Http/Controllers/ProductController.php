<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Repositories\BaseRepository;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->repository = new BaseRepository(Product::class);
        $this->resource = ProductResource::class;
    }

    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        $product = Product::factory()->empty()->make();
        $units = (new BaseRepository(Unit::class))->all()->sortBy('name');
        $categories = (new BaseRepository(Category::class))->all()->sortBy('name');

        return view('products.create', compact('product', 'units', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = $this->repository->create($data);
        $product->addMediaFromRequest('image')->toMediaCollection('image');

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'products.index');
    }

    public function edit($id)
    {
        $product = $this->repository->findOrFail($id);
        $units = (new BaseRepository(Unit::class))->all()->sortBy('name');
        $categories = (new BaseRepository(Category::class))->all()->sortBy('name');
        return view('products.edit', compact('product', 'units', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();

        $product = $this->repository->update($id, $data);
        if(data_get($data, 'image'))
            $product->addMediaFromRequest('image')->toMediaCollection('image');

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'products.index');
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
            ->defaultOrderBy('name', 'DESC')
            ->resource($this->resource);
    }
}
