<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
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
            "name"=>'required|unique:skills,name',
            "description"=>"required"
        ];
    }
    public function messages():array{
        return [
            'name.required'=>'vui lòng nhập tên kĩ năng',
            'name.unique'=>"kĩ năng $this->name này đã tồn tại",
            'description.required'=>'vui lòng nhập mô tả kĩ năng',

        ];
    }
}
