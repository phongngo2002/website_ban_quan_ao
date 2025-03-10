<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):

            case 'POST':
                switch ($currentAction) {
                    case 'save_create':
                        $rules = [
                            'title' => 'required|unique:categories',
                            'img' => 'required'
                        ];
                        break;
                    case 'save_update':
                        $rules = [
                            'title' => 'required',
                        ];
                        break;
                    default:
                        break;
                }
                break;

            default:
                break;
        endswitch;

        return $rules;
    }
    public function messages(){

        return [
            'title.required' => 'Tiêu đề không được bỏ trông',
            'title.unique' => 'Tiêu đề đã tồn tại.Vui lòng nhập tiêu đề khác',
            'img.required' => 'Ảnh mô tả không được bỏ trống'
        ];
    }
}
