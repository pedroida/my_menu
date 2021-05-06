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
                   value="{{ old('name', $promotion->name ?? '') }}" autofocus>
        </div>
        @errorblock('name')
    </div>

    <div class="form-group floating-addon col-12 col-md-4">
        <label for="valid_from">
            @lang('labels.common.valid_from')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('valid_from') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>

            <datepicker
                    name="valid_from"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    @if($promotion->valid_from)
                    :value="new Date('{{ format_date($promotion->valid_from, 'Y,m,d') }}')"
                    @endif
                    format="dd/MM/yyyy">
            </datepicker>
        </div>
        @errorblock('valid_from')
    </div>

    <div class="form-group floating-addon col-12 col-md-4">
        <label for="valid_until">
            @lang('labels.common.valid_until')<span class="text-danger ml-1">*</span>
        </label>
        <div class="input-group {{ has_error_class('valid_until') }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>

            <datepicker
                    name="valid_until"
                    :language="ptBr"
                    input-class="form-control"
                    wrapper-class="w-100"
                    @if($promotion->valid_until)
                    :value="new Date('{{ format_date($promotion->valid_until, 'Y,m,d') }}')"
                    @endif
                    format="dd/MM/yyyy">
            </datepicker>
        </div>
        @errorblock('valid_until')
    </div>
</div>

<promotion-form :promotion='@json($promotion)' :old='@json(old())' :products='@json($products)' :errors="{{ $errors }}"></promotion-form>
