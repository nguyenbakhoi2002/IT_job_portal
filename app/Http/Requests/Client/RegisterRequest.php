<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name"=>'required',
            "password"=>'required|confirmed',
            "password_confirmation"=>'required',
            "email"=>'required|email|unique:candidate,email'
        ];
        
    }
    public function messages():array{
        return [
            'name.required'=>'vui lòng nhập tên đầy đủ của bạn',
            'password.required'=>'vui lòng nhập mật khẩu',
            'password.confirmed'=>'mật khẩu nhập lại không đúng',
            'password_confirmation.required'=>'vui lòng nhập lại mật khẩu',
            'email.required'=>'vui lòng nhập email ',
            'email.email'=>'email không đúng định dạng',
            'email.unique'=>"tài khoản $this->email này đã được đăng kí",
        ];
    }
}
