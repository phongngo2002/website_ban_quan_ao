<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                            'email' => 'required|unique:users|email',
                            'password' => 'required',
                            'name' => 'required',
                            'address' => 'required',
                            'img' => 'required'
                        ];
                        break;
                    case 'save_update':
                        $rules = [
                            'email' => 'required|email',
                            'password' => 'required',
                            'name' => 'required',
                            'address' => 'required',
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
            'email.required' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại.Vui lòng thử một email khác',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'name.required' => 'Họ tên không được bỏ trống',
            'address.required' => 'Địa chỉ không được bỏ trống',
            'img.required' => 'Ảnh đại diện bắt buộc chọn'
        ];
    }
}
