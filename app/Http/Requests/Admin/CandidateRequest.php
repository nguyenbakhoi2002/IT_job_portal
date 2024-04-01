<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
    public function rules():array
    {

        $id = $this->id;
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        // để lấy phương thức hiện tại
        //khi update nó sẽ chạy vào put , sửa mãi ms xong, cay quá
        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        $rules = [
                            'name' => 'required',
                            'email' => 'required|email|unique:candidate',
                            'password' => 'required',
                            // 'tax_code' => 'required|unique:companies',
                            'phone' => 'required|min:10|unique:companies',
                            'user_image_clone' => 'image|mimes:jpg,png,jpeg|max:5000',
                        ];
                        break;
  
                    default:
                        break;
                }
                break;

            case 'PUT':
                switch($currentAction){
                    case 'update':
                        $rules = [
                            'name' => 'required',
                            'email' => 'required|email|unique:candidate,email,'.$this->id,
                            'password' => 'required',
                            // 'tax_code' => 'required|unique:companies',
                            'phone' => 'required|min:10|unique:candidate,phone,'.$this->id,
                            'user_image_clone' => 'image|mimes:jpg,png,jpeg|max:5000',
                        ];
                        break;
                    default:
                        break;
                }
            default:
                break;
        endswitch;
        return $rules;
    }
    public function messages():array
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'email.email' => 'Email sai định dạng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Số điện thoại phải có 10 số',
            'phone.max' => 'Số điện thoại nhỏ hơn 10 số',
            'phone.unique' => 'Số điện thoại đã tồn tại!',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'user_image_clone.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'user_image_clone.max' => 'Ảnh nhập không quá 5mb!',

        ];
    }
}
