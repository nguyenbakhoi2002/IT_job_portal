<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindPwRequest extends FormRequest
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
            'token' => 'required',
            'password' => 'required',
            're_password' => 'required|same:password',
        ];
    }
    public function messages():array{
        return [
            'token.required' => 'Nhập mã xác nhận',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            're_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
        ];
    }
}
