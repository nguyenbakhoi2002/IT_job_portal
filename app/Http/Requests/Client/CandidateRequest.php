<?php

namespace App\Http\Requests\Client;

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
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required|max:10|unique:candidate,phone,' .$this->id,
            'image' => 'mimes:jpg,png,jpeg|max:5000'

        ];
    }
    public function messages():array{
        return [
            'name.required' => 'Vui lòng nhập tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Số điện thoại nhỏ hơn 10 số!',
            'phone.unique' => 'Số điện thoại đã tồn tại!',
            'image.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'image.max' => 'Ảnh nhập không quá 5mb!',

        ];
    }
}
