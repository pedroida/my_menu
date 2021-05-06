@extends('layouts.app')
@section('title', __('headings.promotions.show'))

@section('page-header')
    <h1>
        <i class="fas fa-user-shield fa-fw mr-2 text-muted"></i>
        @lang('headings.promotions.show')
    </h1>
    <breadcrumb>
        <breadcrumb-item href="{{ route('home') }}">
            @lang('breadcrumb.common.home')
        </breadcrumb-item>

        <breadcrumb-item href="{{ route('promotions.index') }}">
            @lang('breadcrumb.promotions.index')
        </breadcrumb-item>

        <breadcrumb-item active>
            @lang('breadcrumb.common.show')
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
    <div class="card card-secondary">
        <div class="card-body pb-0">

            <div class="col-12">
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
                            <input type="text" name="name" class="form-control" value="{{ $promotion->name }}"
                                   disabled>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-2">
                        <label for="price">
                            @lang('labels.common.type')
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                            </div>
                            <input type="text" name="price" class="form-control"
                                   value="{{ $promotion->type === \App\Enums\PromotionTypeEnum::PERCENTAGE ? 'Porcentagem' : 'Valor de desconto' }}"
                                   disabled>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-2">
                        <label for="unit_id">
                            @lang('labels.common.value')
                        </label>
                        <input type="text" name="unit" class="form-control" value="{{ $promotion->formatted_value }}"
                               disabled>
                    </div>

                    <div class="form-group col-12 col-md-2">
                        <label for="category_id">
                            @lang('labels.common.valid_from')
                        </label>
                        <input type="text" name="category" class="form-control"
                               value="{{ format_date($promotion->valid_from, 'd/m/Y') }}" disabled>

                    </div>

                    <div class="form-group col-12 col-md-2">
                        <label for="category_id">
                            @lang('labels.common.valid_until')
                        </label>
                        <input type="text" name="category" class="form-control"
                               value="{{ format_date($promotion->valid_until, 'd/m/Y') }}" disabled>

                    </div>

                    <hr>

                    <div class="col-12 text-center">
                        <h5>
                            Produtos
                        </h5>
                    </div>

                    @foreach($promotion->products as $product)
                        <div class="form-group col-12 col-md-6 offset-md-3">
                            <input type="text" name="category" class="form-control text-center"
                                   value="{{ $product->compound_name }}" disabled>

                        </div>
                    @endforeach

                </div>
            </div>

            <div class="card-footer">
                @include('shared.show_buttons', [
                    'urlBack' => route('promotions.index'),
                    'urlEdit' => route('promotions.edit', $promotion->id)
                ])
            </div>
        </div>
    </div>
@endsection
