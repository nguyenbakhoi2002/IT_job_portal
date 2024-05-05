<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class paperUpdateCompanyRequest extends FormRequest
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
            'hinhanh_upload_image_paper' => 'nullable|image|mimes:jpg,png,jpeg|max:5000',
        ];
    }
    public function messages():array{
        return [
            'hinhanh_upload_image_paper.image' => 'Ảnh không hợp lệ!', // Thêm tin nhắn này nếu không có ảnh được tải lên
            'hinhanh_upload_image_paper.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'hinhanh_upload_image_paper.max' => 'Ảnh nhập không quá 5mb!',

        ];
    }
}
