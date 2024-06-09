<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ChangePwRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'password' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'
            ],
            'password_old' => 'required',
            're_password' => 'required|same:password',
        ];
    }
    public function messages():array{
        return [
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.regex' => 'mật khẩu phải có ít nhất 8 ký tự, ít nhất 1 chữ cái và ít nhất 1 số',
            'password_old.required' => 'Vui lòng nhập mật khẩu cũ',
            're_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
        ];
    }
}
