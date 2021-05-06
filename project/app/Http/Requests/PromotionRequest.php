<?php

namespace App\Http\Requests;

use App\Enums\PromotionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = [PromotionTypeEnum::VALUE_TO_DISCOUNT, PromotionTypeEnum::PERCENTAGE];

        return [
            'name' => 'required|string',
            'valid_from' => 'required|date_format:d/m/Y',
            'valid_until' => 'required|date_format:d/m/Y',
            'type' => 'required|in:' . implode(',', $types),
            'value' => 'required',
            'products' => 'required|array|min:1',
            'products.*' => 'required|exists:products,id'
        ];
    }
}
