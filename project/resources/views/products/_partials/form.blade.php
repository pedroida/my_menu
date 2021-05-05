@csrf

<div class="form-row">
    <div class="form-group col-12 col-md-4">
        <label for="name">
            @lang('labels.common.name')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('name') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-font"></i>
                </span>
            </div>
            <input type="text" name="name" class="form-control {{ has_error_class('name') }}"
                   placeholder="@lang('placeholders.products.name')"
                   value="{{ old('name', $product->name ?? '') }}" autofocus>
        </div>
        @errorblock('name')
    </div>

    <div class="form-group col-12 col-md-2">
        <label for="price">
            @lang('labels.common.price')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('price') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>
            <input type="text" name="price" class="form-control {{ has_error_class('price') }} mask-money"
                   value="{{ old('price', $product->price ?? '0,00') }}">
        </div>
        @errorblock('price')
    </div>

    <div class="form-group col-12 col-md-3">
        <label for="unit_id">
            @lang('labels.common.unit')<span class="text-danger ml-1">*</span>
        </label>
        <select name="unit_id" id="unit_id" class="form-control select2 {{ has_error_class('unit_id') }}">
            @foreach($units as $unit)
                <option
                        value="{{ $unit->id }}"
                        {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
        @errorblock('unit_id')
    </div>

    <div class="form-group col-12 col-md-3 p-md-0">
        <label for="category_id">
            @lang('labels.common.category')<span class="text-danger ml-1">*</span>
        </label>
        <select name="category_id" id="category_id"
                class="form-control select2 {{ has_error_class('category_id') }}">
            @foreach($categories as $category)
                <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @errorblock('category_id')
    </div>

    <div class="form-group col-12 col-md-6">
        <label for="image">
            @lang('labels.common.image')<span class="text-danger ml-1">*</span>
        </label>
        <div class="custom-file {{ has_error_class('image') }}">
            <input name="image" type="file" accept="image/*" class="custom-file-input {{ has_error_class('image') }}" id="image">
            <label class="custom-file-label" for="image">@lang('labels.common.select_image')</label>
        </div>
        @errorblock('image')
    </div>

    <div class="form-group col-12 col-md-6">
        <label for="description">
            @lang('labels.common.description')
        </label>

        <textarea name="description" class="form-control {{ has_error_class('description') }}"
                  placeholder="@lang('placeholders.products.description')"
        >{{ old('description', $product->description ?? '') }}</textarea>
        @errorblock('description')
    </div>
</div>
