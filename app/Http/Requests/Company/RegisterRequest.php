<?php

namespace App\Http\Requests\Company;

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
            "password"=>'required',
            're_password' => 'required|same:password',
            "email"=>'required|email|unique:companies,email',
            "company_name"=>'required|unique:companies',
            "phone"=>'required',
            "company_model"=>'required',
            "link_web"=>'required',
            "founded_in"=>'required',
            "team"=>'required',
            "address"=>'required',
            
        ];
        
    }
    public function messages():array{
        return [
            'name.required'=>'Vui lòng nhập tên ',
            'password.required'=>'Vui lòng nhập mật khẩu',
            're_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
            'email.required'=>'Vui lòng nhập email ',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>"Tài khoản $this->email này đã được đăng kí",
            'company_name.required'=>'Vui lòng nhập tên công ty',
            'company_name.unique'=>"Tài khoản $this->company_name này đã được đăng kí",
            'phone.required'=>'Vui lòng nhập số điện thoại ',
            'company_model.required'=>'Vui lòng nhập loại hình doanh nghiệp',
            'link_web.required'=>'Vui lòng nhập link web của công ty',
            'founded_in.required'=>'Vui lòng nhập nằm thành lập',
            'address.required'=>'Vui lòng nhập địa chỉ',
            'team.required'=>'Vui lòng nhập số lượng nhân viên',

        ];
    }
}
