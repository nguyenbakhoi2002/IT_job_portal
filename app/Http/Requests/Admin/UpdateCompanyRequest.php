<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'team' => 'required',
            'founded_in' => 'required',
            'about' => 'required',
            'company_model' => 'required',
            'email' => 'required|email|unique:companies,email,'.$this->id,
            'phone' => 'required|max:10|unique:companies,phone,'.$this->id,
            'hinhanh_upload_logo' => 'image|mimes:jpg,png,jpeg|max:5000',
            // 'hinhanh_upload_image_paper' => 'image|mimes:jpg,png,jpeg|max:5000'

        ];
    }
    public function messages():array{
        return [
            'name.required' => 'Vui lòng nhập tên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'company_model.required' => 'Vui lòng nhập loại hình doanh nghiệp',
            'team.required' => 'Vui lòng nhập số lượng nhận viên',
            'founded_in.required' => 'Vui lòng nhập ngày thành lập',
            'about.required' => 'Vui lòng nhập thông tin chung',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'email.email' => 'Email sai định dạng',
            'company_name.required' => 'Vui lòng nhập tên công ty',
            'company_name.unique' => 'Tên công ty đã tồn tại',
            'tax_code.required' => 'Vui lòng nhập mã số thuế',
            'tax_code.unique' => 'Mã số thuế đã tồn tại trong hệ thống',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Số điện thoại phải có 10 số',
            'phone.max' => 'Số điện thoại nhỏ hơn 10 số',
            'phone.unique' => 'Số điện thoại đã tồn tại!',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'hinhanh_upload_logo.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'hinhanh_upload_logo.max' => 'Ảnh nhập không quá 5mb!',

            'hinhanh_upload_image_paper.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'hinhanh_upload_image_paper.max' => 'Ảnh nhập không quá 5mb!',

        ];
    }
}
