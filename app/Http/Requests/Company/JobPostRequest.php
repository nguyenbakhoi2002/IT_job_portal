<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
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
        $currentAction = $this->route()->getActionMethod();
        $rules = [];
        switch ($currentAction) {
            case 'store':
                $rules = [
                    'title' => 'required',
                    'amount' => 'required',
                    'min_salary' => 'required|numeric|min:0',// giá trị tối thiểu là 0
                    'max_salary' => 'required|numeric|gt:min_salary',//giá trị tối thiểu là min_salary
                    'address' => 'required',
                    'description' => 'required',
                    'requirement' => 'required',
                    'benefits' => 'required',
                    'skill' => 'required',
                    
                ];
                break;
            case 'update':
                $rules = [
                    'title' => 'required',
                    'amount' => 'required',
                    'min_salary' => 'required|numeric|min:0',// giá trị tối thiểu là 0
                    'max_salary' => 'required|numeric|gt:min_salary',//giá trị tối thiểu là min_salary
                    'address' => 'required',
                    'description' => 'required',
                    'requirement' => 'required',
                    'benefits' => 'required',
                    'skill' => 'required',
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền tiêu đề',
            'amount.required' => 'Vui lòng điền số lượng',
            'min_salary.required' => 'Vui lòng nhập trường này',
            'max_salary.required' => 'Vui lòng nhập lương tối đa',
            'min_salary.numeric' => 'trường này phải là 1 số',
            'max_salary.numeric' => 'trường này phải là 1 số',
            'min_salary.min' => 'trường này phải là 1 số lớn hơn 0',
            'max_salary.gt' => 'lương tối đa phải lớn hơn lương tối thiểu',
            'address.required' => 'Vui lòng điền địa chỉ',
            'description.required' => 'Vui lòng điền mô tả',
            'requirement.required' => 'Vui lòng điền yêu cầu',
            'benefits.required' => 'Vui lòng điền quyền lợi',
            'skill.required' => 'Vui lòng điền kĩ năng',
            
        ];
    }

}
