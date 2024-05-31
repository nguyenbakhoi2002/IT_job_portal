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
            // "password"=>'required|confirmed',
            'password' => [
                'required',
                'confirmed', //confirmed chỉ kiểm tra giá trị của trường có tên giống với trường gốc và thêm phần _confirmation
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'
            ],
            "password_confirmation"=>'required',
            "email"=>'required|email|unique:candidate,email'
        ];
        
    }
    public function messages():array{
        return [
            'name.required'=>'vui lòng nhập tên đầy đủ của bạn',
            'password.required'=>'vui lòng nhập mật khẩu',
            'password.confirmed'=>'mật khẩu nhập lại không đúng',
            'password.regex' => 'mật khẩu phải có ít nhất 8 ký tự, ít nhất 1 chữ cái và ít nhất 1 số',
            'password_confirmation.required'=>'vui lòng nhập lại mật khẩu',
            'email.required'=>'vui lòng nhập email ',
            'email.email'=>'email không đúng định dạng',
            'email.unique'=>"tài khoản $this->email này đã được đăng kí",
        ];
    }
}
