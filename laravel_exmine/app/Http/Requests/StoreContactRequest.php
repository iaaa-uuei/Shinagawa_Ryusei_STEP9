<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は255文字以内で入力してください。',

            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',

            'subject.required' => '件名は必須です。',
            'subject.max' => '件名は255文字以内で入力してください。',

            'message.required' => 'お問い合わせ内容は必須です。',
            'message.max' => 'お問い合わせ内容は2000文字以内で入力してください。',
        ];
    }
}