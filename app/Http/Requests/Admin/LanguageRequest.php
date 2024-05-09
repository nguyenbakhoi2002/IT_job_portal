<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $id = $this->id;
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        // để lấy phương thức hiện tại
        //khi update nó sẽ chạy vào put , sửa mãi ms xong, cay quá
        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        return [
                            "name"=>'required|unique:languages,name',
                            "description"=>"required"
                        ];
                        break;
  
                    default:
                        break;
                }
                break;

            case 'PUT':
                switch($currentAction){
                    case 'update':
                        return [
                            "name"=>'required|unique:languages,name,'.$this->id,
                            "description"=>"required",
                
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
            'name.required'=>'vui lòng nhập tên Ngôn ngữ',
            'name.unique'=>"Ngôn ngữ $this->name này đã tồn tại",
            'description.required'=>'vui lòng nhập mô tả Ngôn ngữ',
        ];
    }
}
