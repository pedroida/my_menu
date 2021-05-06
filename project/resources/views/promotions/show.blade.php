@extends('layouts.app')
@section('title', __('headings.products.show'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.products.show')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('products.index') }}">
            @lang('breadcrumb.products.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.show')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <div class="card card-secondary">
        <div class="card-body pb-0">

            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <img src="{{ route('product.thumb', $product->id) }}" alt="{{ $product->name }}" class="img-thumbnail m-auto">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <div class="form-row">
                        <div class="form-group col-12 col-md-4">
                            <label for="name">
                                @lang('labels.common.name')
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-font"></i>
                                    </span>
                                </div>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}"
                                       disabled>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-2">
                            <label for="price">
                                @lang('labels.common.price')
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                </div>
                                <input type="text" name="price" class="form-control mask-money"
                                       value="{{ $product->price }}" disabled>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <label for="unit_id">
                                @lang('labels.common.unit')
                            </label>
                            <input type="text" name="unit" class="form-control" value="{{ $product->unit->name }}"
                                   disabled>
                        </div>

                        <div class="form-group col-12 col-md-3 p-md-0">
                            <label for="category_id">
                                @lang('labels.common.category')
                            </label>
                            <input type="text" name="category" class="form-control"
                                   value="{{ $product->category->name }}" disabled>

                        </div>

                        <div class="form-group col-12">
                            <label for="description">
                                @lang('labels.common.description')
                            </label>

                            <textarea name="description" class="form-control"
                                      disabled>{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                @include('shared.show_buttons', [
                    'urlBack' => route('products.index'),
                    'urlEdit' => route('products.edit', $product->id)
                ])
            </div>
        </div>
    </div>
@endsection
