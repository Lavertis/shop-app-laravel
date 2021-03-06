<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductsRequest extends FormRequest
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
        return [
            'min-price' => ['nullable', 'numeric', 'nullable', 'min:0', 'max:99999'],
            'max-price' => ['nullable', 'numeric', 'nullable', 'min:1', 'max:100000'],
            'sort' => ['nullable', 'in:asc,desc']
        ];
    }
}
