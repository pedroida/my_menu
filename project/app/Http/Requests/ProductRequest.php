<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string',
            'price' => 'required',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image'
        ];

        if(in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = 'nullable';
        }

        return $rules;
    }
}
