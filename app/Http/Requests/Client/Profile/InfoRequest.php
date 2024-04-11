<?php

namespace App\Http\Requests\Client\Profile;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
        // dd('khôi');
        $currentAction = $this->route()->getActionMethod();
        // dd($currentAction);
        // dd($this->id);
        $rules = [];
        switch ($currentAction) {
            case 'store':
                $rules = [
                    'name' => 'required',
                    'title' => 'required',
                    'phone' => 'required|numeric|max:11',
                    'email' => 'required',
                    'objective' => 'required',
                    // 'candidate_id' => 'required',
                    // 'major_id' => 'required',
                    'hinhanh_upload_logo' => 'required|image|mimes:jpg,png,jpeg|max:5000',
                    'address' => 'required',

                ];
                break;
            case 'updateInfo':
                // dd('đã vào');
                $rules = [
                    'name' => 'required',
                    'title' => 'required',
                    'phone' => 'required|numeric',

                    // 'phone' => 'required|numeric|digits:10',
                    'email' => 'required',
                    'objective' => 'required',
                    // 'candidate_id' => 'required',
                    // 'major_id' => 'required',
                    'hinhanh_upload_logo' => 'image|mimes:jpg,png,jpeg|max:5000',
                    'address' => 'required',          
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
    public function messages()
    {
        dd('khôi');
        return [
            'name.required' => 'không được bỏ trống',
            'title.required' => 'không được bỏ trống',
            'phone.required' => 'không được bỏ trống',
            'address.required' => 'không được bỏ trống',
            'phone.numeric' => 'phải nhập số',
            // 'phone.digits' => 'có 10 kí tự',
            'email.required' => 'không được bỏ trống',
            'objectice.required' => 'không được bỏ trống',
            'hinhanh_upload_logo.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'hinhanh_upload_logo.max' => 'Ảnh nhập không quá 5mb!',
            

            
        ];
    }
}
