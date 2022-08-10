<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                            'title' => 'required|unique:banners',
                            'desc' => 'required',
                            'img' => 'required',
                            'thumb_img' => 'required'
                        ];
                        break;
                    case 'save_update':
                        $rules = [
                            'title' => 'required',
                            'desc' => 'required'
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

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề bắt buộc nhập',
            'title.unique' => 'Tiêu đề đã tồn tại.Vui lòng thử lại !',
            'desc.required' => 'Mô tả bắt buộc nhập',
            'img.required' => 'Ảnh nền bắt buộc chọn',
            'thumb_img.required' => 'Ảnh thu nhỏ bắt buộc chọn'
        ];
    }
}
