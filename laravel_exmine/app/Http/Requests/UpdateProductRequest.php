<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'description.max' => '商品説明は1000文字以内で入力してください。',
            'price.required' => '価格は必須です。',
            'price.integer' => '価格は整数で入力してください。',
            'price.min' => '価格は1円以上で入力してください。',
            'stock.required' => '在庫数は必須です。',
            'stock.integer' => '在庫数は整数で入力してください。',
            'stock.min' => '在庫数は0以上で入力してください。',
            'image.image' => '商品画像は画像ファイルを選択してください。',
            'image.mimes' => '商品画像は jpg / jpeg / png / gif / webp 形式で選択してください。',
            'image.max' => '商品画像は2MB以下にしてください。',
        ];
    }
}