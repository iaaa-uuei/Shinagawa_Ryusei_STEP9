<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => '購入数は必須です。',
            'quantity.integer' => '購入数は整数で入力してください。',
            'quantity.min' => '購入数は1以上で入力してください。',
        ];
    }
}