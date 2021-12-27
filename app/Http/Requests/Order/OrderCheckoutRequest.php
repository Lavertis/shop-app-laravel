<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCheckoutRequest extends FormRequest
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
            'first_name' => ['required', 'regex:/^[\s\p{L}-]+$/u', 'min:2', 'max: 255'],
            'last_name' => ['required', 'regex:/^[\s\p{L}-]+$/u', 'min:2', 'max: 255'],
            'country' => ['required', 'exists:countries,code'],
            'city' => ['required', 'regex:/^[\s\p{L}-]+$/u', 'min:2', 'max: 255'],
            'street' => ['required', 'regex:/^[\w\s,\/-]+$/u', 'min:2', 'max: 255'],
            'payment' => ['required', 'exists:payment_methods,code'],
            'fast_delivery' => ['nullable', 'regex:/^on$/'],
        ];
    }
}
