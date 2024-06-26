<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
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
        // dd($currentAction);
        // dd($this->id);
        $rules = [];
        switch ($currentAction) {
            case 'store':
                $rules = [
                    'name' => 'required|unique:time_exp,name',
                    'level' => 'required|unique:time_exp',
                    
                    
                ];
                break;
            case 'update':
                $rules = [
                    'name' => 'required',
                    'level' => 'required|unique:time_exp,level,'.$this->id,
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
            'name.required' => 'không được bỏ trống',
            'level.required' => 'không được bỏ trống',
            'level.unique' => "$this->level đã tồn tại",
            'name.unique' => "$this->name đã tồn tại",

            
        ];
    }
}
